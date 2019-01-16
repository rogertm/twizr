<?php
/**
 * Twizr
 *
 * @package			WordPress
 * @subpackage		Twizr
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twizr 1.0
 */

/**
 * Template for displaying search forms.
 */
$big_form = ( is_page( t_em( 'page_docs' ) ) ) ? 'input-group-lg' : null;
$big_btn = ( is_page( t_em( 'page_docs' ) ) ) ? 'btn-lg' : null;
?>
<form id="searchform" action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="input-group <?php echo $big_form ?>">
		<label class="sr-only" for="s"><?php _e( 'Search in Docs', 'twizr' ); ?> <?php echo bloginfo( 'name' ); ?></label>
		<input type="text" class="form-control" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search in Docs', 'twizr' ) ?>" />
		<input type="hidden" name="pt" value="doc">
		<span class="input-group-btn">
			<button class="btn btn-secondary <?php echo $big_btn ?>" type="submit" title="<?php _e( 'Search', 'twizr' ) ?>">
				<span class="icomoon-search"></span>
				<span class="label-btn sr-only"><?php _e( 'Search', 'twizr' ) ?></span>
			</button>
		</span>
	</div>
</form>
