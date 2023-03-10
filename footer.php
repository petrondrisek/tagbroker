<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tagbroker
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info container">
				<?php
					echo 'Copyright '.date("Y", strtotime("now")).' &bull; '.get_bloginfo('name');
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
