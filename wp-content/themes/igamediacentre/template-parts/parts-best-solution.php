<?php

$solution_title = get_field('case_studies_best_solution_title', 'options');
$solution_description = get_field('best_solution_description', 'options');
$button_link = get_field('case_studies_button_link', 'options');
if( $button_link ) {
    $link_url = $button_link['url'];
    $link_title = $button_link['title'];
    $link_target = $button_link['target'] ? $button_link['target'] : '_self';
}
$bg_color = get_field('case_studies_background_color', 'options');

if($solution_title || $solution_description) {
  echo '<section class="best-soluiton text-center" '. ($bg_color ? ' style="background-color: '. $bg_color .'"' : '') .'>'.
    '<div class="wrapper">'.
        '<div class="soluiton-content">'.
            (
              $solution_title
              ? '<h2 class="h1 text-white">'. $solution_title . '</h2>'
              : ''
            ) .
            (
              $solution_description
              ? '<div class="description">'. $solution_description . '</div>'
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
