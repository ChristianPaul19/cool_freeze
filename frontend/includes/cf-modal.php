<?php
/*
 * Reusable modal / overlay. Opened with data-open-modal="<id>", closed with data-close-modal.
 * Needs: $modalId, $modalTitle, $modalBody (HTML built by the page with e() on user data)
 */
?>
<div class="cf-modal" id="<?= e($modalId) ?>" role="dialog" aria-modal="true" aria-labelledby="<?= e($modalId) ?>Title" hidden>
    <div class="cf-modal__dialog">
        <div class="cf-modal__head">
            <h2 id="<?= e($modalId) ?>Title"><?= e($modalTitle) ?></h2>
            <button type="button" class="cf-modal__close" data-close-modal aria-label="Close"><?= icon('close') ?></button>
        </div>
        <div class="cf-modal__body"><?= $modalBody ?></div>
    </div>
</div>
