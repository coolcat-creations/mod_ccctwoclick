<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_ccctwoclick
 *
 * Privacy card block generation for the CCC Two Click template.
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

// Build legal content (privacy notice + link)
$legalContentHtml = '';
if ($privacyNoticeTextValue !== '' || $privacyLinkUrlValid) {
    ob_start();
    ?>
    <small><?php echo nl2br($escape($privacyNoticeTextValue)); ?>
        <?php if ($privacyLinkUrlValid) : ?>
            <a class="ccctwoclick__privacy-link" href="<?php echo $escape($privacyLinkHref); ?>"<?php echo $privacyLinkTargetAttrs; ?>>
                <?php echo $escape($privacyLinkTextValue); ?>
            </a>
        <?php endif; ?>
    </small>
    <?php
    $legalContentHtml = trim(ob_get_clean());
}

// Build details toggle content
$detailsContentHtml = '';
if ($extendedPrivacyEnable && $privacyDetailsTextValue !== '') {
    ob_start();
    ?>
    <button type="button"
            class="ccctwoclick__details-toggle"
            data-ccctwoclick-details-toggle
            aria-expanded="false"
            aria-controls="ccctwoclick-details-<?php echo $moduleId; ?>"
            data-open-label="<?php echo $escape($privacyDetailsToggleText); ?>"
            data-close-label="<?php echo $escape($privacyDetailsToggleHideText); ?>">
        <?php echo $escape($privacyDetailsToggleText); ?>
    </button>
    <div id="ccctwoclick-details-<?php echo $moduleId; ?>" class="ccctwoclick__details-body" data-ccctwoclick-details hidden>
        <?php echo $privacyDetailsTextValue; ?>
    </div>
    <?php
    $detailsContentHtml = trim(ob_get_clean());
}

// Build card inline styles
$cardStyles = [];
if ($cardBackgroundColor !== '') {
    $cardStyles[] = 'background:' . $escape($cardBackgroundColor);
}
if ($cardBorderRadius !== '') {
    $cardStyles[] = 'border-radius:' . $escape($cardBorderRadius);
}
if ($cardTextColor !== '') {
    $cardStyles[] = 'color:' . $escape($cardTextColor);
}
if ($cardBoxShadow !== '') {
    $cardStyles[] = 'box-shadow:' . $escape($cardBoxShadow);
}
$cardStyleAttr = !empty($cardStyles) ? ' style="' . implode(';', $cardStyles) . '"' : '';

// Build privacy card HTML
ob_start();
?>
<div class="ccctwoclick__block ccctwoclick__block--card"
     data-ccctwoclick-block="card"
     role="group"
     aria-labelledby="ccctwoclick-heading-<?php echo $moduleId; ?>"<?php echo $cardStyleAttr; ?>>
    <div class="ccctwoclick__privacy-header" id="ccctwoclick-heading-<?php echo $moduleId; ?>" tabindex="-1">
        <?php echo $escape($privacyHeading); ?>
    </div>

    <?php if ($contentAfter !== '') : ?>
        <div class="ccctwoclick__copy ccctwoclick__copy--after" data-ccctwoclick-after hidden>
            <?php echo $contentAfter; ?>
        </div>
    <?php endif; ?>

    <?php if ($contentBefore !== '') : ?>
        <div class="ccctwoclick__copy" data-ccctwoclick-before>
            <?php echo $contentBefore; ?>
        </div>
    <?php endif; ?>

    <?php if ($shouldRenderToggle || $shouldRenderButton) : ?>
        <div class="ccctwoclick__controls" data-ccctwoclick-controls>
            <?php if ($shouldRenderToggle) : ?>
                <label class="ccctwoclick-toggle">
                    <span class="ccctwoclick-toggle__visual">
                        <input type="checkbox"
                               class="ccctwoclick-toggle__input"
                               data-ccctwoclick-toggle
                               role="switch"
                               aria-checked="false"
                               aria-label="<?php echo $escape($privacyToggleLabelText); ?>"
                               data-label-inactive="<?php echo $escape($privacyToggleLabelText); ?>"
                               data-label-active="<?php echo $escape($privacyToggleLabelActiveText); ?>" />
                        <span class="ccctwoclick-toggle__slider" aria-hidden="true"></span>
                    </span>
                    <span class="ccctwoclick-toggle__text" data-ccctwoclick-toggle-label>
                        <?php echo $escape($privacyToggleLabelText); ?>
                    </span>
                </label>
            <?php endif; ?>

            <?php if ($shouldRenderButton) : ?>
                <div class="ccctwoclick__buttonbar">
                    <button type="button"
                            class="ccctwoclick__btn <?php echo $escape($btnclassEnable); ?>"
                            data-ccctwoclick-reveal>
                        <?php echo Text::_($btntxtReveal); ?>
                    </button>
                    <button type="button"
                            class="ccctwoclick__btn <?php echo $escape($btnclassDisable); ?>"
                            data-ccctwoclick-disable
                            hidden>
                        <?php echo Text::_($btntxtDisable); ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($isIntegratedLayout && ($legalContentHtml !== '' || $detailsContentHtml !== '')) : ?>
        <div class="ccctwoclick__card-legal">
            <?php if ($legalContentHtml !== '') : ?>
                <div class="ccctwoclick__bar-legal" data-ccctwoclick-legal>
                    <?php echo $legalContentHtml; ?>
                </div>
            <?php endif; ?>
            <?php if ($detailsContentHtml !== '') : ?>
                <div class="ccctwoclick__bar-details" data-ccctwoclick-details-block>
                    <?php echo $detailsContentHtml; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php
$cardBlockHtml = trim(ob_get_clean());
