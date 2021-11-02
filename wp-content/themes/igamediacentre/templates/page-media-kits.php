<?php
/**
* @package WordPress
* @subpackage Default_Theme
  template name: Media Kits Page
*/
get_header();


/** Inner Banner */
get_template_part( 'template-parts/parts', 'inner-banner' );


echo '<section class="media-kits media-kits-page">'.
  '<div class="wrapper">';

    $wpq = array (
				'post_type'	   =>'media_kits',
				'orderby'		 => 'ID',
				'order'		   => 'ASC',
				'posts_per_page'  => -1
			);
			$myquery = new WP_Query ($wpq);
			$article_count = $myquery->post_count;
			if ($article_count) {
      echo '<div class="media-kits-list page-list d-flex">';
          while ($myquery->have_posts()) : $myquery->the_post();
          echo '<div class="media_kits cell-4 cell-992-6 cell-640-12">' .
            '<div class="inner-content">'.
                '<div class="kits_thumb">' .
                  (
                    has_post_thumbnail()
                    ? wp_get_attachment_image( get_post_thumbnail_id(), 'large' )
                    : ''
                  ) .
                '</div>' .
                '<div class="kits_content">' .
                    '<h2 class="transition mb-10">' . get_the_title() . '</h2>'.
                    '<div class="description"><p>' . wp_trim_words( get_the_content(), 40 ) . '</p></div>';

                    // Media Buttons
                    if( have_rows('media_kits_buttons') ):
                      $count = count(get_field('media_kits_buttons'));

                      echo '<div class="kits-buttons">';
                        while ( have_rows('media_kits_buttons') ) : the_row();
                            $button = get_sub_field('button');

                            if( $button ):
                                $link_url = $button['url'];
                                $link_title = $button['title'];
                                $link_target = $button['target'] ? $button['target'] : '_self';

                                echo '<div class="single-button text-center '. ($count==1 ? 'one_btn' : 'two_btn') .'"><a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a></div>';
                            endif;

                        endwhile;
                        $count = 0;
                      echo '</div>';
                    endif;

                echo '</div>'.
            '</div>'.
          '</div>' ;
          endwhile;
          wp_reset_query();
          wp_reset_postdata();

          if( have_rows('finding_right_package') ):
          echo '<div class="media_kits cell-4 cell-992-6 cell-640-10 cell-480-12 finding-package">' .
            '<div class="inner-content">'.
                '<div class="kits_content">';

                // Finding Right Package
                  echo '<div class="finding-right-package">';
                    while ( have_rows('finding_right_package') ) : the_row();

                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                        $button_link = get_sub_field('button_link');

                        echo (
                              $title
                              ? '<h2 class="transition">' . $title . '</h2>'
                              : ''
                            ) .
                            (
                              $description
                              ? '<div class="description"><p>' . $description . '</p></div>'
                              : ''
                            );

                        if( $button_link ):
                            $link_url = $button_link['url'];
                            $link_title = $button_link['title'];
                            $link_target = $button_link['target'] ? $button_link['target'] : '_self';

                            echo '<div class="single-button text-center"><a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a></div>';
                        endif;

                    endwhile;
                  echo '</div>';

                echo '</div>'.
            '</div>'.
          '</div>' ;
        endif;


      echo '</div>' ;
    }

  echo '</div>'.
'</section>';


$media_kit = get_field('media_kit');
$background_image = $media_kit['background_image'];

// Download Media
if( have_rows('media_kit') ):
echo '<section class="download-media-section" '. ($background_image ? ' style="background-image: url('. $background_image .')"' : '') .'>' .
  '<div class="wrapper">'.
      '<div class="download-content">';

        while ( have_rows('media_kit') ) : the_row();

            $title = get_sub_field('title');
            $form_code = get_sub_field('form_code');

            echo (
                  $title
                  ? '<h2 class="h1 text-white text-center">' . $title . '</h2>'
                  : ''
                ) .
                (
                  $form_code
                  ? '<div class="form-block"><p>' . $form_code . '</p></div>'
                  : ''
                );

        endwhile;

      echo '</div>'.
  '</div>'.
'</section>' ;
endif;



// Media Kit FAQ
if( have_rows('media_kit_faq') ):
  while ( have_rows('media_kit_faq') ) : the_row();
  echo '<section class="media-faq-section">' .
    '<div class="wrapper">'.
        '<h2>FAQ</h2>';

        if( have_rows('faq') ):
          echo '<ul class="faq-listing">';
          while ( have_rows('faq') ) : the_row();

              $title = get_sub_field('title');
              $description = get_sub_field('description');

              echo '<li class="single-faq">'.
                  (
                    $title
                    ? '<h6 class="mb-0"><a href="javascript.void(0)" class="d-block p-10 position-relative">' . $title . '</a></h6>'
                    : ''
                  ) .
                  (
                    $description
                    ? '<div class="faq-content">' . $description . '</div>'
                    : ''
                  ) .
              '</li>';
          endwhile;
          echo '</ul>';
        endif;

    echo '</div>'.
  '</section>';
  endwhile;
endif;


/** About Us */
get_template_part( 'template-parts/parts', 'about-info' );


get_footer();
?>
