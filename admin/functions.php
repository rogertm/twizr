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
 * Register Setting
 * @link http://codex.wordpress.org/Settings_API
 *
 * @since Twizr 1.0
 */
function twizr_register_setting_init(){
	add_settings_field( 'twizr_custom_pages', __( 'Custom Pages', 'twizr' ), 'twizr_setting_fields_custom_pages', 'twenty-em-options', 'twenty-em-section' );
}
add_action( 't_em_admin_action_add_settings_field', 'twizr_register_setting_init' );

/**
 * Enqueue styles and scripts
 *
 * @since Twizr 1.0
 */
function twizr_admin_enqueue(){
	$screen = get_current_screen();
	if ( $screen->id == 'toplevel_page_twenty-em-options' ):
		wp_register_style( 'twizr-admin-css', T_EM_CHILD_THEME_DIR_URL.'/admin/admin.css', false, t_em_theme( 'Version' ), 'all' );
		wp_enqueue_style( 'twizr-admin-css' );
	endif;
}
add_action( 'admin_enqueue_scripts', 'twizr_admin_enqueue' );

/**
 * Merge into default theme options
 * This function is attached to the "t_em_admin_filter_default_theme_options" filter hook
 * @return array 	Array of options
 *
 * @since Twizr 1.0
 */
function twizr_default_theme_options( $default_theme_options ){
	$default_options = array();

	// Get custom pages from the original function
	foreach ( twizr_custom_pages() as $pages => $value ) :
		$key = array( $value['value'] => '' );
		$default_options = array_merge( $default_options, array_slice( $key, -1 ) );
	endforeach;

	$default_options = array_merge( $default_theme_options, $default_options );

	return $default_options;
}
add_filter( 't_em_admin_filter_default_theme_options', 'twizr_default_theme_options' );

/**
 * Sanitize and validate the input.
 * This function is attached to the "t_em_admin_filter_theme_options_validate" filter hook
 * @param $input array  Array of options to validate
 * @return array
 *
 * @since Twizr 1.0
 */
function twizr_theme_options_validate( $input ){
	if ( ! $input )
		return;

	// Let's go for pages
	$pages = twizr_custom_pages();
	foreach ( $pages as $key => $value ) :
		if ( array_key_exists( $input[$key['value']], $pages ) ) :
			$input[$key] = $input[$key['value']];
		endif;
	endforeach;

	return $input;
}
add_filter( 't_em_admin_filter_theme_options_validate', 'twizr_theme_options_validate' );
?>
