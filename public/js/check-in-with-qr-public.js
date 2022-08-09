// To use Html5QrcodeScanner (more info below)
import {
	Html5QrcodeScanner
} from "html5-qrcode"

(function ($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).on('load', function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practice to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function () {
		function onScanSuccess(decodedText, decodedResult) {
			// handle the scanned code as you like, for example:
			console.log(`Code matched = ${decodedText}`, decodedResult);
		}

		let config = {
			fps: 10,
			qrbox: {
				width: 250,
				height: 250
			},
			rememberLastUsedCamera: true,
		};

		let html5QrcodeScanner = new Html5QrcodeScanner(
			"qr-reader", config, /* verbose= */ false);
		html5QrcodeScanner.render(onScanSuccess);
	});

})(jQuery);