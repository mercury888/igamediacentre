<?php
/**
* @package WordPress
* @subpackage Default_Theme
template name: Start Here
*/
get_header();
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<?php


echo '<section class="case-studies case-studies-page start-here media-kits">'.
  '<div class="wrapper">';

		if ( isset( $_POST['quiz'] ) && $_POST['quiz'] ){

			//echo "<pre>";print_r(get_field('step3_select_option',200));exit;
			// args
			
			$total_loop_count = array("1", "2", "3", "4", "5");			
			$meta_query = array('relation' => 'OR');		
			foreach( $total_loop_count as $item ){
				if( isset( $_POST['step'.$item] ) && $_POST['step'.$item] != '' ){
					$meta_query[] = array(
						'key'     => 'step'.$item.'_select_option',
						'value'   => sprintf('"%s"', $_POST['step'.$item]),
						'compare' => 'LIKE',
					);	
				}
			}
			
			//echo "<pre>";print_r($meta_query);exit;
			$args = array(
				'post_type'		=> 'media_kits',
				'posts_per_page'	=> -1,
				'meta_query' => $meta_query,
				/*'meta_query' => array(
				'relation' => 'AND',
					array(
						'key'     => 'step1_select_option',
						'value'   => isset($_POST['step1']) ? $_POST['step1'] : '',
						'compare' => '=',
					),
					array(
						'key'     => 'step2_select_option',
						'value'   => isset($_POST['step2']) ? $_POST['step2'] : '',
						'compare' => '=',
					),
					array(
						'key'     => 'step3_select_option',
						'value'   => isset($_POST['step3']) ? $_POST['step3'] : '',
						'compare' => '=',
					),
					array(
						'key'     => 'step4_select_option',
						'value'   => isset($_POST['step4']) ? $_POST['step4'] : '',
						'compare' => '=',
					),
					array(
						'key'     => 'step5_select_option',
						//'value'   => isset($_POST['step5']) ? $_POST['step5'] : '',
						//'compare' => '=',
						'value'   =>  isset($_POST['step5']) ? $_POST['step5'] : '',
						'compare' => 'LIKE',
					),
				),*/
			);
			
//echo "<pre>";print_r($args);exit;
			// query
			$the_query = new WP_Query( $args );
//echo "<pre>";print_r($the_query);exit;
			 if( $the_query->have_posts() ) {
         echo '<div class="final-results">'.
         '<h2 class="text-center pb-20">The best solutions for you</h2>'.
         '<div class="media-kits-list d-flex justify-content-center">';
    			 while( $the_query->have_posts() ) : $the_query->the_post();
				 if( get_the_ID() != 203 ){
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
								   echo '<div class="kits-buttons">';
									 while ( have_rows('media_kits_buttons') ) : the_row();
										 $button = get_sub_field('button');

										 if( $button ):
											 $link_url = $button['url'];
											 $link_title = $button['title'];
											 $link_target = $button['target'] ? $button['target'] : '_self';

											 echo '<div class="single-button text-center"><a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a></div>';
										 endif;

									 endwhile;
								   echo '</div>';
                     endif;

                 echo '</div>'.
             '</div>'.
           '</div>' ;
		   //echo "<pre>";print_r($_POST);exit;
		   }
			//echo "<pre>";print_r($_POST);exit;
		   if( get_the_ID() == 203 ){
				if( $_REQUEST['step5'] != 1  ){
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
								   echo '<div class="kits-buttons">';
									 while ( have_rows('media_kits_buttons') ) : the_row();
										 $button = get_sub_field('button');

										 if( $button ):
											 $link_url = $button['url'];
											 $link_title = $button['title'];
											 $link_target = $button['target'] ? $button['target'] : '_self';

											 echo '<div class="single-button text-center"><a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a></div>';
										 endif;

									 endwhile;
								   echo '</div>';
                     endif;

                 echo '</div>'.
             '</div>'.
           '</div>' ;
				}
			   
		   }
    			 endwhile;
				 
        echo '</div>';

        echo '<div class="final-results-link text-center mt-30"><a href="'.get_page_link('16') . '">View Media Kits</a></div>';

			 } else {
				 echo '<div class="final-results"><h2 class="text-center">No result found..!</h1><div class="final-results-link text-center mt-30"><a href="'.get_page_link('16') . '">View Media Kits</a></div></div>';
			 }

       echo '</div>';

       wp_reset_query();
       wp_reset_postdata();
		}else{

      echo '<div class="get-started-block">'.
        '<h2 class="h1">Let’s find the best solution for you!</h2>'.
        '<div class="description"><p>To ensure your best outcomes answer the following questions and identify the recommended solutions.</p></div>'.
        '<a class="get-started-btn read-more" href="javascript:void(0)">Get Started</a>'.
      '</div>';

		?>


			<form id="quiz" action="" name="" method="post">

					<?php
						$latest_cpt = get_posts("post_type=media_kits&numberposts=1");
						//echo $latest_cpt[0]->ID

						$total_loop_count = array("1", "2", "3", "4", "5");
						$count = 1;
						foreach ($total_loop_count as $j => $value) {
              // echo $j;

							echo '<fieldset>';

								$i = 1;
								echo '<h2 class="h1">'. get_field('step_'.$value.'_title','option').'</h2>';
								$quiz_option = get_field_object('step'.$value.'_select_option',$latest_cpt[0]->ID);

                // echo $quiz_option;

                echo '<div class="all-options">';
								foreach ($quiz_option['choices'] as $k => $option_value) {
									echo '<div class="single-option"><div class="inner-block">
                  <input type="radio" class="step'.$value.'" name="step'.$value.'" value="' . $k . '">' .
                  '<span>'. $option_value . '</span>'.
                  '</div></div>';
									$i++;
								}
                echo '</div>';

                // echo '<div class="buttons-block">';

								if( $count != 1 ){
									echo '<input type="button" name="previous" class="previous btn btn-default" value="Previous" />';
								}
                if( sizeof($total_loop_count) > $count ){
									echo '<input type="button" class="next btn btn-info" step="step'.$value.'" value="Next" />';
								}
								if( sizeof($total_loop_count) == $count ){
									echo '<input type="hidden" name="quiz" value="1" />';
									//echo '<input type="submit" name="quiz_res" value="Quiz Result">';
									echo '<button type="button" id="submitBtn" step="step'.$count.'">Quiz Result</button>';
								}
                // echo '</div>';

								$count++;

							echo '</fieldset>';
						}

            echo '<div class="error-message-block text-center"></div>';


					?>

			</form>

			<div class="progress-first-step">
				<div class="progress-bar-first-step"></div>
			</div>
      <div class="progress">
				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
			</div>

		<?php
		}

      echo '</div>' ;
  echo '</div>'.
