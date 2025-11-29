<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function() {
	register_rest_route( 'wens-track/v1', '/products', array(
		'methods' => 'GET',
		'callback' => 'wens_track_get_products',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'wens-track/v1', '/products/(?P<id>\d+)', array(
		'methods' => 'GET',
		'callback' => 'wens_track_get_product',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'wens-track/v1', '/cart', array(
		'methods' => 'GET',
		'callback' => 'wens_track_get_cart',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'wens-track/v1', '/cart', array(
		'methods' => 'POST',
		'callback' => 'wens_track_add_to_cart',
		'permission_callback' => '__return_true',
	) );
} );

function wens_track_get_products( $request ) {
	$page = $request->get_param( 'page' ) ?? 1;
	$per_page = $request->get_param( 'per_page' ) ?? 12;

	return array(
		'success' => true,
		'data' => array(
			array(
				'id' => 1,
				'name' => 'Premium T-Shirt',
				'description' => 'High quality cotton t-shirt',
				'price' => 29.99,
				'image' => get_theme_file_uri() . '/assets/images/four.jpg',
				'rating' => 5,
				'reviews' => 128,
				'variants' => array(
					array( 'type' => 'Size', 'options' => array( 'XS', 'S', 'M', 'L', 'XL', 'XXL' ) ),
					array( 'type' => 'Color', 'options' => array( 'Black', 'White', 'Navy', 'Gray', 'Red' ) ),
				),
				'stock' => 245,
			),
			array(
				'id' => 2,
				'name' => 'Classic Sneakers',
				'description' => 'Comfortable everyday sneakers',
				'price' => 79.99,
				'old_price' => 99.99,
				'image' => get_theme_file_uri() . '/assets/images/five.jpg',
				'rating' => 4,
				'reviews' => 95,
				'variants' => array(
					array( 'type' => 'Size', 'options' => array( '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45' ) ),
					array( 'type' => 'Color', 'options' => array( 'Black', 'White', 'Navy', 'Gray' ) ),
				),
				'stock' => 156,
			),
			array(
				'id' => 3,
				'name' => 'Leather Backpack',
				'description' => 'Premium leather backpack',
				'price' => 149.99,
				'image' => get_theme_file_uri() . '/assets/images/six.jpg',
				'rating' => 5,
				'reviews' => 203,
				'variants' => array(
					array( 'type' => 'Color', 'options' => array( 'Black', 'Brown', 'Tan' ) ),
				),
				'stock' => 89,
			),
		),
	);
}

function wens_track_get_product( $request ) {
	$id = $request->get_param( 'id' );

	$products = array(
		array(
			'id' => 1,
			'name' => 'Premium T-Shirt',
			'description' => 'High-quality cotton t-shirt with a comfortable fit. Perfect for everyday wear, this premium tee combines style and comfort. Made from 100% organic cotton for maximum breathability and softness.',
			'price' => 29.99,
			'old_price' => 49.99,
			'image' => get_theme_file_uri() . '/assets/images/four.jpg',
			'gallery' => array(
				get_theme_file_uri() . '/assets/images/four.jpg',
				get_theme_file_uri() . '/assets/images/five.jpg',
				get_theme_file_uri() . '/assets/images/six.jpg',
			),
			'rating' => 5,
			'reviews' => 128,
			'sku' => 'TS-BLK-M-001',
			'material' => '100% Organic Cotton',
			'care' => 'Machine wash cold, tumble dry low',
			'features' => array(
				'Premium organic cotton fabric',
				'Pre-shrunk for perfect fit',
				'Reinforced shoulder seams',
				'Tag-free for maximum comfort',
				'Eco-friendly dyes',
			),
			'variants' => array(
				array( 'type' => 'Size', 'options' => array( 'XS', 'S', 'M', 'L', 'XL', 'XXL' ) ),
				array( 'type' => 'Color', 'options' => array( 'Black', 'White', 'Navy', 'Gray', 'Red' ) ),
			),
			'stock' => 245,
		),
	);

	$product = array_filter( $products, function( $p ) use ( $id ) {
		return $p['id'] == $id;
	} );

	if ( empty( $product ) ) {
		return new WP_Error( 'not_found', 'Product not found', array( 'status' => 404 ) );
	}

	return array(
		'success' => true,
		'data' => reset( $product ),
	);
}

function wens_track_get_cart( $request ) {
	$cart = WP_Session_Tokens::get_token( wp_get_current_user()->ID ) ?? array();

	return array(
		'success' => true,
		'items' => $cart,
		'count' => count( $cart ),
	);
}

function wens_track_add_to_cart( $request ) {
	$params = $request->get_json_params();

	if ( ! isset( $params['product_id'] ) ) {
		return new WP_Error( 'missing_param', 'Product ID is required', array( 'status' => 400 ) );
	}

	return array(
		'success' => true,
		'message' => 'Product added to cart',
		'product_id' => $params['product_id'],
	);
}
