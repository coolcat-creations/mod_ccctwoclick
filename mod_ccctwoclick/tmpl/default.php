<?php
// No direct access
defined('_JEXEC') or die;

?>
<script>
	(function () {

		document.addEventListener('DOMContentLoaded', function () {

			(function () {

				var ccctwoclickcontainer = document.querySelectorAll(".ccctwoclickcontainer-<?php echo $moduleId; ?>");

				for (var i = 0; i < ccctwoclickcontainer.length; i++) {

					var enablebtn = ccctwoclickcontainer[i].querySelectorAll(".ccctwoclickreveal-<?php echo $moduleId; ?>" + i);
					var disablebtn = ccctwoclickcontainer[i].querySelectorAll(".ccctwoclickdisable-<?php echo $moduleId; ?>" + i);


					enablebtn[i].addEventListener("click", function (event) {
						console.log(event.currentTarget.getAttribute('data-id'))
						var iframe = document.createElement("iframe");
						var ourCurrentId = event.currentTarget.getAttribute('data-id');
						console.log(ourCurrentId);

						var content = document.querySelector(".ccctwoclick-<?php echo $moduleId; ?>" + ourCurrentId);
						console.log(content);


						var enablebtn = document.querySelector(".ccctwoclickreveal-<?php echo $moduleId; ?>" + ourCurrentId);
						var contentbefore = document.querySelector(".contentbefore-<?php echo $moduleId; ?>" + ourCurrentId);
						var contentafter = document.querySelector(".contentafter-<?php echo $moduleId; ?>" + ourCurrentId);
						var disablebtn = document.querySelector(".ccctwoclickdisable-<?php echo $moduleId; ?>" + ourCurrentId);

					iframe.setAttribute('frameborder', '<?php echo $frameborder; ?>');

					<?php if ($allowfullscreen != "") : ?>
					iframe.setAttribute('allowfullscreen', '<?php echo $allowfullscreen; ?>');
					<?php endif; ?>

					<?php if ($allowtransparency != "") : ?>
					iframe.setAttribute('allowtransparency', '<?php echo $allowtransparency; ?>');
					<?php endif; ?>

					iframe.setAttribute('scrolling', '<?php echo $scrolling; ?>');
					iframe.setAttribute('title', '');
					iframe.setAttribute('name', '');
					iframe.setAttribute('width', content.getAttribute('data-width'));
					iframe.setAttribute('height', content.getAttribute('data-height'));
					iframe.setAttribute('src', content.dataset.source);

					content.style.display = "none";
					content.insertAdjacentElement('beforebegin', iframe);

					contentbefore.style.display = 'none';

					disablebtn.style.display = 'block';
					disablebtn.classList.toggle('disablecontent');

					contentafter.style.display = 'block';

				});

				disablebtn[i].addEventListener("click", function (event) {
					console.log(event.currentTarget.getAttribute('data-id'))
					var iframe = document.createElement("iframe");
					var ourCurrentId = event.currentTarget.getAttribute('data-id');
					var content = document.querySelector(".ccctwoclick-" + ourCurrentId);
					var disablebtn = document.querySelector(".ccctwoclickdisable-" + ourCurrentId);
					var contentbefore = document.querySelector(".contentbefore-" + ourCurrentId);
					var contentafter = document.querySelector(".contentafter-" + ourCurrentId);

					content.style.display = 'block';
					content.parentNode.querySelector('iframe').remove();
					disablebtn.style.display = 'none';
					contentbefore.style.display = 'block';
					contentafter.style.display = 'none';
				});
			}

		})();
	});

	})();

</script>


<div class="ccctwoclickcontainer ccctwoclickcontainer-<?php echo $moduleId; ?> <?php echo $moduleclass_sfx; ?>"
     style="width:<?php echo $iwidth; ?>; margin:0 auto;">

	<?php if ($contentbeforepos == 'top') : ?>
		<?php if ($contentBefore != '' || !empty($contentBefore)) : ?>
			<div class="contentbefore-<?php echo $moduleId; ?>">
				<?php echo $contentBefore; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($contentafterpos == 'top') : ?>
		<?php if ($contentAfter != '' || !empty($contentAfter)) : ?>
			<div class="contentafter-<?php echo $moduleId; ?>" style="display:none;">
				<?php echo $contentAfter; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($btndispos == 'top') : ?>
		<a class="<?php echo $btnclassDisable; ?> ccctwoclickdisable-<?php echo $moduleId; ?>"
		   data-id="<?php echo $moduleId; ?>"
		   style="display:none;">
			<?php echo JText::_($btntxtDisable); ?>
		</a>
	<?php endif; ?>

	<?php if ($btnrevpos == 'top') : ?>
		<a class="<?php echo $btnclassEnable; ?> ccctwoclickreveal-<?php echo $moduleId; ?>"
		   data-id="<?php echo $moduleId; ?>">
			<?php echo JText::_($btntxtReveal); ?>
		</a>
	<?php endif; ?>

	<div id="ccctc"
	     class="ccctc ccctwoclick-<?php echo $moduleId; ?>"
	     data-source="<?php echo $isrc; ?>"
	     data-width="<?php echo $iwidth; ?>"
	     data-height="<?php echo $iheight; ?>"
	     style="<?php echo 'width:' . $iwidth . '; height:' . $iheight . ';';
	     if ($disabledimage): echo 'background-image:url(' . $disabledimage . ');'; endif;
	     if ($disabledimage): echo 'background-size:' . $backgroundsize . ';'; endif;
	     if ($disabledimage): echo 'background-repeat: no-repeat;'; endif;
	     if ($disabledcolor): echo 'background-color:' . $disabledcolor . ';'; endif; ?>">


	<?php if ($btnrevpos == 'center' || $contentbeforepos == 'center') : ?>
			<div style="position:relative; <?php echo 'width:' . $iwidth . '; height:' . $iheight . ';'; ?> text-align: center;">
				<?php if ($contentbeforepos == 'center') : ?>
					<?php if ($contentBefore != '' || !empty($contentBefore)) : ?>
						<div class="contentbefore-<?php echo $moduleId; ?>" style="position:relative; top:50%;">
							<?php echo $contentBefore; ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($btnrevpos == 'center') : ?>
					<a class="<?php echo $btnclassEnable; ?> ccctwoclickreveal-<?php echo $moduleId; ?>"
					   data-id="<?php echo $moduleId; ?>"
					   style="position:relative; top:50%;">
						<?php echo JText::_($btntxtReveal); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>

	<?php if ($contentbeforepos == 'bottom') : ?>
		<?php if ($contentBefore != '' || !empty($contentBefore)) : ?>
			<div class="contentbefore-<?php echo $moduleId; ?>">
				<?php echo $contentBefore; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($contentafterpos == 'bottom') : ?>
		<?php if ($contentAfter != '' || !empty($contentAfter)) : ?>
			<div class="contentafter-<?php echo $moduleId; ?>" style="display:none;">
				<?php echo $contentAfter; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($btndispos == 'bottom') : ?>
		<a class="<?php echo $btnclassDisable; ?>  ccctwoclickdisable-<?php echo $moduleId; ?>"
		   style="display:none;"
		   data-id="<?php echo $moduleId; ?>">
			<?php echo JText::_($btntxtDisable); ?></a>
	<?php endif; ?>

	<?php if ($btnrevpos == 'bottom') : ?>
		<a class="<?php echo $btnclassEnable; ?> ccctwoclickreveal-<?php echo $moduleId; ?>"
		   data-id="<?php echo $moduleId; ?>">
			<?php echo JText::_($btntxtReveal); ?></a>
	<?php endif; ?>

</div>






