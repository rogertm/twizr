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
 * Array of pages object
 *
 * @since Twizr 1.0
 */
function twizr_list_pages( $type ){
	$page_args = array(
		'post_type'			=> $type,
		'posts_per_page'	=> -1,
		'orderby'			=> 'title',
		'post_status'		=> array( 'publish', 'private' ),
		'order'				=> 'ASC',
	);

	$doc_args = array(
		'post_type'			=> 'doc',
		'posts_per_page'	=> -1,
		'orderby'			=> 'menu_order',
		'post_status'		=> array( 'publish', 'private' ),
		'order'				=> 'ASC',
		'meta_query'		=> array(
				array(
					'key'	=> 'doc_top_page',
					'value'	=> '1'
				),
			),
	);

	if ( $type == 'page' ) :
		$args = $page_args;
	elseif ( $type == 'doc' ) :
		$args = $doc_args;
	endif;

	$sort = get_posts( $args );
	sort( $sort );
	return apply_filters( 'twizr_admin_filter_list_pages', get_posts( $args ) );
}

/**
 * Custom Pages
 *
 * @since Twizr 1.0
 */
function twizr_custom_pages( $custom_pages = '' ){
	$custom_pages = array(
		'page_blog'	=> array(
			'value'			=> 'page_blog',
			'label'			=> __( 'Page Blog', 'twizr' ),
			'public_label'	=> __( 'Blog', 'twizr' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_docs'	=> array(
			'value'			=> 'page_docs',
			'label'			=> __( 'Page Docs', 'twizr' ),
			'public_label'	=> __( 'Documentation', 'twizr' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_license'	=> array(
			'value'			=> 'page_license',
			'label'			=> __( 'Page License', 'twizr' ),
			'public_label'	=> __( 'License', 'twizr' ),
			'user_menu'		=> '',
			'type'			=> 'page',
		),
		'page_api'	=> array(
			'value'		=> 'page_api',
			'label'		=> __( 'Developers API Page', 'twizr' ),
			'type'		=> 'doc'
		),
	);
	return apply_filters( 'twizr_admin_filter_custom_pages', $custom_pages );
}

/**
 * Render Custom Pages panel
 *
 * @since Twizr 1.0
 */
function twizr_setting_fields_custom_pages(){
	foreach ( twizr_custom_pages() as $page ) :
?>
	<div class="text-option custom-pages">
		<label class="">
			<span><?php echo $page['label']; ?></span>
			<select name="t_em_theme_options[<?php echo $page['value'] ?>]">
				<option value="0"><?php _e( '&mdash; Select &mdash;', 'twizr' ); ?></option>
				<?php foreach ( twizr_list_pages( $page['type'] ) as $list ) :
				?>
					<?php $selected = selected( t_em( $page['value'] ), $list->ID, false ); ?>
					<option value="<?php echo $list->ID ?>" <?php echo $selected; ?>><?php echo $list->post_title ?></option>
				<?php endforeach; ?>
			</select>
		</label>
		<?php if ( t_em( $page['value'] ) ) : ?>
			<div class="row-action">
				<span class="edit"><a href="<?php echo get_edit_post_link( t_em( $page['value'] ) ) ?>"><?php _e( 'Edit', 'twizr' ) ?></a> | </span>
				<span class="view"><a href="<?php echo get_permalink( t_em( $page['value'] ) ) ?>"><?php _e( 'View', 'twizr' ) ?></a></span>
			</div>
		<?php endif; ?>
	</div>
<?php
	endforeach;
}
?>
