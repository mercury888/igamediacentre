<?php
/*
Template Name: Front Page
*/
/** header */
get_header();

global $post;
$post_id = $post->ID;
$queried_post = get_post($post_id);
$src = wp_get_attachment_image_src(get_post_thumbnail_id($queried_post->ID), '') ;

// Banner Section
if( have_rows('banner_group') ):
  while( have_rows('banner_group') ) : the_row();

    $bannerHeading = get_sub_field('banner_heading');
    $bannerSubHeading = get_sub_field('banner_sub_heading');
    $bannerMobileImage = get_sub_field('banner_mobile_image');
    $firstButton = get_sub_field('banner_first_button');
    $secondButton = get_sub_field('banner_second_button');

    if( $firstButton ):
      $first_url = $firstButton['url'];
      $first_title = $firstButton['title'];
      $first_target = $firstButton['target'] ? $firstButton['target'] : '_self';
    endif;
    if( $secondButton ):
      $second_url = $secondButton['url'];
      $second_title = $secondButton['title'];
      $second_target = $secondButton['target'] ? $secondButton['target'] : '_self';
    endif;

    echo '<section class="banner-section home-page" style="background-image: url('. $src[0]  .')">'.
      '<div class="wrapper position-relative d-flex justify-content-between align-items-center">'.
        '<div class="banner-content d-flex justify-content-between align-items-center">';

          if($bannerHeading || $bannerSubHeading) {
            echo '<div class="content-part">'.
              '<div class="inner-content">'.
                (
                  $bannerHeading
                  ? '<h1 class="text-white pb-10">' . $bannerHeading . '</h1>'
                  : ''
                ) .
                (
                  $bannerSubHeading
                  ? '<p class="text-white pb-10">' . $bannerSubHeading . '</p>'
                  : ''
                ) .
                '<div class="buttons d-flex">'.
                    (
                      $firstButton
                      ? '<a class="read-more" href="'. esc_url( $first_url ) .'" target="'. esc_attr( $first_target ) .'"><span>'. esc_html( $first_title ) .'</span></a>'
                      : ''
                    ) .
                    (
                      $secondButton
                      ? '<a class="read-more white hover-primary" href="'. esc_url( $second_url ) .'" target="'. esc_attr( $second_target ) .'"><span>'. esc_html( $second_title ) .'</span></a>'
                      : ''
                    ) .
                '</div>'.
              '</div>'.
            '</div>';
          }

          if($bannerMobileImage) {
            echo '<div class="home home-mobile">'.
              wp_image($bannerMobileImage, 'full') .
            '</div>';
          }
      echo '</div>'.
    '</div>'.
  '</section>';
  endwhile;
endif;


