<?php
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
$allowtransparency = $params->get('allowtransparency', '');
$scrolling = $params->get('scrolling', '');
$allowtransparency = $params->get('allowtransparency', '');
$isrc = $params->get('sourceurl', '');
$contentBefore = $params->get('contentbeforereplacement', '');
$btntxtReveal = $params->get('buttontxtreveal', 'MOD_CCCTWOCLICK_BTN_REVEAL_TEXT');
$btntxtDisable = $params->get('buttontxtdisable', 'MOD_CCCTWOCLICK_BTN_DISABLE_TEXT');
$btnclassDisable = $params->get('buttontxtrevealclass', 'Click to disable');
$btnclassEnable = $params->get('buttontxtdisableclass', 'Click to disable');
$disabledimage = $params->get('disabledimage', '');
$backgroundsize = $params->get('backgroundsize', '');
$stylesheet = $params->get('stylesheet', "yes");
$moduleId = $module->id;

require JModuleHelper::getLayoutPath('mod_ccctwoclick', $params->get('layout', 'default'));
