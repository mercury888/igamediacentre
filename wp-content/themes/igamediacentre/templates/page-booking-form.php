<?php
/**
* @package WordPress
* @subpackage Default_Theme
  template name: Booking Form Page
*/
get_header();


/** Inner Banner */
get_template_part( 'template-parts/parts', 'inner-banner' );



if( have_rows('booking_group') ):
  while( have_rows('booking_group') ): the_row();
    $booking_title = get_sub_field('booking_title');
    $first_button = get_sub_field('booking_first_button');
    $second_button = get_sub_field('booking_second_button');

    if( $first_button ):
        $first_url = $first_button['url'];
        $first_title = $first_button['title'];
        $first_target = $first_button['target'] ? $first_button['target'] : '_self';
    endif;
    if( $second_button ):
        $second_url = $second_button['url'];
        $second_title = $second_button['title'];
        $second_target = $second_button['target'] ? $second_button['target'] : '_self';
    endif;


    echo '<section class="booking-form-section">'.
      '<div class="wrapper">'.
        '<div class="booking-content text-center">'.
          (
            $booking_title
            ? '<h1>'. $booking_title .'</h1>'
            : ''
          ) .
          '<div class="d-flex justify-content-center">'.
            (
              $first_button
              ? '<div class="p-10"><a class="read-more" href="'. esc_url( $first_url ) .'" target="'. esc_attr( $first_target ) .'"><span>'. esc_html( $first_title ) .'</span></a></div>'
              : ''
            ) .
            (
              $second_button
              ? '<div class="p-10"><a class="read-more" href="'. esc_url( $second_url ) .'" target="'. esc_attr( $second_target ) .'"><span>'. esc_html( $second_title ) .'</span></a></div>'
              : ''
            ) .
          '</div>'.
        '</div>'.
      '</div>'.
    '</section>';

  endwhile;
endif;







/** About Us */
get_template_part( 'template-parts/parts', 'about-info' );


get_footer();
?>
