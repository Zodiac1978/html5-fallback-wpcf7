<?php
/**
 * Plugin Name: Activate HTML5 Fallback for Contact Form 7
 * Description: If you use the date or number input fields and wish to use a localized jQuery UI-based fallback feature in Contact Form 7.
 * Version: 1.1.0
 * Author: Torsten Landsiedel
 * Author URI: http://torstenlandsiedel.de
 * Plugin URI: https://github.com/Zodiac1978/html5-fallback-wpcf7
 * Text Domain: html5-fallback-wpcf7
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0
 */


/*
 *This should be done outside of this plugin - just for testing purpose here
 */

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_action( 'wp_enqueue_scripts', 'reregister_cf7_javascript' );
function reregister_cf7_javascript() {
	if ( is_page( array( 1395, 1035 ) ) ) {
		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
		}
		if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        		wpcf7_enqueue_styles();
    		}
    	}
}

/*
Activate HTML5 fallback support
See: http://contactform7.com/faq/does-contact-form-7-support-html5-input-types/
*/

add_filter( 'wpcf7_support_html5_fallback', '__return_true' );


/*
Add l18n for datepicker
See: http://wordpress.org/support/topic/adding-translation-to-ui-datepicker
Props: http://wordpress.org/support/profile/prometee
*/

/**
 * Get the locale according to the format available in the jquery ui i18n file list
 *
 * @url https://github.com/jquery/jquery-ui/tree/master/ui/i18n
 * @return string ex: "fr" ou "en-GB"
 */
function getJqueryUII18nLocale() {
	//replace _ by - in "en_GB" for example
	$locale = str_replace( '_', '-', get_locale() );
	switch ( $locale ) {
		case 'ar-DZ':
		case 'cy-GB':
		case 'en-AU':
		case 'en-GB':
		case 'en-NZ':
		case 'fr-CA':
		case 'fr-CH':
		case 'nl-BE':
		case 'nl-BE':
		case 'pt-BR':
		case 'sr-SR':
		case 'zh-CN':
		case 'zh-HK':
		case 'zh-TW':
			// For all this locale do nothing the file already exist
			break;
		default:
			// for other locale keep the first part of the locale (ex: "fr-FR" -> "fr")
			$locale = substr( $locale, 0, strpos( $locale, '-' ) );
			// English is the default locale = empty string
			$locale = ( $locale == 'en' ) ? '' : $locale;
			break;
	}
	return $locale;
}

function add_l18n_datepicker_script() {
	// Just add l18n script if cf7 is really loaded on this page/post
	if ( ! wp_script_is( 'contact-form-7' ) ) { return; }

	// Get the WP built-in version from jQuery UI
	$wp_jquery_ui_ver = $GLOBALS['wp_scripts']->registered['jquery-ui-core']->ver;

	$locale = getJqueryUII18nLocale();
	if ( ''  != $locale ) { // Just add l18n if language is not EN (empty string)
		/* CDN */
		// wp_enqueue_script( 'jquery-ui-i18n-' . $locale, 'http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-' . $locale . '.js', array( 'jquery-ui-datepicker' ), $wp_jquery_ui_ver, true );
		/* local */
		wp_enqueue_script( 'jquery-ui-i18n-' . $locale, plugins_url( '/i18n/jquery.ui.datepicker-' . $locale . '.js' , __FILE__ ) , array( 'jquery-ui-datepicker' ), $wp_jquery_ui_ver, true );
	}
}

add_action( 'wp_enqueue_scripts' , 'add_l18n_datepicker_script' );
