<?php
const CART_MAX_QTY = 99;

// Cart rows with names and a server-computed unit price (never trust prices from the browser)
function cart_get(mysqli $conn, int $customerId): array {
    $stmt = $conn->prepare(
        'SELECT c.cart_item_id, c.service_id, c.unit_type_id, c.customer_type, c.quantity,
                s.name AS service_name, s.icon, u.name AS unit_type_name,
                (s.base_price + u.price_adjustment) AS unit_price
         FROM cart_items c
         JOIN services s      ON s.service_id = c.service_id
         JOIN ac_unit_types u ON u.unit_type_id = c.unit_type_id
         WHERE c.customer_id = ? AND s.is_active = 1 AND u.is_active = 1
         ORDER BY c.cart_item_id'
    );
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    foreach ($rows as &$r) {
        $r['unit_price'] = (float) $r['unit_price'];
        $r['subtotal']   = $r['unit_price'] * (int) $r['quantity'];
    }
    return $rows;
}

function cart_total(array $items): float {
    return array_sum(array_column($items, 'subtotal'));
}

function cart_count(mysqli $conn, int $customerId): int {
    $stmt = $conn->prepare('SELECT COALESCE(SUM(quantity), 0) FROM cart_items WHERE customer_id = ?');
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $n = (int) $stmt->get_result()->fetch_row()[0];
    $stmt->close();
    return $n;
}

// Adding the same service/type/customer-type again increases the quantity instead of duplicating
function cart_add(
    mysqli $conn, int $customerId, int $serviceId, int $unitTypeId, string $customerType, int $quantity
): void {
    $quantity = max(1, min(CART_MAX_QTY, $quantity));

    $stmt = $conn->prepare(
        'SELECT cart_item_id, quantity FROM cart_items
         WHERE customer_id = ? AND service_id = ? AND unit_type_id = ? AND customer_type = ? LIMIT 1'
    );
    $stmt->bind_param('iiis', $customerId, $serviceId, $unitTypeId, $customerType);
    $stmt->execute();
    $existing = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($existing) {
        $newQty = min(CART_MAX_QTY, (int) $existing['quantity'] + $quantity);
        $id = (int) $existing['cart_item_id'];
        $stmt = $conn->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?');
        $stmt->bind_param('ii', $newQty, $id);
    } else {
        $stmt = $conn->prepare(
            'INSERT INTO cart_items (customer_id, service_id, unit_type_id, customer_type, quantity)
             VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('iiisi', $customerId, $serviceId, $unitTypeId, $customerType, $quantity);
    }
    $stmt->execute();
    $stmt->close();
}

// customer_id in the WHERE clause means a customer can only touch their own cart rows
function cart_update_quantity(mysqli $conn, int $customerId, int $cartItemId, int $quantity): bool {
    $quantity = max(1, min(CART_MAX_QTY, $quantity));
    $stmt = $conn->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ? AND customer_id = ?');
    $stmt->bind_param('iii', $quantity, $cartItemId, $customerId);
    $stmt->execute();
    $ok = $stmt->affected_rows >= 0 && $stmt->errno === 0;
    $stmt->close();
    return $ok;
}

function cart_remove(mysqli $conn, int $customerId, int $cartItemId): void {
    $stmt = $conn->prepare('DELETE FROM cart_items WHERE cart_item_id = ? AND customer_id = ?');
    $stmt->bind_param('ii', $cartItemId, $customerId);
    $stmt->execute();
    $stmt->close();
}

function cart_clear(mysqli $conn, int $customerId): void {
    $stmt = $conn->prepare('DELETE FROM cart_items WHERE customer_id = ?');
    $stmt->bind_param('i', $customerId);
    $stmt->execute();
    $stmt->close();
}

// changes

// Changes one cart line. If the new choice matches ANOTHER line in the same cart, they are merged.
// Returns false if the line doesn't exist or belongs to someone else.
function cart_edit_item(
    mysqli $conn, int $customerId, int $cartItemId, int $unitTypeId, string $customerType, int $quantity
): bool {
    $quantity = max(1, min(CART_MAX_QTY, $quantity));

    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare(
            'SELECT service_id FROM cart_items WHERE cart_item_id = ? AND customer_id = ? LIMIT 1 FOR UPDATE'
        );
        $stmt->bind_param('ii', $cartItemId, $customerId);
        $stmt->execute();
        $line = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$line) {
            $conn->rollback();
            return false;
        }
        $serviceId = (int) $line['service_id'];

        $stmt = $conn->prepare(
            'SELECT cart_item_id, quantity FROM cart_items
             WHERE customer_id = ? AND service_id = ? AND unit_type_id = ? AND customer_type = ?
               AND cart_item_id <> ? LIMIT 1'
        );
        $stmt->bind_param('iiisi', $customerId, $serviceId, $unitTypeId, $customerType, $cartItemId);
        $stmt->execute();
        $other = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($other) {
            // Same choice already in the cart: add the quantities together, drop the edited line
            $otherId = (int) $other['cart_item_id'];
            $merged  = min(CART_MAX_QTY, (int) $other['quantity'] + $quantity);

            $stmt = $conn->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?');
            $stmt->bind_param('ii', $merged, $otherId);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare('DELETE FROM cart_items WHERE cart_item_id = ? AND customer_id = ?');
            $stmt->bind_param('ii', $cartItemId, $customerId);
            $stmt->execute();
            $stmt->close();
        } else {
            $stmt = $conn->prepare(
                'UPDATE cart_items SET unit_type_id = ?, customer_type = ?, quantity = ?
                 WHERE cart_item_id = ? AND customer_id = ?'
            );
            $stmt->bind_param('isiii', $unitTypeId, $customerType, $quantity, $cartItemId, $customerId);
            $stmt->execute();
            $stmt->close();
        }

        $conn->commit();
        return true;
    } catch (Throwable $e) {
        $conn->rollback();
        throw $e;
    }
}
//