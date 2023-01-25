<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tagbroker
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'tagbroker' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$tagbroker_description = get_bloginfo( 'description', 'display' );
			if ( $tagbroker_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $tagbroker_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
			<?php
				if(get_theme_mod('tagbroker_description_setting')){
					echo '<p>'.get_theme_mod('tagbroker_description_setting').'</p>';
				}
			?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><svg height="20" viewBox="0 -53 384 384" width="20" xmlns="http://www.w3.org/2000/svg"><path fill="white" d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path fill="white" d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path fill="white" d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/></svg></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		</div>
	<div id="main_slider" class="carousel slide carousel-fade container" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php
				$count = 0;
				for($i = 0; $i < 8; $i++)
					if(get_theme_mod('tagbroker_header_settings_slider_'.$i.'_img')) $count++;
				

				if($count > 1){
					for($i = 0; $i < $count; $i++)
						echo '<li data-target="#main_slider" data-slide-to="'.$i.'" '.($i == 0 ? 'class="active"': '').'></li>';
			?>
			<?php
				}
			?>
		</ol>
		<div class="carousel-inner">
			<?php
				for($i = 0; $i < $count; $i++){
			?>
			<div class="carousel-item <?=($i == 0 ? "active" : "")?>">
				<img class="d-block" src="<?=wp_get_attachment_url(get_theme_mod('tagbroker_header_settings_slider_'.$i.'_img'))?>" alt="Obrázek">
				<div class="carousel-caption d-md-block">
					<h1><?=get_theme_mod('tagbroker_header_settings_slider_'.$i.'_text')?></h1>
					<?php if(get_theme_mod('tagbroker_header_settings_slider_'.$i.'_button_href')){
						?>
					<a href="<?=get_theme_mod('tagbroker_header_settings_slider_'.$i.'_button_href')?>">
						<button><?=(get_theme_mod('tagbroker_header_settings_slider_'.$i.'_button_text') ? get_theme_mod('tagbroker_header_settings_slider_'.$i.'_button_text') : "Zjistit více")?></button>
					</a>
					<?php
						}
					?>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		</div>
	</header><!-- #masthead -->
