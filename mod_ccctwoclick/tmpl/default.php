<?php
/**
 * @package     Joomla.Module
 * @subpackage  Module.Ccctwoclick
 *
 * @copyright   Copyright (C) 2017 COOLCAT creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

<script>
	(function() {

		document.addEventListener('DOMContentLoaded', function() {

			(function() {

				var ccctwoclickcontainer = document.querySelectorAll( ".ccctwoclickcontainer-<?php echo $moduleId; ?>" );

				for (var i = 0; i < ccctwoclickcontainer.length; i++) {

					var content = ccctwoclickcontainer[i].querySelectorAll( ".ccctwoclick-<?php echo $moduleId; ?>" );
					var enablebtn = ccctwoclickcontainer[i].querySelectorAll( ".ccctwoclickreveal-<?php echo $moduleId; ?>" );
					var disablebtn = ccctwoclickcontainer[i].querySelectorAll(".ccctwoclickdisable-<?php echo $moduleId; ?>");
					var contentbefore = ccctwoclickcontainer[i].querySelectorAll(".contentbefore-<?php echo $moduleId; ?>");

					enablebtn[0].addEventListener( "click", function() {

						var iframe = document.createElement( "iframe" );

						iframe.setAttribute( 'frameborder', '0' );
						iframe.setAttribute( 'allowfullscreen', 'true' );
						iframe.setAttribute( 'allowtransparency', 'true' );
						iframe.setAttribute( 'scrolling', 'no' );
						iframe.setAttribute( 'title', 'fb:page Facebook Social Plugin');

						iframe.setAttribute( 'name', 'f2f966e5973af' );
						iframe.setAttribute( 'width', content[0].dataset.width );
						iframe.setAttribute( 'height', content[0].dataset.height );

						iframe.setAttribute( 'src', content[0].dataset.source );

						content[0].innerHTML = "";
						content[0].appendChild( iframe );


						enablebtn[0].style.display = 'none';
						contentbefore[0].style.display = 'none';

						disablebtn[0].style.display = 'block';
						disablebtn[0].classList.toggle('disablecontent');

					} );

					disablebtn[0].addEventListener( "click", function() {
						content[0].innerHTML = "";
						disablebtn[0].style.display = 'none';
						enablebtn[0].style.display = 'block';
						contentbefore[0].style.display = 'block';

					} );

					};

			} )();
		});

	})();
</script>

if ($stylesheet == "yes") :
	JHtml::_('stylesheet', 'media/mod_ccctwoclick/css/style.css');
endif;

?>

<div class="ccctwoclickcontainer <?php echo $moduleclass_sfx; ?>" style="width:<?php echo $iwidth; ?>;">

    <div class="ccctwoclick" data-source="<?php echo $isrc; ?>" data-width="<?php echo $iwidth; ?>"
         data-height="<?php echo $iheight; ?>" data-background="url(<?php echo $disabledimage; ?>)" data-backgroundsize="<?php echo $backgroundsize; ?>"
         style="width:<?php echo $iwidth; ?>; height:<?php echo $iheight; ?>; <?php if ($disabledimage) : ?>background-image:url(<?php echo $disabledimage; ?>); background-repeat:no-repeat; background-size:<?php echo $backgroundsize; ?>;<?php endif; ?>">
    </div>

    <div class="contentbefore">
		<?php echo $contentBefore; ?>
    </div>

    <a class="btn btn-primary ccctwoclickreveal"> <?php echo JText::_($btntxtReveal); ?></a>
    <a class="btn btn-secondary ccctwoclickdisable" style="display:none;"><?php echo JText::_($btntxtDisable); ?></a>
</div>
