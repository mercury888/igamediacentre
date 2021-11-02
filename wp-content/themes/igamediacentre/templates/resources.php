<?php
/**
 * Template Name: Resources Page
 */

get_header();


echo '<div class="content default-page digital-specs-page">';
		echo '<div class="wrapper">' .
			'<div class="mid">' .
				'<div class="post" id="post-' . get_the_ID() .'">';
					if (have_posts()) : while (have_posts()) : the_post();
						echo '<h1>' . get_the_title() . '</h1>'.
						'<div class="entry">';
							the_content();
							$download_file_url = get_template_directory_uri() . '/resources/sample.pdf';

							echo "<a class='js-download-file' href='".$download_file_url."' target='_blank' >Download PDF</a>";

							wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
						echo '</div>';
					   endwhile;
						wp_reset_query();
					echo '</div>';
				echo '</div>';
			echo '</div>' .
		'</div>';
	endif;


/** About Us */
get_template_part( 'template-parts/parts', 'about-info' );


get_footer();
