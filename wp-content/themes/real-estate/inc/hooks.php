<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

// Izinkan upload WebP dan AVIF
function allow_modern_image_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('mime_types', 'allow_modern_image_upload');

// Fix verifikasi file WebP & AVIF
function fix_image_upload_check($checked, $file, $filename, $mimes) {
    if (!$checked['type']) {
        $fileinfo = getimagesize($file);
        $image_types = [
            IMAGETYPE_WEBP => 'image/webp',
            IMAGETYPE_AVIF => 'image/avif'
        ];
        
        if (isset($image_types[$fileinfo[2]])) {
            $checked['type'] = $image_types[$fileinfo[2]];
            $checked['ext'] = ($fileinfo[2] === IMAGETYPE_WEBP) ? 'webp' : 'avif';
        }
    }
    return $checked;
}
add_filter('wp_check_filetype_and_ext', 'fix_image_upload_check', 10, 4);

function get_pages_options() {
    $pages = get_pages();
    $options = [];

    foreach ( $pages as $page ) {
        $options[ $page->ID ] = $page->post_title;
    }

    return $options;
}

function rela_estate_get_reading_time( $content ) {
    // Hitung jumlah kata dalam konten
    $word_count = str_word_count( strip_tags( $content ) );

    // Asumsi kecepatan membaca 200 kata per menit
    $reading_time = ceil( $word_count / 200 );

    // Kembalikan waktu membaca dalam menit
    return $reading_time;
}