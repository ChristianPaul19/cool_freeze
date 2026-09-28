<?php
/*
 * One row inside a profile card. Include it inside a foreach loop.
 * Needs: $field = ['id', 'icon', 'label', 'value']
 * Optional: $field['secret'] = true and $field['reveal'] (text shown when the eye is clicked)
 */
$isSecret = !empty($field['secret']);
?>
<div class="cf-field">
    <div class="cf-field__label">
        <?= icon($field['icon']) ?>
        <span><?= e($field['label']) ?></span>
    </div>
    <div class="cf-field__value">
        <span data-profile="<?= e($field['id']) ?>"
              <?= $isSecret ? 'data-mask="' . e($field['value']) . '" data-reveal="' . e($field['reveal']) . '"' : '' ?>><?= e($field['value']) ?></span>
        <?php if ($isSecret): ?>
            <button type="button" class="cf-field__eye" data-toggle-secret aria-label="Show password" aria-pressed="false">
                <?= icon('eye') ?>
            </button>
        <?php endif; ?>
    </div>
</div>
