/**
 * @package     Joomla.Module
 * @subpackage  Module.Ccctwoclick
 *
 * @copyright   Copyright (C) 2017 COOLCAT creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

(function() {

	document.addEventListener('DOMContentLoaded', function() {

		var ccctwoclickcontainer = document.querySelectorAll('.ccctwoclickcontainer');

		for (var i = 0; i < ccctwoclickcontainer.length; i++) {

			var self = ccctwoclickcontainer[i];
			var content = self.querySelector('.ccctwoclick');
			var enablebtn = self.querySelector('.ccctwoclickreveal');
			var disablebtn = self.querySelector('.ccctwoclickdisable');
			var contentbefore = self.querySelector('.contentbefore');

			enablebtn.addEventListener('click', function() {

				var iframe = document.createElement('iframe');

				iframe.setAttribute('frameborder', '0');
				iframe.setAttribute('allowfullscreen', true);
				iframe.setAttribute('allowtransparency', true);
				iframe.setAttribute('scrolling', 'no');
				iframe.setAttribute('title', 'fb:page Facebook Social Plugin');
				iframe.setAttribute('name', 'f2f966e5973af');
				iframe.setAttribute('width', content.dataset.width);
				iframe.setAttribute('height', content.dataset.height);
				iframe.setAttribute('src', content.dataset.source);

				content.innerHTML = '';
				content.appendChild(iframe);
				content.style.backgroundImage = null;
				content.style.backgroundRepeat = null;
				content.style.backgroundSize = null;

				enablebtn.style.display = 'none';
				contentbefore.style.display = 'none';

				disablebtn.style.display = 'inline';
				disablebtn.classList.toggle('disablecontent');
			});

			disablebtn.addEventListener('click', function() {
				content.innerHTML = '';
				disablebtn.style.display = 'none';
				enablebtn.style.display = 'inline';
				contentbefore.style.display = 'block';
				content.style.backgroundImage = content.dataset.background;
				content.style.backgroundRepeat = 'no-repeat';
				content.style.backgroundSize = content.dataset.backgroundsize;
			});

		};

	});

})();
