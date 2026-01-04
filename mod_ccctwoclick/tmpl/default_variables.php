<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_ccctwoclick
 *
 * Variable initialization for the CCC Two Click template.
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// Module identification
$moduleId           = (int) $module->id;
$shouldRenderToggle = $consentControl === 'toggle';
$shouldRenderButton = $consentControl === 'button';

// Privacy card text defaults
$privacyHeading               = $privacyHeadingText !== '' ? $privacyHeadingText : Text::_('MOD_CCCTWOCLICK_PRIVACY_CARD_HEADING_DEFAULT');
$privacyToggleLabelText       = $privacyToggleLabel !== '' ? $privacyToggleLabel : Text::_('MOD_CCCTWOCLICK_PRIVACY_TOGGLE_LABEL_DEFAULT');
$privacyToggleLabelActiveText = $privacyToggleLabelActive !== '' ? $privacyToggleLabelActive : Text::_('MOD_CCCTWOCLICK_PRIVACY_TOGGLE_LABEL_ACTIVE_DEFAULT');
$privacyDetailsTextValue      = trim((string) $privacyDetailsText);
$privacyDetailsToggleText     = $privacyDetailsToggle !== '' ? $privacyDetailsToggle : Text::_('MOD_CCCTWOCLICK_PRIVACY_DETAILS_TOGGLE_SHOW');
$privacyDetailsToggleHideText = $privacyDetailsToggleHide !== '' ? $privacyDetailsToggleHide : Text::_('MOD_CCCTWOCLICK_PRIVACY_DETAILS_TOGGLE_HIDE');
$privacyBarAriaLabel          = trim(strip_tags(Text::_('MOD_CCCTWOCLICK_PRIVACY_HEADING')));

// Position settings
$cardPositionBefore     = trim((string) $params->get('contentbeforepos', ''));
$cardPositionAfter      = trim((string) $params->get('contentafterpos', ''));
$legacyCardPosBefore    = (string) $params->get('privacy_card_position_before', 'bottom');
$legacyCardPosAfter     = (string) $params->get('privacy_card_position_after', 'bottom');
$barPositionBefore      = (string) $params->get('privacy_bar_position_before', 'bottom');
$barPositionAfter       = (string) $params->get('privacy_bar_position_after', 'bottom');

// Consent settings
$consentScopeValue = isset($consentScope) ? (string) $consentScope : 'domain';
$storeConsentValue = isset($storeConsent) ? (int) $storeConsent : 1;
$rememberValue     = isset($rememberAcrossSessions) ? (int) $rememberAcrossSessions : 0;
$loadDelayValue    = isset($loadDelay) ? (int) $loadDelay : 0;

if ($storeConsentValue !== 1) {
    $rememberValue = 0;
}

// iFrame attributes
$iframeTitle           = trim((string) $iframetitle);
$iframeTitle           = $iframeTitle !== '' ? $iframeTitle : Text::_('MOD_CCCTWOCLICK_IFRAME_FALLBACK_TITLE');
$iframeName            = trim((string) $iframename);
$iframeFrameborder     = trim((string) $frameborder) !== '' ? (string) $frameborder : '';
$allowFullscreenAttr   = in_array((string) $allowfullscreen, ['1', 'true', 'yes'], true) ? '1' : '0';
$allowTransparencyAttr = in_array((string) $allowtransparency, ['1', 'true', 'yes'], true) ? '1' : '0';
$scrollingValue        = in_array((string) $scrolling, ['yes', 'no', 'auto'], true) ? (string) $scrolling : 'no';

// Privacy link processing
$privacyNoticeTextValue = trim((string) $privacyNoticeText);
$privacyLinkTextValue   = trim((string) $privacyLinkText);
$privacyLinkUrlValue    = trim((string) $privacyLinkUrl);

if ($privacyLinkTextValue === '') {
    $privacyLinkTextValue = Text::_('MOD_CCCTWOCLICK_PRIVACYLINK_TXT');
}

$privacyLinkUrlValid    = false;
$privacyLinkTargetAttrs = '';
$privacyLinkHref        = '';

if ($privacyBarAriaLabel === '') {
    $privacyBarAriaLabel = Text::_('MOD_CCCTWOCLICK_PRIVACY_CARD_HEADING_DEFAULT');
}

// Normalize card positions
$cardPositionBefore = $cardPositionBefore !== '' ? strtolower($cardPositionBefore) : strtolower($legacyCardPosBefore);
if ($cardPositionBefore === 'center') {
    $cardPositionBefore = 'overlay';
}
$cardPositionBefore = in_array($cardPositionBefore, ['top', 'overlay', 'bottom'], true) ? $cardPositionBefore : 'overlay';

$cardPositionAfter = $cardPositionAfter !== '' ? strtolower($cardPositionAfter) : strtolower($legacyCardPosAfter);
$cardPositionAfter = $cardPositionAfter === 'center' ? 'top' : $cardPositionAfter;
$cardPositionAfter = in_array($cardPositionAfter, ['top', 'bottom'], true) ? $cardPositionAfter : 'top';

// Normalize bar positions
$barPositionBefore = strtolower((string) $barPositionBefore);
$barPositionBefore = $barPositionBefore === 'center' ? 'overlay' : $barPositionBefore;
$barPositionBefore = in_array($barPositionBefore, ['top', 'overlay', 'bottom', 'none'], true) ? $barPositionBefore : 'bottom';

