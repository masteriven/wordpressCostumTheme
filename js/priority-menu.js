(function() {

	function debounce(func, wait, immediate) {
		'use strict';

		var timeout;
		wait      = (typeof wait !== 'undefined') ? wait : 20;
		immediate = (typeof immediate !== 'undefined') ? immediate : true;

		return function() {

			var context = this, args = arguments;
			var later = function() {
				timeout = null;

				if (!immediate) {
					func.apply(context, args);
				}
			};

			var callNow = immediate && !timeout;

			clearTimeout(timeout);
			timeout = setTimeout(later, wait);

			if (callNow) {
				func.apply(context, args);
			}
		};
	}


	function prependElement(container, element) {
		if (container.firstChild.nextSibling) {
			return container.insertBefore(element, container.firstChild.nextSibling);
		} else {
			return container.appendChild(element);
		}
	}

	function showButton(element) {
		element.className = element.className.replace('is-empty', '');
	}


	function hideButton(element) {
		if (!element.classList.contains('is-empty')) {
			element.className += ' is-empty';
		}
	}

	
	function getAvailableSpace( button, container ) {
		return container.offsetWidth - button.offsetWidth - 22;
	}

	function isOverflowingNavivation( list, button, container ) {
		return list.offsetWidth > getAvailableSpace( button, container );
	}

	var navContainer = document.querySelector('.main-navigation');
	var breaks       = [];

	if ( ! navContainer ) {
		return;
	}

	function updateNavigationMenu( container ) {

		if ( ! container.parentNode.querySelector('.main-menu[id]') ) {
			return;
		}

		var visibleList  = container.parentNode.querySelector('.main-menu[id]');
		var hiddenList   = visibleList.parentNode.nextElementSibling.querySelector('.hidden-links');
		var toggleButton = visibleList.parentNode.nextElementSibling.querySelector('.main-menu-more-toggle');

		if ( isOverflowingNavivation( visibleList, toggleButton, container ) ) {

			breaks.push( visibleList.offsetWidth );
			prependElement( hiddenList, ! visibleList.lastChild || null === visibleList.lastChild ? visibleList.previousElementSibling : visibleList.lastChild );
			showButton( toggleButton );

		} else {

			if ( getAvailableSpace( toggleButton, container ) > breaks[breaks.length - 1] ) {
				visibleList.appendChild( hiddenList.firstChild.nextSibling );
				breaks.pop();
			}

			if (breaks.length < 2) {
				hideButton( toggleButton );
			}
		}

		if ( isOverflowingNavivation( visibleList, toggleButton, container ) ) {
			updateNavigationMenu( container );
		}
	}


	document.addEventListener( 'DOMContentLoaded', function() {

		updateNavigationMenu( navContainer );

		var hasSelectiveRefresh = (
			'undefined' !== typeof wp &&
			wp.customize &&
			wp.customize.selectiveRefresh &&
			wp.customize.navMenusPreview.NavMenuInstancePartial
		);

		if ( hasSelectiveRefresh ) {
			wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function ( placement ) {

				var isNewNavMenu = (
					placement &&
					placement.partial.id.includes( 'nav_menu_instance' ) &&
					'null' !== placement.container[0].parentNode &&
					placement.container[0].parentNode.classList.contains( 'main-navigation' )
				);

				if ( isNewNavMenu ) {
					updateNavigationMenu( placement.container[0].parentNode );
				}
			});
        }
	});


	window.addEventListener( 'load', function() {
		updateNavigationMenu( navContainer );
	});

	var isResizing = false;
	window.addEventListener( 'resize',
		debounce( function() {
			if ( isResizing ) {
				return;
			}

			isResizing = true;
			setTimeout( function() {
				updateNavigationMenu( navContainer );
				isResizing = false;
			}, 150 );
		} )
	);

	updateNavigationMenu( navContainer );

})();
