<?php
/*
Plugin Name: Preload LCP Images
Description: A lightweight plugin to preload images for specific pages using page IDs to improve LCP.
Version: 1.1
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function preload_lcp_images_by_id() {
    if (!is_singular()) {
        return; // Only run on singular pages/posts
    }

    // Define page IDs and their respective LCP images
    $preload_images = array(
        12   => '/wp-content/uploads/2023/04/Divi-accountant-banner-1920x864-1.webp',      // Home page
        561 => '/wp-content/uploads/2023/04/CC0-about-us-bannner-1800x450-1.webp',        // About Us
        1292 => '/wp-content/uploads/2023/04/CC0-terms-of-service-banner-1040x345-1.webp'    // Terms of Service
    );

    $current_post_id = get_queried_object_id();

    if (isset($preload_images[$current_post_id])) {
        $image_url = esc_url($preload_images[$current_post_id]);
        echo "<!-- Preload LCP Images -->\n";
        echo "<link rel='preload' as='image' href='{$image_url}' />\n";
        echo "<!-- End Preload LCP Images -->\n";
    }
}
add_action('wp_head', 'preload_lcp_images_by_id', 1);
