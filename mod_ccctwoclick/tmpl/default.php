<?php
// No direct access
defined('_JEXEC') or die;

$contentBefore = '<div class="tccontentbefore contentbefore-' . $moduleId . '">' . $contentBefore .'</div>';
$contentBeforeCenter = '<div class="tccontentbefore contentbefore-' . $moduleId . '" style="position:relative; top:50%;">' . $contentBefore .'</div>';

$contentAfter = '<div class="tccontentafter contentafter-' . $moduleId . '" style="display:none;">' . $contentAfter .'</div>';

$btnReveal = '<a class="' . $btnclassEnable . ' ccctwoclickreveal-' . $moduleId . '">' . JText::_($btntxtReveal) .'</a>';
$btnRevealCenter = '<a class="' . $btnclassEnable . ' ccctwoclickreveal-' . $moduleId . '" style="position:relative; top:50%;">' . JText::_($btntxtReveal) .'</a>';
$btnDisable = '<a class="' . $btnclassDisable . '  ccctwoclickdisable-' . $moduleId . '" style="display:none;">' . JText::_($btntxtDisable) .'</a>';

$centered = "";
if ($contentbeforepos == 'center') :
	if ($contentBefore != '' || !empty($contentBefore)) :
	$centered .=  $contentBeforeCenter;
	endif;
endif;

if ($btnrevpos == 'center') :
	$centered .=  $btnRevealCenter;
endif;
?>


<script>
	(function () {

		document.addEventListener('DOMContentLoaded', function () {

			(function () {

				var ccctwoclickcontainer = document.querySelectorAll(".ccctwoclickcontainer-<?php echo $moduleId; ?>");

				for (var i = 0; i < ccctwoclickcontainer.length; i++) {

					var content = ccctwoclickcontainer[i].querySelectorAll(".ccctwoclick-<?php echo $moduleId; ?>");
					var enablebtn = ccctwoclickcontainer[i].querySelectorAll(".ccctwoclickreveal-<?php echo $moduleId; ?>");
					var disablebtn = ccctwoclickcontainer[i].querySelectorAll(".ccctwoclickdisable-<?php echo $moduleId; ?>");
					var contentafter = ccctwoclickcontainer[i].querySelectorAll(".contentafter-<?php echo $moduleId; ?>");
					var contentbefore = ccctwoclickcontainer[i].querySelectorAll(".contentbefore-<?php echo $moduleId; ?>");

					function enableContent() {

							var iframe = document.createElement("iframe");

							iframe.setAttribute('frameborder', '0');
							iframe.setAttribute('allowfullscreen', 'true');
							iframe.setAttribute('allowtransparency', 'true');
							iframe.setAttribute('scrolling', 'no');
							iframe.setAttribute('title', '<?php echo $iframetitle; ?>');

							iframe.setAttribute('name', '<?php echo $iframename; ?>');
							iframe.setAttribute('width', content[0].dataset.width);
							iframe.setAttribute('height', content[0].dataset.height);

							iframe.setAttribute('src', content[0].dataset.source);

							content[0].innerHTML = "";
							content[0].appendChild(iframe);

							enablebtn[0].style.display = 'none';
							contentbefore[0].style.display = 'none';

							disablebtn[0].style.display = 'block';
							disablebtn[0].classList.toggle('disablecontent');

							contentafter[0].style.display = 'block';
					}

					document.getElementById("ccctc-<?php echo $moduleId; ?>").addEventListener("click",function(e) {
						// e.target was the clicked element
						if (e.target && e.target.matches("a.ccctwoclickreveal-<?php echo $moduleId; ?>")) {
							enableContent();
						}
					});

					enablebtn[0].addEventListener("click", function (event) {
						enableContent();
					});

					disablebtn[0].addEventListener("click", function () {
						content[0].innerHTML = "";
						disablebtn[0].style.display = 'none';
						enablebtn[0].style.display = 'block';
						contentbefore[0].style.display = 'block';
						contentafter[0].style.display = 'none';

						<?php if ($btnrevpos == 'center' || $contentbeforepos == 'center') : ?>

						var centered = document.createElement('div');
							centered.style.position='relative';
							centered.style.width='<?php echo $iwidth; ?>';
							centered.style.height='<?php echo $iheight; ?>';
							centered.style.textAlign='center';
							centered.innerHTML = '<?php echo $centered; ?>';

						document.getElementById('ccctc-<?php echo $moduleId; ?>').appendChild(centered);

						<?php endif; ?>

					});
				}
			})();
		});

	})();
</script>


<div class="ccctwoclickcontainer-<?php echo $moduleId; ?> <?php echo $moduleclass_sfx; ?>"
     style="width:<?php echo $iwidth; ?>; margin:0 auto;">


	<?php
	echo ($contentbeforepos == 'top' ? $contentBefore : '');
	echo ($contentafterpos == 'top' ? $contentAfter : '');
	echo ($btndispos == 'top' ? $btnDisable : '');
	echo ($btnrevpos == 'top' ? $btnReveal : '');
	?>

	<div id="ccctc-<?php echo $moduleId; ?>"
	     class="ccctc ccctwoclick-<?php echo $moduleId; ?>"
	     data-source="<?php echo $isrc; ?>"
	     data-width="<?php echo $iwidth; ?>"
	     data-height="<?php echo $iheight; ?>"
	     style="<?php echo 'width:' . $iwidth . '; height:' . $iheight . ';';
	     echo ($disabledimage ? 'background-image:url(' . $disabledimage . '); background-repeat: no-repeat; background-size:' . $backgroundsize . ';' : '');
	     echo ($disabledcolor ? 'background-color:' . $disabledcolor . ';' : ''); ?> ">

		<?php if ($btnrevpos == 'center' || $contentbeforepos == 'center') : ?>
			<div style="position:relative; <?php echo 'width:' . $iwidth . '; height:' . $iheight . ';'; ?> text-align: center;">
				<?php
				echo ($contentbeforepos == 'center' ? $contentBeforeCenter : '');
				echo ($btnrevpos == 'center' ? $btnRevealCenter : '');
				?>
			</div>
		<?php endif; ?>
	</div>

	<?php
	echo ($contentbeforepos == 'bottom' ? $contentBefore : '');
	echo ($contentafterpos == 'bottom' ? $contentAfter : '');
	echo ($btndispos == 'bottom' ? $btnDisable : '');
	echo ($btnrevpos == 'bottom' ? $btnReveal : '');
	?>

</div>
