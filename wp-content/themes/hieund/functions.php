<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
* This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

//let's start the game!
require_once('core/load.php');
//---------------------------------------------
// Everybody changes above will lose his hands
//---------------------------------------------

//Insert BxSlider plugin
function bxslider()
{
    wp_enqueue_script('bxslider', get_stylesheet_directory_uri() . '/slider/jquery.bxslider.min.js', array('jquery'));
    wp_enqueue_style('flexslider-css', get_stylesheet_directory_uri() . '/slider/jquery.bxslider.css');
}
add_action('wp_enqueue_scripts', 'bxslider');
