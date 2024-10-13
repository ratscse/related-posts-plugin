<?php 

class Class_Enqueue_Styles {
    public static function register_scripts() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_styles']);
    }

    public static function enqueue_styles() {
        wp_enqueue_style(
            'related-posts-style',
            plugin_dir_url(__FILE__) . '../assets/css/style.css', 
            [], 
            '1.0.0',
            'all'
        );

    }
}