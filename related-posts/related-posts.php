<?php

/*
 * Plugin Name:       Related Posts
 * Description:       This plugin shows related posts at the end of each single post.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            M A Shuab Ratan
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ratan-related-posts
 */

 class Related_Posts {

    public function __construct() {
        add_action( 'init', [$this, 'init'] );
    }

    public function init() {
        add_filter( 'the_content', [$this, 'related_posts_after_content'] );
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            'related-posts-style',
            plugin_dir_url(__FILE__) . '/assets/css/style.css', 
            [], 
            '1.0.0',
            'all'
        );
    }

    public function related_posts_after_content($content) {

        if(is_singular( 'post' )) {
            $current_post_id = get_the_ID(  );
            $categories = get_the_terms( $current_post_id, 'category' );

            $store_category_ids = [];

            if ( !empty ($categories) ) {
                foreach ( $categories as $category ) {
                    $store_category_ids[] = $category->term_id;
                }

                $args = [
                    'post_type' => 'post',
                    'category__in' => $store_category_ids,
                    'posts_per_page' => 4,
                    'fields' => 'ids',
                    'orderby' => 'rand',
                    'post__not_in' => array($current_post_id),
                ];
            }

            $posts = get_posts( $args ); 

            $posts_without_duplicate = array_unique( $posts );

            if ( !empty ( $posts ) ) {
                $content .= '<div class="related-posts">';
                $content .= '<h2 class="title">Related Posts</h2>';
                $content .= '<div class="posts-columns">';

                foreach ( $posts as $post ) {
                    $title = get_the_title( $post );
                    $permalink = get_permalink( $post );
                    $thumbnail = get_the_post_thumbnail_url( $post, 'medium');
                    $description = substr(get_the_content($post), 0, 40);

                    // Retrieve Author ID, Image, Display Name, URL
                    $author_id = get_the_author_ID( $post );
                    $author_image = get_avatar_url( $author_id );
                    $author_name = get_the_author_meta( 'display_name', $author_id );
                    $author_url = get_author_posts_url( $author_id );

                    $content .= '<div class="posts-card">';
                    $content .= '<img src="' . $thumbnail . '" class="card-img" alt="">';
                    $content .= '<div class="posts-content">';
                    $content .= '<p>March 22, 2024</p>';
                    $content .= '<h2>' . $title . '</h2>';
                    $content .= '<p class="posts-description">'. $description .'...<span>Read More</span> </p>';
                    $content .= '</div>';
                    $content .= '<div class="posts-author">';
                    $content .= '<img src="' . $author_image . '" class="author-img" alt="">';
                    $content .= '<h3><a href="'. $author_url .'">'. $author_name .'</a></h3>';
                    $content .= '</div>';
                    $content .= '</div>';
                }
                $content .= '</div>';
                $content .= '</div>';
            }
            
        }
        return $content;
    }

 }


 new Related_Posts();