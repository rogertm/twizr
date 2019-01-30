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
 * Enqueue and register all css and js
 *
 * @since Twizr 1.0
 */
function twizr_enqueue(){
	wp_register_style( 'twizr-css', t_em_get_css( 'theme', T_EM_CHILD_THEME_DIR_PATH .'/css', T_EM_CHILD_THEME_DIR_URL .'/css' ), '', t_em_theme( 'Version' ), 'all' );
	wp_enqueue_style( 'twizr-css' );

	wp_register_script( 'jquery.scrollTo', t_em_get_js( 'jquery.scrollTo', T_EM_CHILD_THEME_DIR_PATH .'/node_modules/jquery.scrollto', T_EM_CHILD_THEME_DIR_URL .'/node_modules/jquery.scrollto' ), array( 'jquery' ), t_em_theme( 'Version' ), true );
	wp_enqueue_script( 'jquery.scrollTo' );

	wp_register_script( 'prettify', t_em_get_js( 'prettify', T_EM_CHILD_THEME_DIR_PATH .'/js', T_EM_CHILD_THEME_DIR_URL .'/js' ), array( 'jquery' ), t_em_theme( 'Version' ), true );
	wp_enqueue_script( 'prettify' );

	wp_register_script( 'twizr-js', t_em_get_js( 'twizr', T_EM_CHILD_THEME_DIR_PATH .'/js', T_EM_CHILD_THEME_DIR_URL .'/js' ), array( 'jquery' ), t_em_theme( 'Version' ), true );
	// l10n for twizr.js
	$translation = array(
		'appVersion'	=> T_EM_FRAMEWORK_VERSION,
	);
	wp_localize_script( 'twizr-js', 'twizrl10n', $translation );
	wp_enqueue_script( 'twizr-js' );
}
add_action( 'wp_enqueue_scripts', 'twizr_enqueue' );

/**
 * Dequeue styles form parent theme
 *
 * @since Twizr 1.2
 */
function twizr_dequeue(){
	wp_dequeue_style( 'twenty-em-style' );
	wp_deregister_style( 'twenty-em-style' );
}
add_action( 'wp_enqueue_scripts', 'twizr_dequeue', 999 );
?>
