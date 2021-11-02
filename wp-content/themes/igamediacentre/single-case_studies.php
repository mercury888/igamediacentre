<?php

get_header();


/** Inner Banner */
get_template_part( 'template-parts/parts', 'inner-banner' );



if( have_rows('case_studies_number_option') ):
    while( have_rows('case_studies_number_option') ): the_row();
        echo '<section class="number-section text-center">'.
          '<div class="wrapper">';

                  if( have_rows('case_studies_about_number') ):
                    echo '<ul class="number-listing d-flex justify-content-center list-none mb-0">';
                        while( have_rows('case_studies_about_number') ) : the_row();
                            $number = get_sub_field('number');
                            $percentage = get_sub_field('percentage');
                            $description = get_sub_field('description');

                            echo '<li class="single-number cell-4 cell-767-12">'.
                              (
                                $number
                                ? '<div class="d-flex justify-content-center align-items-center"><h3 class="mb-0 counter">'. $number .'</h3>' . ( $percentage ? '<span class="h3">%</span>' : '') . '</div>'
                                : ''
                              ) .
                              (
                                $description
                                ? '<p>'. $description . '</p>'
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


if( have_rows('case_studies_what_we_offer') ):
    while( have_rows('case_studies_what_we_offer') ): the_row();
        echo '<section class="we-offer-section">'.
          '<div class="wrapper">'.
            '<div class="d-flex justify-content-center align-items-center">';

                $offer_title = get_sub_field('offer_title');
                $offer_description = get_sub_field('offer_description');
                $what_we_offer_image = get_sub_field('what_we_offer_image');

                echo '<div class="content-block '. ( $what_we_offer_image ? 'cell-6 cell-767-12' : 'cell-12') .'">'.
                  '<div class="inner-content">'.
                      (
                        $offer_title
                        ? '<h2 class="h1">'. $offer_title .'</h2>'
                        : ''
                      ) .
                      (
                        $offer_description
                        ? $offer_description
                        : ''
                      ) .
                  '</div>'.
              '</div>';
              if($what_we_offer_image) {
                echo '<div class="image-block cell-6 text-center">'.
                    wp_image($what_we_offer_image) .
                '</div>';
              }
              echo '</div>'.
              '</div>'.
        '</section>';
    endwhile;
endif;


if( have_rows('what_we_cover') ):
    while( have_rows('what_we_cover') ): the_row();
      echo '<section class="what-we-cover-section">'.
        '<div class="wrapper">';

          if( have_rows('what_we_cover_options') ):
            echo '<ul class="options-listing list-none mb-0 d-flex justify-content-center">';
              while( have_rows('what_we_cover_options') ) : the_row();
                  $image = get_sub_field('image');
                  $title = get_sub_field('title');
                  $description = get_sub_field('description');

                  echo '<li class="single-option cell-4 cell-767-12">'.
                    (
                      $image
                      ? '<div class="icon-part pb-10">'. wp_icon($image, 'full') .'</div>'
                      : ''
                    ) .
                    (
                      $title
                      ? '<h4 class="mb-15">'. $title .'</h4>'
                      : ''
                    ) .
                    (
                      $description
                      ? '<div class="description">'. $description . '</div>'
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


/** Best Solution */
get_template_part( 'template-parts/parts', 'best-solution' );


// /** footer */
get_footer();

?>
