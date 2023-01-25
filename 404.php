<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package tagbroker
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! Stránka nebyla nalezena.', 'tagbroker' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
					<?php
					/*get_search_form();

					//the_widget( 'WP_Widget_Recent_Posts' );
					

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'tagbroker' ); ?></h2>
						<ul>
							<?php
							/*wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div><!-- .widget -->*/
					?>
					<?php
					/* translators: %1$s: smiley */
					//$tagbroker_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'tagbroker' ), convert_smilies( ':)' ) ) . '</p>';
					//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$tagbroker_archive_content" );

					//the_widget( 'WP_Widget_Tag_Cloud' );
					?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
