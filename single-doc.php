<?php
/**
 * Twizr
 *
 * @package			WordPress
 * @subpackage		Twizr: Single Doc
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twizr 1.0
 */

/**
 * The template for displaying all single doc post type.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

		<section id="main-content" <?php t_em_breakpoint( 'main-content' ); ?>>
			<section id="content" role="main" class="<?php echo t_em_grid( 8 ) ?>">
			<?php do_action( 't_em_action_content_before' ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php do_action( 't_em_action_post_before' ); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php do_action( 't_em_action_post_inside_before' ); ?>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-meta entry-meta-header mb-3">
					<?php do_action( 't_em_action_entry_meta_header' ); ?>
				</div><!-- .entry-meta -->
			</header>

			<?php do_action( 't_em_action_post_content_before' ); ?>
			<?php if ( ! empty( get_post_field( 'post_excerpt' ) ) ) : ?>
			<div class="entry-excerpt"><?php echo t_em_wrap_paragraph( do_shortcode( $post->post_excerpt ) ) ?></div>
			<?php endif; ?>
			<div class="entry-content">
				<?php the_content(); ?>

			<?php
				if ( get_post_meta( $post->ID, 'doc_top_page', true ) == 1 ) :
					// Get inner docs pages
					$args = array(
						'post_type'			=> 'doc',
						'post_parent'		=> $post->ID,
						'orderby'			=> 'menu_order',
						'order'				=> 'ASC',
						'posts_per_page'	=> -1,
						'meta_key'			=> 'function_api_deprecated',
						'meta_value_num'	=> '1',
						'meta_compare'		=> 'NOT EXISTS',
					);
					$doc_topics = get_posts( $args );
			?>
				<ul class="list-unstyled">
			<?php foreach ( $doc_topics as $topic ) : ?>
					<li class="h5"><a href="<?php echo get_permalink( $topic->ID ) ?>"><?php echo get_the_title( $topic->ID ) ?></a></li>
			<?php endforeach; ?>
				</ul>
			<?php
				endif;
			?>
			</div><!-- .entry-content -->

			<?php do_action( 't_em_action_post_content_after' ); ?>

			<footer class="entry-meta entry-meta-footer mb-3">
				<?php do_action( 't_em_action_entry_meta_footer' ); ?>
			</footer><!-- .entry-meta .entry-meta-footer -->

			<?php do_action( 't_em_action_post_inside_after' ); ?>
		</article><!-- #post-## -->
		<?php do_action( 't_em_action_post_after' ); ?>

<?php endwhile; // end of the loop. ?>

				<?php do_action( 't_em_action_content_after' ); ?>
			</section><!-- #content -->
			<?php get_sidebar( 'docs' ); ?>
			<?php get_sidebar( 'alt' ); ?>
		</section><!-- #main-content -->

<?php get_footer(); ?>
