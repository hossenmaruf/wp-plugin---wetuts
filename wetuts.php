<?php


/**
 * Plugin Name
 *
 * @package           PluginPackage
 * @author            hossen maruf
 * @copyright         2022 lampshades
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       wetuts
 * Plugin URI:        https://example.com/plugin-name
 * Description:       plugin devlopment project
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            hossen maruf
 * Author URI:        https://example.com
 * Text Domain:       wetuts
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://example.com/my-plugin/
 */

if (!defined('ABSPATH')) exit;

if (is_admin()) {
    require_once dirname(__FILE__) . '/includes/admin/profile.php';
}

function wetuts_author_bio($content)
{
    global $post;

    $author   = get_user_by('id', $post->post_author);

    $bio      = get_user_meta($author->ID, 'description', true);
    $twitter  = get_user_meta($author->ID, 'twitter', true);
    $instagram = get_user_meta($author->ID, 'instagram', true);
    $linkedin = get_user_meta($author->ID, 'linkedin', true);

    ob_start();
?>
    <div class="wetuts-bio-wrap">

        <div class="avatar-image">
            <?php echo get_avatar($author->ID, 64); ?>
        </div>

        <div class="wetuts-bio-content">
            <div class="author-name"><?php echo $author->display_name; ?></div>

            <div class="wetuts-author-bio">
                <?php echo wpautop(wp_kses_post($bio)); ?>
            </div>

            <ul class="wetuts-socials">
                <?php if ($twitter) { ?>
                    <li><a href="<?php echo esc_url($twitter); ?>"><?php _e('Twitter', 'wetuts'); ?></a></li>
                <?php } ?>

                <?php if ($instagram) { ?>
                    <li><a href="<?php echo esc_url($instagram); ?>"><?php _e('instagram', 'wetuts'); ?></a></li>
                <?php } ?>

                <?php if ($linkedin) { ?>
                    <li><a href="<?php echo esc_url($linkedin); ?>"><?php _e('LinkedIn', 'wetuts'); ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php
    $bio_content = ob_get_clean();

    return $content . $bio_content;
}

add_filter('the_content', 'wetuts_author_bio');



function wetuts_enqueue_scripts()
{
    wp_enqueue_style('wetuts-style', plugins_url('assets/css/style.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'wetuts_enqueue_scripts');
