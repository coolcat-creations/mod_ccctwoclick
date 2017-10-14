<?php
/**
 * @package     Joomla.Module
 * @subpackage  Module.Ccctwoclick
 *
 * @copyright   Copyright (C) 2017 COOLCAT creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


JHtml::_('script', 'media/mod_ccctwoclick/js/script.js');

if ($stylesheet == "yes") :
	JHtml::_('stylesheet', 'media/mod_ccctwoclick/css/style.css');
endif;

?>

<div class="ccctwoclickcontainer <?php echo $moduleclass_sfx; ?>" style="width:<?php echo $iwidth; ?>;">

    <div class="ccctwoclick" data-source="<?php echo $isrc; ?>" data-width="<?php echo $iwidth; ?>"
         data-height="<?php echo $iheight; ?>"
         style="width:<?php echo $iwidth; ?>; height:<?php echo $iheight; ?>; <?php if ($disabledimage) : ?>background:url(<?php echo $disabledimage; ?>) no-repeat; background-size:<?php echo $backgroundsize; ?>;<?php endif; ?>">
    </div>

    <div class="contentbefore">
		<?php echo $contentBefore; ?>
    </div>

    <a class="btn btn-primary ccctwoclickreveal"> <?php echo JTEXT::_($btntxtReveal); ?></a>
    <a class="btn btn-secondary ccctwoclickdisable" style="display:none;"><?php echo JTEXT::_($btntxtDisable); ?></a>
</div>


