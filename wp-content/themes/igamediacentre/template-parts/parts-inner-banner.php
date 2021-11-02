<?php

global $post;
$post_id = $post->ID;
$queried_post = get_post($post_id);
$src = wp_get_attachment_image_src(get_post_thumbnail_id($queried_post->ID), '') ;

// Banner Section

$hero_title = get_field('hero_title');
$hero_sub_title = get_field('hero_sub_title');
$hero_image = get_field('hero_image');
$image_in_background = get_field('image_in_background');

if($hero_title) {
echo '<section class="banner-section inner-banner '.
(
  $image_in_background
  ? '" style="background-image: url('. wp_get_attachment_url($hero_image)  .')"'
  : ' without-image"'
) . '>'.
  '<div class="wrapper position-relative d-flex justify-content-between align-items-center">'.
    '<div class="banner-content d-flex justify-content-between align-items-center cell-12">';

      if($hero_title || $hero_sub_title) {
        echo '<div class="content-part">'.
          '<div class="inner-content">';
            if ( is_single() ) {
              $post_type = get_post_type();
              $post_type_object   = get_post_type_object( $post_type );
              $post_type_link     = get_post_type_archive_link( $post_type );

              echo '<span class="item item-cat"><a href="https://igamediacentre.com.au/case-studies/">Case Study</a></span>';
            }

            echo (
              $hero_title
              ? '<h1 class="text-white pb-5">' . $hero_title . '</h1>'
              : ''
            ) .
            (
              $hero_sub_title
              ? '<p class="text-white pb-10">' . $hero_sub_title . '</p>'
              : ''
            );

            if( have_rows('hero_section_buttons') ):
              echo '<div class="buttons d-flex row-5">';
              while( have_rows('hero_section_buttons') ) : the_row();

                $button = get_sub_field('button');

                if( $button ):
                  $first_url = $button['url'];
                  $first_title = $button['title'];
                  $first_target = $button['target'] ? $button['target'] : '_self';

                  echo '<div class="px-5 pb-5"><a class="read-more" href="'. esc_url( $first_url ) .'" target="'. esc_attr( $first_target ) .'"><span>'. esc_html( $first_title ) .'</span></a></div>';

                endif;

                endwhile;
                echo '</div>';
              endif;
          echo '</div>'.
        '</div>';
      }

      if(! $image_in_background) {
        if($hero_image) {
          echo '<div class="home-mobile">'.
            wp_image($hero_image, 'full') .
          '</div>';
        }
      }

  echo '</div>'.
'</div>'.
'</section>';
}

?>