echo '<section class="welcome-section">' .
  '<div class="wrapper d-flex justify-content-between align-items-center row-15">';
    $welcome_group = get_field('welcome_group');

    if($welcome_group) {
      $select_video_type = $welcome_group['select_video_type'];
      $html_video = $welcome_group['html_video'];
      $youtube_video = $welcome_group['youtube_video'];
      $vimeo_video = $welcome_group['vimeo_video'];
      $video_placeholder_image = $welcome_group['video_placeholder_image'];
      $welcome_button = $welcome_group['welcome_button'];
      if( $welcome_button ):
        $link_url = $welcome_button['url'];
        $link_title = $welcome_button['title'];
        $link_target = $welcome_button['target'] ? $welcome_button['target'] : '_self';
      endif;

      if( $select_video_type && ( $html_video || $youtube_video || $vimeo_video ) ) :
      echo '<div class="video-list-item cell-6 cell-1024-12">'.
            '<div class="video-media">'.
                '<div class="image-src innbaner">'.
                    (
                        ( $select_video_type == 'Upload' && $html_video )
                        ? '<a data-fancybox href="'. $html_video['url'] .'">'.
                            (
                                $video_placeholder_image
                                ? wp_image($video_placeholder_image, 'full')
                                : '<img src="https://s3.ap-southeast-2.amazonaws.com/igamediacentre.metcdn.com/wp-content/uploads/2021/10/20045857/placeholder-image.jpg" alt="'. get_the_title() .'">'
                            ).
                        '</a>'
                        : ''
                    ).
                    (
                        ( $select_video_type == 'YouTube' && $youtube_video )
                        ? '<a data-fancybox href="https://www.youtube.com/watch?v='. $youtube_video .'">'.
                          (
                              $video_placeholder_image
                              ? wp_image($video_placeholder_image, 'full')
                              : '<img src="https://s3.ap-southeast-2.amazonaws.com/igamediacentre.metcdn.com/wp-content/uploads/2021/10/20045857/placeholder-image.jpg" alt="'. get_the_title() .'">'
                          ).
                        '</a>'
                        : ''
                    ).
                    (
                        ( $select_video_type == 'Vimeo' && $vimeo_video )
                        ? '<a data-fancybox href="https://vimeo.com/'. $vimeo_video .'">'.
                          (
                              $video_placeholder_image
                              ? wp_image($video_placeholder_image, 'full')
                              : '<img src="https://s3.ap-southeast-2.amazonaws.com/igamediacentre.metcdn.com/wp-content/uploads/2021/10/20045857/placeholder-image.jpg" alt="'. get_the_title() .'">'
                          ).
                        '</a>'
                        : ''
                    ).
                    '<svg class="icon-play" xmlns="http://www.w3.org/2000/svg" width="126" height="80" xmlns:v="https://vecta.io/nano"><rect width="126" height="80" rx="6" fill="#fff" opacity=".78"/><path d="M50.968 23.537v32.926L76.838 40z" fill="#626262"/></svg>'.
                '</div>'.
            '</div>'.
				'</div>';
			endif;
    }

	echo '<div class="welcome-desc cell-6 cell-1024-12">'.
  '<div class="description">';
		while ( have_posts() ) : the_post();
			the_content();

      if( $welcome_button ):
        $link_url = $welcome_button['url'];
        $link_title = $welcome_button['title'];
        $link_target = $welcome_button['target'] ? $welcome_button['target'] : '_self';

        echo '<a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a>';
      endif;

		endwhile;
  echo '</div>'.
   '</div>'.
  '</div>'.
'</section>';


if( have_rows('benefits_&_difference') ):
    while( have_rows('benefits_&_difference') ): the_row();
        $background_image = get_sub_field('background_image');
        $benefits_title = get_sub_field('benefits_title');
        $benefits_description = get_sub_field('benefits_description');
        $button_link = get_sub_field('button_link');
        $difference_title = get_sub_field('difference_title');

        if( $button_link ):
          $link_url = $button_link['url'];
          $link_title = $button_link['title'];
          $link_target = $button_link['target'] ? $button_link['target'] : '_self';
        endif;

        echo '<section class="benifits-section" style="background-image: url('. $background_image .');">'.
          '<div class="wrapper">'.
              '<div class="d-flex justify-content-between align-items-center">';
                  if( $benefits_title || $benefits_description ) {
                    echo '<div class="benifits-content">'.
                      '<div class="inner-content">'.
                          (
                            $benefits_title
                            ? '<h2 class="text-white pb-10">'. $benefits_title .'</h2>'
                            : ''
                          ) .
                          (
                            $benefits_description
                            ? $benefits_description
                            : ''
                          ) .
                          (
                            $button_link
                            ? '<a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a>'
                            : ''
                          ) .
                      '</div>'.
                    '</div>';
                  }

                  if( have_rows('difference_points') ):
                    echo '<div class="iga-section">'.
                      (
                        $difference_title
                        ? '<h2>'. $difference_title .'</h2>'
                        : ''
                      ).
                      '<ul class="iga-listing list-none mb-0">';
                        while( have_rows('difference_points') ) : the_row();
                            $title = get_sub_field('title');
                            $description = get_sub_field('description');

                            echo '<li class="single-iga">'.
                              (
                                $title
                                ? '<h3>'. $title .'</h3>'
                                : ''
                              ) .
                              (
                                $description
                                ? $description
                                : ''
                              ) .
                          '</li>';
                        endwhile;

                      echo '</ul>'.
                    '</div>'.
                    (
                      $button_link
                      ? '<div class="mob-btn cell-12 text-center"><a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a></div>'
                      : ''
                    );
                endif;

              echo '</div>'.
          '</div>'.
        '</section>';

    endwhile;
endif;


