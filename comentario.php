<?php
/**
 * Plugin Name: Comentario.app Wordpress Interation
 * Description: Replace native comments with Comment.app.
 * Version:     1.2
 * Author:      Mitai
 */

// 1) Completely disable WordPress comments
add_filter('comments_open',      '__return_false', 20, 2);
add_filter('pings_open',         '__return_false', 20, 2);
add_filter('comments_array',     '__return_empty_array', 10, 2);
add_filter('comment_form',       '__return_empty_string');
add_filter('wp_list_comments',   '__return_empty_string');

// 2) Inserts the iframe at the end of the content with an identifiable wrapper
add_filter('the_content', 'comentario_insertar_iframe');
function comentario_insertar_iframe($content) {
    if (is_single() && is_main_query()) {
        $embed = '<div id="comentario-temp-wrapper" style="display:none;">
            <div id="comentario-app" style="margin-top:2rem;">
                <script defer src="https://chat.example.com/comentario.js"></script>
                <comentario-comments lang="es" theme="dark" hide-footer="true"></comentario-comments>
            </div>
        </div>';
        return $content . $embed;
    }
    return $content;
}

// 3) Enqueue the script to move the iframe before the closing of <article>.
add_action('wp_enqueue_scripts', 'comentario_enqueue_script');
function comentario_enqueue_script() {
    if (is_single()) {
        wp_enqueue_script(
            'comentario-move-script',
            plugin_dir_url(__FILE__) . 'comentario.js',
            array(),
            '1.0',
            true
        );
    }
}
