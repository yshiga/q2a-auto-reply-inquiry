<?php

/*
	Plugin Name: Auto Reply Inquiry Plugin
	Plugin URI:
	Plugin Description: Auto reply to inquiry
	Plugin Version: 1.0
	Plugin Date: 2016-07-08
	Plugin Author: 38qa.net
	Plugin Author URI: http://www.question2answer.org/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

// event
qa_register_plugin_module('event', 'qa-auto-reply-inquiry.php', 'qa_auto_reply_inquiry', 'Auto Reply Inquiry Event');