$barPositionAfter = strtolower((string) $barPositionAfter);
$barPositionAfter = ($barPositionAfter === 'center' || $barPositionAfter === 'overlay') ? 'top' : $barPositionAfter;
$barPositionAfter = in_array($barPositionAfter, ['top', 'bottom', 'none'], true) ? $barPositionAfter : 'bottom';

// Validate and process privacy link URL
if ($privacyLinkUrlValue !== '') {
    $trimmedUrl         = ltrim($privacyLinkUrlValue);
    $isAnchor           = strpos($trimmedUrl, '#') === 0;
    $isProtocolRelative = strpos($trimmedUrl, '//') === 0;
    $hasScheme          = (bool) preg_match('#^[a-z][a-z0-9+\-.]*:#i', $trimmedUrl);
    $hasAllowedScheme   = (bool) preg_match('#^(https?|mailto|tel):#i', $trimmedUrl);

    if ($isAnchor) {
        $privacyLinkHref     = $trimmedUrl;
        $privacyLinkUrlValid = true;
    } elseif ($hasAllowedScheme || $isProtocolRelative) {
        $privacyLinkHref     = $trimmedUrl;
        $privacyLinkUrlValid = true;
    } elseif (!$hasScheme) {
        $privacyLinkHref = Route::_($trimmedUrl);

        if ($privacyLinkHref !== '') {
            $privacyLinkUrlValid = true;
        }
    }

    if ($privacyLinkUrlValid) {
        $privacyLinkTargetAttrs = ' target="_blank" rel="noopener noreferrer"';
    }
}

// Container classes
$containerClasses = ['ccctwoclickcontainer', 'ccctwoclickcontainer-' . $moduleId];
if (trim((string) $moduleclass_sfx) !== '') {
    $containerClasses[] = trim((string) $moduleclass_sfx);
}

// Placeholder classes and responsive settings
$isResponsiveActive = (int) $responsiveVideo > 0;
$placeholderClasses = ['ccctwoclick__placeholder'];
if ($isResponsiveActive) {
    $placeholderClasses[] = 'ccctwoclick__placeholder--responsive';
}

// Dimensions
$normalizedWidth  = $normalizeCssSize($iwidth);
$normalizedHeight = $normalizeCssSize($iheight);

if ($normalizedWidth === '') {
    $normalizedWidth = '100%';
}

// Overlay settings
$overlayEnabled    = (int) $backgroundOverlayEnable === 1;
$overlayColorValue = $overlayEnabled ? ($backgroundOverlayColor !== '' ? $backgroundOverlayColor : 'rgba(0, 0, 0, 0.6)') : 'rgba(0, 0, 0, 0)';
$overlayBlurValue  = $overlayEnabled && (int) $backgroundOverlayBlur > 0 ? 'blur(' . (int) $backgroundOverlayBlur . 'px)' : 'none';
$overlayVisible    = $overlayEnabled ? '1' : '0';

// Background settings
$dataBgImage = $disabledimage !== '' ? trim((string) $disabledimage) : '';
$dataBgSize  = $backgroundsize !== '' ? $backgroundsize : 'auto';
$dataBgColor = $disabledcolor !== '' ? $disabledcolor : 'transparent';

// Build placeholder inline styles
$placeholderStyles   = [];
$placeholderStyles[] = 'width:' . $normalizedWidth . ';';
$placeholderStyles[] = 'max-width:100%;';

if ($isResponsiveActive && !empty($responsiveRatio)) {
    $placeholderStyles[] = '--ccctwo-responsive-ratio:' . (float) $responsiveRatio . ';';
    $placeholderStyles[] = 'aspect-ratio:' . (float) $responsiveRatio . ';';
    $placeholderStyles[] = 'height:auto;';
} elseif ($normalizedHeight !== '') {
    $placeholderStyles[] = 'height:' . $normalizedHeight . ';';
}

if ($dataBgColor !== '') {
    $placeholderStyles[] = 'background-color:' . $dataBgColor . ';';
}

if ($dataBgImage !== '') {
    $placeholderStyles[] = 'background-image:url(' . $escape($dataBgImage) . ');';
    $placeholderStyles[] = 'background-repeat:no-repeat;';
    $placeholderStyles[] = 'background-position:center;';
    $placeholderStyles[] = 'background-size:' . $dataBgSize . ';';
}

$placeholderStyles[] = '--ccctwo-overlay-color:' . $escape($overlayColorValue) . ';';
$placeholderStyles[] = '--ccctwo-overlay-blur:' . $escape($overlayBlurValue) . ';';
$placeholderStyles[] = '--ccctwo-overlay-visible:' . $overlayVisible . ';';

// Layout mode
$isIntegratedLayout = isset($privacyBarLayout) && $privacyBarLayout === 'integrated';

// Slot keys
$cardSlotPre = 'pre-' . $cardPositionBefore;
if (!in_array($cardSlotPre, ['pre-top', 'pre-overlay', 'pre-bottom'], true)) {
    $cardSlotPre = 'pre-overlay';
}

$cardSlotPost = 'post-' . $cardPositionAfter;
if (!in_array($cardSlotPost, ['post-top', 'post-bottom'], true)) {
    $cardSlotPost = 'post-top';
}
