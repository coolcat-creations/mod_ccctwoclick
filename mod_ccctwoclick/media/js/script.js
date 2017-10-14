/**
 * @package     Joomla.Module
 * @subpackage  Module.Ccctwoclick
 *
 * @copyright   Copyright (C) 2017 COOLCAT creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

(function() {

	document.addEventListener('DOMContentLoaded', function() {

		(function() {

			var ccctwoclickcontainer = document.querySelectorAll( ".ccctwoclickcontainer" );

			for (var i = 0; i < ccctwoclickcontainer.length; i++) {

				var content = ccctwoclickcontainer[i].querySelectorAll( ".ccctwoclick" );
				var enablebtn = ccctwoclickcontainer[i].querySelectorAll( ".ccctwoclickreveal" );
				var disablebtn = ccctwoclickcontainer[i].querySelectorAll(".ccctwoclickdisable");
				var contentbefore = ccctwoclickcontainer[i].querySelectorAll(".contentbefore");

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
					content[0].style.backgroundImage = null;
					content[0].style.backgroundRepeat = null;
					content[0].style.backgroundSize = null;

					enablebtn[0].style.display = 'none';
					contentbefore[0].style.display = 'none';

					disablebtn[0].style.display = 'inline';
					disablebtn[0].classList.toggle('disablecontent');

				} );

				disablebtn[0].addEventListener( "click", function() {
					content[0].innerHTML = "";
					disablebtn[0].style.display = 'none';
					enablebtn[0].style.display = 'inline';
					contentbefore[0].style.display = 'block';
					content[0].style.backgroundImage = content[0].dataset.background;
					content[0].style.backgroundRepeat = 'no-repeat';
					content[0].style.backgroundSize = content[0].dataset.backgroundsize;

				} );

			};

		} )();
	});

})();