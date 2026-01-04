<?php

/**
 * @package     Joomla.Module
 * @subpackage  mod_ccctwoclick
 *
 * @copyright   Copyright (C) 2025 COOLCAT creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die();

$app       = Factory::getApplication();
$document  = $app->getDocument();
$webAssets = $document->getWebAssetManager();

$stylesheet = $params->get('stylesheet', 'yes');

if ($stylesheet !== 'no') {
	if (!$webAssets->assetExists('style', 'mod_ccctwoclick.styles')) {
		$webAssets->registerStyle(
			'mod_ccctwoclick.styles',
			'media/mod_ccctwoclick/css/style.css',
			[],
			['version' => 'auto']
		);
	}

	$webAssets->useStyle('mod_ccctwoclick.styles');
}

if (!$webAssets->assetExists('script', 'mod_ccctwoclick.script')) {
	$webAssets->registerScript(
		'mod_ccctwoclick.script',
		'media/mod_ccctwoclick/js/mod_ccctwoclick.js',
		[],
		[
			'version' => 'auto',
			'defer'   => true,
		]
	);
}

$webAssets->useScript('mod_ccctwoclick.script');

$iwidth            = $params->get('iframewidth', '800');
$iheight           = $params->get('iframeheight', '600');
$frameborder       = $params->get('frameborder', '0');
$allowfullscreen   = $params->get('allowfullscreen', '');
$scrolling         = $params->get('scrolling', 'no');
$allowtransparency = $params->get('allowtransparency', '');
$responsiveVideo   = (int) $params->get('responsivevideo', 1);
$responsiveRatio   = null;

if ($responsiveVideo) {
	$ratioPreset = trim((string) $params->get('responsive_ratio', '16:9'));

	$ratioMap = [
		'16:9'  => 16 / 9,
		'4:3'   => 4 / 3,
		'21:9'  => 21 / 9,
		'1:1'   => 1,
		'9:16'  => 9 / 16,
	];

	if (isset($ratioMap[$ratioPreset])) {
		$responsiveRatio = $ratioMap[$ratioPreset];
	} else {
		$widthRaw  = trim((string) $iwidth);
		$heightRaw = trim((string) $iheight);
		$widthVal  = null;
		$heightVal = null;

		if ($widthRaw !== '' && preg_match('/^\d+(?:\.\d+)?\s*(?:px)?$/i', $widthRaw)) {
			$widthVal = (float) $widthRaw;
		}

		if ($heightRaw !== '' && preg_match('/^\d+(?:\.\d+)?\s*(?:px)?$/i', $heightRaw)) {
			$heightVal = (float) $heightRaw;
		}

		$responsiveRatio = 16 / 9;

		if ($widthVal > 0 && $heightVal > 0) {
			$responsiveRatio = $widthVal / $heightVal;
		}
	}
}

$rawSource = trim((string) $params->get('sourceurl', ''));
$source    = $rawSource;

if (preg_match('/src=["\']([^"\']+)["\']/', $rawSource, $match)) {
	$source = $match[1];
}

$source = trim($source);

if ($source !== '') {
	if (strpos($source, '//') === 0) {
		$scheme = Uri::getInstance(Uri::root())->getScheme() ?: 'https';
		$source = $scheme . ':' . $source;
	} elseif ($source[0] === '/' || stripos($source, 'index.php') === 0) {
		$source = rtrim(Uri::root(), '/') . '/' . ltrim($source, '/');
	}
}

if ($source !== '' && !filter_var($source, FILTER_VALIDATE_URL)) {
	$source = '';
}

$iframetitle              = $params->get('iframetitle', '');
$iframename               = $params->get('iframename', '');
$contentBefore            = $params->get('contentbeforereplacement', '');
$contentAfter             = $params->get('contentafterreplacement', '');
$btntxtReveal             = $params->get('buttontxtreveal', 'MOD_CCCTWOCLICK_BTN_REVEAL_TEXT');
$btntxtDisable            = $params->get('buttontxtdisable', 'MOD_CCCTWOCLICK_BTN_DISABLE_TEXT');
$btnclassDisable          = $params->get('buttontxtdisableclass', 'btn btn-secondary');
$btnclassEnable           = $params->get('buttontxtrevealclass', 'btn btn-primary');
$disabledimage            = $params->get('disabledimage', '');
$disabledcolor            = $params->get('disabledcolor', 'transparent');
$backgroundsize           = $params->get('backgroundsize', 'contain');
$backgroundOverlayEnable  = (int) $params->get('background_overlay_enable', 0);
$backgroundOverlayColor   = $params->get('background_overlay_color', 'rgba(0,0,0,0.6)');
$backgroundOverlayBlur    = (int) $params->get('background_overlay_blur', 0);
$videoAutoplay            = (int) $params->get('video_autoplay', 0);
$consentControl           = $params->get('consent_control', 'toggle');
$privacyHeadingText       = trim((string) $params->get('privacy_heading_text', ''));
$privacyToggleLabel       = trim((string) $params->get('privacy_toggle_label', ''));
$privacyToggleLabelActive = trim((string) $params->get('privacy_toggle_label_active', ''));
$privacyNoticeText        = trim((string) $params->get('privacy_notice_text', ''));
$privacyLinkText          = trim((string) $params->get('privacy_link_text', ''));
$privacyLinkUrl           = trim((string) $params->get('privacy_link_url', ''));
$extendedPrivacyEnable    = (int) $params->get('extended_privacy_enable', 0);
$privacyDetailsText       = $params->get('privacy_details_text', '');
$privacyDetailsToggle     = trim((string) $params->get('privacy_details_toggle_label', ''));
$privacyDetailsToggleHide = trim((string) $params->get('privacy_details_toggle_label_hide', ''));
$privacyContainerPosition = $params->get('privacy_container_position', 'auto');
$cardBackgroundColor      = trim((string) $params->get('card_background_color', 'rgba(255,255,255,0.95)'));
$cardBorderRadius         = trim((string) $params->get('card_border_radius', '0.85rem'));
$cardTextColor            = trim((string) $params->get('card_text_color', ''));
$cardBoxShadow            = trim((string) $params->get('card_box_shadow', '0 14px 28px rgba(15, 23, 42, 0.16)'));
$barBackgroundColor       = trim((string) $params->get('bar_background_color', 'rgba(255,255,255,0.7)'));
$barBorderRadius          = trim((string) $params->get('bar_border_radius', '0.65rem'));
$barTextColor             = trim((string) $params->get('bar_text_color', ''));
$barBoxShadow             = trim((string) $params->get('bar_box_shadow', 'none'));
$privacyBarLayout         = $params->get('privacy_bar_layout', 'separate');
$moduleId                 = (int) $module->id;
$moduleclass_sfx          = $params->get('moduleclass_sfx', '');
$storeConsent             = (int) $params->get('store_consent', 1);
$rememberAcrossSessions   = (int) $params->get('remember_across_sessions', 0);
$consentScope             = $params->get('consent_scope', 'domain');
$loadDelay                = (int) $params->get('load_delay', 600);
$a11yRegionLabel          = trim((string) $params->get('a11y_region_label', ''));

if (!in_array($consentControl, ['toggle', 'button'], true)) {
	$consentControl = 'toggle';
}

if (!in_array($consentScope, ['module', 'domain', 'global'], true)) {
	$consentScope = 'domain';
}

if ($loadDelay < 0) {
	$loadDelay = 0;
}

if ($a11yRegionLabel === '') {
	$a11yRegionLabel = Text::_('MOD_CCCTWOCLICK_A11Y_REGION_LABEL');
}

if (!$storeConsent) {
	$rememberAcrossSessions = 0;
}

$document->addScriptOptions(
	'mod_ccctwoclick.' . $moduleId,
	[
		'moduleId'               => $moduleId,
		'loadDelay'              => $loadDelay,
		'consentScope'           => $consentScope,
		'storeConsent'           => (bool) $storeConsent,
		'rememberAcrossSessions' => (bool) $rememberAcrossSessions,
	]
);

require ModuleHelper::getLayoutPath('mod_ccctwoclick', $params->get('layout', 'default'));
