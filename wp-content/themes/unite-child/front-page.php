<?php
get_header(); ?>

<div id="primary" class="content-area col-sm-12 col-md-12">
	<main id="main" class="site-main" role="main">
		<?php if (get_the_content()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
					<?php edit_post_link(__('Edit', 'unite'), '<footer class="entry-meta"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>');
					?>
				</article><!-- #post-## -->
			<?php endwhile;
			?>
		<?php endif; ?>
		<div class="content-area col-sm-12 col-md-8">
			<h3>Объекты недвижимости</h3>
			<div class="buildings-wrap buildings-wrap-js">

				<?php get_template_part('template-parts/buildings-list') ?>
			</div>
		</div>
		<div class="home-widget-area row">


			<div class="col-sm-6 col-md-4 home-widget">
				<?php if (is_active_sidebar('home1')) dynamic_sidebar('home1'); ?>
			</div>

			<div class="col-sm-6 col-md-4 home-widget">
				<?php if (is_active_sidebar('home2')) dynamic_sidebar('home2'); ?>
			</div>

			<div class="col-sm-6 col-md-4 home-widget">
				<?php if (is_active_sidebar('home3')) dynamic_sidebar('home3'); ?>
			</div>

		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

?>