<?php
if (!defined('ABSPATH')) {
	exit;
}

if (class_exists('CSF')) {

	CSF::createSection('exsit_settings', array(
		'title' => esc_html__('Footer', 'exsit-helper'),
		'icon' => 'fas fa-window-maximize',
		'id' => 'exsit_footer',

		'fields' => array(

			array(
				'id' => 'exsit_copyright_text',
				'type' => 'text',
				'title' => esc_html__('Copyright Text', 'exsit-helper'),
				'subtitle' => esc_html__('Add copyright text.', 'exsit-helper'),
				'default' => esc_html__('Exsit Sass © 2026 – All Rights Reserved', 'exsit-helper'),
			),

		),
	));
}