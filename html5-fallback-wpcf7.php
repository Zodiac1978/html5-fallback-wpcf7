<?php
/*
Plugin Name: Activate HTML5 Fallback for Contact Form 7
Plugin URI: https://torstenlandsiedel.de
Description: If you use the date or number input fields and wish to use a jQuery UI-based fallback feature.
Version: 1.0
Author: Torsten Landsiedel
Author URI: https://torstenlandsiedel.de
*/

/*
http://contactform7.com/faq/does-contact-form-7-support-html5-input-types/
*/

add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

?>