if( have_rows('connect_with_customer') ):
    while( have_rows('connect_with_customer') ): the_row();
      $connect_heading = get_sub_field('connect_heading');

      echo '<section class="connect-customer-section">'.
        '<div class="wrapper">'.
          (
            $connect_heading
            ? '<h2>'. $connect_heading .'</h2>'
            : ''
          );

          if( have_rows('connect') ):
            echo '<ul class="connect-listing list-none mb-0 d-flex justify-content-center">';
              while( have_rows('connect') ) : the_row();
                  $icon = get_sub_field('icon');
                  $title = get_sub_field('title');
                  $sub_title = get_sub_field('sub_title');

                  echo '<li class="single-iga">'.
                    (
                      $icon
                      ? '<div class="icon-part">'. wp_image($icon, 'full') .'</div>'
                      : ''
                    ) .
                    (
                      $title
                      ? '<h3>'. $title .'</h3>'
                      : ''
                    ) .
                    (
                      $sub_title
                      ? '<h4>'. $sub_title .'</h4>'
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



if( have_rows('case_studies_post') ) {
	while ( have_rows('case_studies_post') ) : the_row();
    echo '<section class="case-studies">'.
      '<div class="wrapper">'.
        (
          get_sub_field('section_title')
          ? '<h2>'. get_sub_field('section_title') .'</h2>'
          : ''
        );

        $posts = get_sub_field('select_post');

          if ($posts) {
          echo '<div class="case-studies-list d-flex justify-content-center">' ;
              foreach( $posts as $post):
              setup_postdata($post);
              echo '<div class="case_studies cell-4 cell-992-6 cell-640-12">' .
                '<a href="'. get_the_permalink() .'">'.
                    '<div class="case_thumb">' .
                      (
                        has_post_thumbnail()
                        ? wp_get_attachment_image( get_post_thumbnail_id(), 'large' )
                        : ''
                      ) .
                    '</div>' .
                    '<div class="case_content">' .
                        '<p class="transition">'. get_field('subtitle') .'</p>'.
                        '<h4 class="transition pb-10">' . get_the_title() . '</h4>'.
                    '</div>'.
                  '</a>'.
                '</div>' ;
              endforeach;
          echo '</div>' ;
        }

        $section_button = get_sub_field('section_button', 'options');
        if( $section_button ) {
            $link_url = $section_button['url'];
            $link_title = $section_button['title'];
            $link_target = $section_button['target'] ? $section_button['target'] : '_self';

            echo '<div class="text-center pt-30"><a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a></div>';
        }

      echo '</div>'.
    '</section>';
endwhile; wp_reset_query();
}


// Solution Section
if( have_rows('solution') ):
  while( have_rows('solution') ) : the_row();

    $background_color = get_sub_field('background_color');
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $button_link = get_sub_field('button_link');
    $image = get_sub_field('image');

    if( $button_link ):
      $button_url = $button_link['url'];
      $button_title = $button_link['title'];
      $button_target = $button_link['target'] ? $button_link['target'] : '_self';
    endif;

    echo '<section class="solution-section" '. ($background_color ? ' style="background-color: '. $background_color .'"' : '') . '>'.
      '<div class="wrapper position-relative d-flex justify-content-between align-items-center">'.
        '<div class="solution-content d-flex justify-content-between align-items-center">';

          if($title || $bannerSubHeading) {
            echo '<div class="content-part">'.
              '<div class="inner-content">'.
                (
                  $title
                  ? '<h2 class="h1 text-white pb-10">' . $title . '</h2>'
                  : ''
                ) .
                (
                  $description
                  ? $description
                  : ''
                ) .
                '<div class="buttons">'.
                    (
                      $button_link
                      ? '<a class="read-more" href="'. esc_url( $button_url ) .'" target="'. esc_attr( $button_target ) .'"><span>'. esc_html( $button_title ) .'</span></a>'
                      : ''
                    ) .
                '</div>'.
              '</div>'.
            '</div>';
          }

          if($image) {
            echo '<div class="home-tab">'.
              wp_image($image, 'full') .
            '</div>';
          }
      echo '</div>'.
    '</div>'.
  '</section>';
  endwhile;
endif;


/** About Us */
get_template_part( 'template-parts/parts', 'about-info' );


// /** footer */
get_footer();

?>
