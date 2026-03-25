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

			array(
				'id' => 'exsit_footer_bottom_background',
				'type' => 'color',
				'title' => esc_html__('Background Color', 'exsit-helper'),
				'output' => '.footer-wrapper',
				'output_mode' => 'background-color',
			),

			array(
				'id' => 'exsit_footer_copyright_color',
				'type' => 'color',
				'title' => esc_html__('Footer Copyright Text Color', 'exsit-helper'),
				'subtitle' => esc_html__('Set footer copyright text color.', 'exsit-helper'),
				'output' => array('p.copyright-text'),
			),

			array(
				'id' => 'exsit_footer_copyright_link_color',
				'type' => 'color',
				'title' => esc_html__('Footer Copyright Link Color', 'exsit-helper'),
				'subtitle' => esc_html__('Set footer copyright link color.', 'exsit-helper'),
				'output' => array('p.copyright-text > a'),
			),

			array(
				'id' => 'exsit_footer_copyright_link_hover_color',
				'type' => 'color',
				'title' => esc_html__('Footer Copyright Link Hover Color', 'exsit-helper'),
				'subtitle' => esc_html__('Set footer copyright link hover color.', 'exsit-helper'),
				'output' => array('p.copyright-text a:hover'),
			),

			array(
				'id' => 'exsit_footer_padding',
				'type' => 'spacing',
				'title' => esc_html__('Footer Padding', 'exsit-helper'),
				'units' => array('em', 'px'),
				'output' => '.footer-wrapper',
				'output_mode' => 'padding',
			),

		),
	));
}