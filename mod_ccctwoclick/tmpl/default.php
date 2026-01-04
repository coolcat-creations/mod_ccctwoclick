<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_ccctwoclick
 *
 * Main template for the CCC Two Click module.
 *
 * This template includes several partials for better maintainability:
 * - default_helpers.php    : Helper functions ($escape, $normalizeCssSize, $extractNumeric)
 * - default_variables.php  : Variable initialization and processing
 * - default_card.php       : Privacy card block generation
 * - default_bar.php        : Privacy bar block generation
 * - default_inline_css.php : Inline CSS (when external stylesheet is disabled)
 */
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$layoutBase = $params->get('layout', 'default');

// Load helper functions
require ModuleHelper::getLayoutPath('mod_ccctwoclick', $layoutBase . '_helpers');

// Initialize and process variables
require ModuleHelper::getLayoutPath('mod_ccctwoclick', $layoutBase . '_variables');

// Generate privacy card block
require ModuleHelper::getLayoutPath('mod_ccctwoclick', $layoutBase . '_card');

// Generate privacy bar block
require ModuleHelper::getLayoutPath('mod_ccctwoclick', $layoutBase . '_bar');

// Load inline CSS definitions
require ModuleHelper::getLayoutPath('mod_ccctwoclick', $layoutBase . '_inline_css');

?>
<div class="<?php echo $escape(implode(' ', array_filter($containerClasses))); ?>"
     data-ccctwoclick="<?php echo $moduleId; ?>"
     data-load-delay="<?php echo $loadDelayValue; ?>"
     data-consent-scope="<?php echo $escape($consentScopeValue); ?>"
     data-store-consent="<?php echo $storeConsentValue; ?>"
     data-remember-consent="<?php echo $rememberValue; ?>"
     data-card-slot-pre="<?php echo $escape($cardSlotPre); ?>"
     data-card-slot-post="<?php echo $escape($cardSlotPost); ?>"
     data-bar-slot-pre="<?php echo $escape($barSlotPre); ?>"
     data-bar-slot-post="<?php echo $escape($barSlotPost); ?>"
     role="region"
     aria-label="<?php echo $escape($a11yRegionLabel); ?>">

    <div class="ccctwoclick__slot-group ccctwoclick__slot-group--pre-top">
        <div class="ccctwoclick__card-slot" data-card-slot="pre-top"><?php $cardRenderer('pre-top'); ?></div>
        <div class="ccctwoclick__bar-slot" data-bar-slot="pre-top"><?php $barRenderer('pre-top'); ?></div>
    </div>

    <div class="ccctwoclick__slot-group ccctwoclick__slot-group--post-top">
        <div class="ccctwoclick__card-slot" data-card-slot="post-top"></div>
        <div class="ccctwoclick__bar-slot" data-bar-slot="post-top"></div>
    </div>

    <div class="<?php echo $escape(implode(' ', $placeholderClasses)); ?>"
         data-ccctwoclick-placeholder
         data-source="<?php echo $escape($source); ?>"
         data-width="<?php echo $escape($extractNumeric($normalizedWidth)); ?>"
         data-width-style="<?php echo $escape($normalizedWidth); ?>"
         data-height="<?php echo $escape($extractNumeric($normalizedHeight)); ?>"
         data-height-style="<?php echo $escape($normalizedHeight); ?>"
         data-responsive="<?php echo $isResponsiveActive ? 1 : 0; ?>"
         data-ratio="<?php echo $responsiveRatio ? number_format((float) $responsiveRatio, 6, '.', '') : ''; ?>"
         data-frameborder="<?php echo $escape($iframeFrameborder); ?>"
         data-allowfullscreen="<?php echo $allowFullscreenAttr; ?>"
         data-allowtransparency="<?php echo $allowTransparencyAttr; ?>"
         data-scrolling="<?php echo $escape($scrollingValue); ?>"
         data-iframename="<?php echo $escape($iframeName); ?>"
         data-iframetitle="<?php echo $escape($iframeTitle); ?>"
         data-overlay="<?php echo $overlayVisible; ?>"
         data-bg-image="<?php echo $escape($dataBgImage); ?>"
         data-bg-size="<?php echo $escape($dataBgSize); ?>"
         data-bg-color="<?php echo $escape($dataBgColor); ?>"
         data-video-autoplay="<?php echo (int) $videoAutoplay; ?>"
         style="<?php echo $escape(implode(' ', $placeholderStyles)); ?>">

        <div class="ccctwoclick__overlay-slots">
            <div class="ccctwoclick__card-slot" data-card-slot="pre-overlay"><?php $cardRenderer('pre-overlay'); ?></div>
            <div class="ccctwoclick__bar-slot" data-bar-slot="pre-overlay"><?php $barRenderer('pre-overlay'); ?></div>
        </div>

        <div class="ccctwoclick__media" data-ccctwoclick-media aria-live="polite"></div>
    </div>

    <div class="ccctwoclick__slot-group ccctwoclick__slot-group--pre-bottom">
        <div class="ccctwoclick__card-slot" data-card-slot="pre-bottom"><?php $cardRenderer('pre-bottom'); ?></div>
        <div class="ccctwoclick__bar-slot" data-bar-slot="pre-bottom"><?php $barRenderer('pre-bottom'); ?></div>
    </div>

    <div class="ccctwoclick__slot-group ccctwoclick__slot-group--post-bottom">
        <div class="ccctwoclick__card-slot" data-card-slot="post-bottom"></div>
        <div class="ccctwoclick__bar-slot" data-bar-slot="post-bottom"></div>
    </div>
</div>

<?php if ($stylesheet === 'no') : ?>
    <style><?php echo $inlineBaseCss . $inlineToggleCss; ?></style>
<?php endif; ?>
