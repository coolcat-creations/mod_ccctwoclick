<?php
use Joomla\CMS\Helper\ModuleHelper;

/**
 * @package     Joomla.Module
 * @subpackage  Module.Ccctwoclick
 *
 * @copyright   Copyright (C) 2017 COOLCAT creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

$iwidth = $params->get('iframewidth', '800');
$iheight = $params->get('iframeheight', '600');
$frameborder = $params->get('frameborder', '0');
$allowfullscreen = $params->get('allowfullscreen', '');
$scrolling = $params->get('scrolling', 'no');
$allowtransparency = $params->get('allowtransparency', '');
$isrc = $params->get('sourceurl', '');
$iframetitle = $params->get('iframetitle', '');
$iframename = $params->get('iframename', '');
$contentBefore = $params->get('contentbeforereplacement', '');
$contentAfter = $params->get('contentafterreplacement', '');
$btntxtReveal = $params->get('buttontxtreveal', 'MOD_CCCTWOCLICK_BTN_REVEAL_TEXT');
$btnrevpos = $params->get('btnrevpos', 'bottom');
$btndispos = $params->get('btndispos', 'bottom');
$contentbeforepos = $params->get('contentbeforepos', 'bottom');
$contentafterpos = $params->get('contentafterpos', 'bottom');
$btntxtDisable = $params->get('buttontxtdisable', 'MOD_CCCTWOCLICK_BTN_DISABLE_TEXT');
$btnclassDisable = $params->get('buttontxtdisableclass', 'Click to disable');
$btnclassEnable = $params->get('buttontxtrevealclass', 'Click to disable');
$disabledimage = $params->get('disabledimage', '');
$disabledcolor = $params->get('disabledcolor', 'transparent');
$backgroundsize = $params->get('backgroundsize', 'contain');
$stylesheet = $params->get('stylesheet', "yes");
$moduleId = $module->id;
$moduleclass_sfx = $params->get('moduleclass_sfx', '');


require ModuleHelper::getLayoutPath('mod_ccctwoclick', $params->get('layout', 'default'));
