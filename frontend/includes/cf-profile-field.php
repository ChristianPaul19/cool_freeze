<?php
/*
 * One row inside a profile card. Include it inside a foreach loop.
 * Needs: $field = ['id', 'icon', 'label', 'value']
 * Optional: $field['secret'] = true and $field['reveal_url'] (API that returns the text to show)
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
              <?= $isSecret ? 'data-mask="' . e($field['value']) . '"' : '' ?>><?= e($field['value']) ?></span>
        <?php if ($isSecret): ?>
            <button type="button" class="cf-field__eye" data-toggle-secret
                    data-reveal-url="<?= e($field['reveal_url']) ?>"
                    aria-label="Show password" aria-pressed="false">
                <?= icon('eye') ?>
            </button>
        <?php endif; ?>
    </div>
</div>
