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
 * Go to top
 *
 * @since Twizr 1.0
 */
function twizr_go_top(){
	echo '<div id="gototop" class="btn scroll-to" data-target="html"><i class="icomoon-chevron-thin-up"></i><span class="text-hide">'. __( 'Go to top', 'twizr' ) .'</span></div>';
}
add_action( 'wp_footer', 'twizr_go_top' );
?>
