html5-fallback-wpcf7
====================

A simple plugin if you want to use the date or number input fields and wish to use a localized jQuery UI-based fallback feature in Contact Form 7.

## What does it do?

Basically it just adds this line ```add_filter( 'wpcf7_support_html5', '__return_false' );``` which could also be in a functions.php of a child theme. But if you don't have a child theme, then this plugin is quite handy.
See also: http://contactform7.com/faq/does-contact-form-7-support-html5-input-types/

Additionally it localizes this datepicker field for all the languages that are avalaible for localization from the jQuery UI website (https://github.com/jquery/jquery-ui/tree/master/ui/i18n).

See also this ticket: https://core.trac.wordpress.org/ticket/29420

## License

This plugin is licensed under GPLv2.

## Usage

Just upload the plugin and activate it. Done! No configuration necessary.