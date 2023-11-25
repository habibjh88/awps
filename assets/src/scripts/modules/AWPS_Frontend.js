/**
 * A class that handles frontend functionality for the AWPS theme.
 *
 * @class Frontend
 *
 * @param {jQuery} $ - The jQuery object.
 */

/* global rtsbToastr, rtsbPublicParams */

export class AWPS_Frontend {
	/**
	 * Constructor for RtsbFrontend class
	 *
	 * @param {jQuery} $ - jQuery object
	 */
	constructor($) {
		this.$ = $;
	}

	/**
	 * Initializes the RtsbFrontend class when the DOM is ready.
	 *
	 * @function
	 */
	init() {
		this.menuClass();
	}



	/**
	 * Fixes the builder jumping issue.
	 *
	 * @function
	 */
	menuClass() {
		this.$('.rtsb-builder-content').removeClass('content-invisible');
	}
}
