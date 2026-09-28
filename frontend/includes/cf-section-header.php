<?php
/*
 * Section title pill (icon + title) with an optional button on the right.
 * Needs: $sectionTitle, $sectionIcon
 * Optional: $sectionButtonLabel, $sectionButtonIcon, $sectionButtonTarget (id of the panel to open)
 */
?>
<div class="cf-section-head">
    <h2 class="cf-section-title"><?= icon($sectionIcon) ?><span><?= e($sectionTitle) ?></span></h2>

    <?php if (!empty($sectionButtonLabel)): ?>
        <button type="button" class="cf-btn cf-btn--outline cf-btn--lg" data-open-panel="<?= e($sectionButtonTarget) ?>">
            <?= icon($sectionButtonIcon ?? 'edit') ?><span><?= e($sectionButtonLabel) ?></span>
        </button>
    <?php endif; ?>
</div>
<?php
// Clear the optional variables so they don't leak into the next section.
unset($sectionButtonLabel, $sectionButtonIcon, $sectionButtonTarget);