'</section>';


if ( isset( $_POST['quiz'] ) && $_POST['quiz'] ){
  /** Best Solution */
  get_template_part( 'template-parts/parts', 'about-info' );
}





get_footer();
?>

<style type="text/css">
  #quiz fieldset:not(:first-child) {
    display: none;
  }
</style>

<script>

jQuery(document).ready(function(){

	function validate( current_step ){
		var res = 0;
		jQuery('.' + current_step).each(function () {
			//alert(current_step);
			if (this.checked === true) {
				res = 1;
				return false;
			}else{
				res = 0;
			}
		});
		return res;
	}


  var form_count = 1, form_count_form, next_form, total_forms;
  total_forms = jQuery("fieldset").length;
  jQuery(".next").click(function(){
	  var current_step = jQuery(this).attr('step');
    jQuery( ".error-message-block p" ).remove();

	var validate_isselect = validate(current_step);

	if( validate_isselect ){
		form_count_form = jQuery(this).parent();
		next_form = jQuery(this).parent().next();
		next_form.show();
		form_count_form.hide();
		setProgressBar(++form_count);
	} else {
    jQuery( ".error-message-block" ).append( "<p>Please select an option.</p>" );
	}
  });
  jQuery(".previous").click(function(){
    form_count_form = jQuery(this).parent();
    next_form = jQuery(this).parent().prev();
    next_form.show();
    form_count_form.hide();
    setProgressBar(--form_count);
  });
  setProgressBar(form_count);
  function setProgressBar(curStep){

    var percent = parseFloat(100 / total_forms) * curStep;
    percent = percent.toFixed();
    jQuery(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");
  }


  jQuery("#submitBtn").click(function(){
		var current_step = jQuery(this).attr('step');
    jQuery( ".error-message-block p" ).remove();

		var validate_isselect = validate(current_step);
		if( validate_isselect ){
			jQuery("#quiz").submit(); // Submit the form
			jQuery(".top-header-banner").addClass("Test");

		} else {
      jQuery( ".error-message-block" ).append( "<p>Please select an option.</p>" );
		}
	});

});

</script>
