<?php

$about_us_image = get_field('about_us_image', 'options');
$about_us_title = get_field('about_us_title', 'options');
$about_us_description = get_field('about_us_description', 'options');
$button_link = get_field('button_link', 'options');
if( $button_link ) {
    $link_url = $button_link['url'];
    $link_title = $button_link['title'];
    $link_target = $button_link['target'] ? $button_link['target'] : '_self';
}

if($about_us_title || $about_us_description) {
  echo '<section class="about-us text-center">'.
    '<div class="wrapper">'.
        '<div class="about-content">'.
            (
              $about_us_image
              ? '<div class="pb-20">'. wp_image($about_us_image, 'medium') . '</div>'
              : ''
            ) .
            (
              $about_us_title
              ? '<h2 class="mb-10">'. $about_us_title . '</h2>'
              : ''
            ) .
            (
              $about_us_description
              ? '<div class="description">'. $about_us_description . '</div>'
              : ''
            ) .
            (
              $button_link
              ? '<a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a>'
              : ''
            ) .
        '</div>'.
    '</div>'.
  '</section>';
}

?>
