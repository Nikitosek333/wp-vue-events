<?php
function register_event_post_type() {
	register_post_type('event', [
		'labels' => [
			'name' => __('Events'),
			'singular_name' => __('Event'),
		],
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true, // включаем поддержку REST API
		'supports' => ['title', 'editor', 'custom-fields'],
	]);
}
add_action('init', 'register_event_post_type');


add_action('rest_api_init', function () {
	register_rest_route('custom/v1', '/events', [
		'methods' => 'GET',
		'callback' => 'get_custom_events',
		'permission_callback' => '__return_true',
	]);
});

function get_custom_events() {
	$args = [
		'post_type' => 'event',
		'posts_per_page' => -1,
	];
	$query = new WP_Query($args);

	$events = [];

	while ($query->have_posts()) {
		$query->the_post();
		$events[] = [
			'id' => get_the_ID(),
			'title' => get_the_title(),
			'content' => get_the_content(),
		];
	}

	wp_reset_postdata();

	return $events;
}

add_action('init', function () {
	header("Access-Control-Allow-Origin: *");
});
