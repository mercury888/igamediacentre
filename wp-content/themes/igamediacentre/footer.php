<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 */
?>

</div><!-- #page -->
</div><!-- #main -->
<?php


echo '<footer class="site-footer position-relative">'.
    '<div class="wrapper d-flex justify-content-between position-relative">'.
        '<div class="footer-menu middle-part cell-4 cell-992-9 cell-767-12 d-flex">'.
            do_shortcode('[footer-navigation]') .
        '</div>'.
        '<div class="social-part cell-4 cell-767-12">'.
            '<h4 class="text-white mb-10">Join Us On Social</h4>'.
						social_media_options() .
				'</div>'.
        '<div class="left-part cell-4 cell-992-12 pt-992-20">'.
						footer_logo_new() .
				'</div>'.
		'</div>' .
'</footer>';
 ?>



<?php
wp_footer();
?>
</body>
</html>
