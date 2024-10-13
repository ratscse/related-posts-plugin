<?php 

class Show_Related_Posts_Html {
    public static function show_related_posts_html( $unique_posts ) {
        $container_html = sprintf(
            '<div class="related-posts">
                <h2 class="title">%s</h2>
                <div class="posts-columns">',
            esc_html__('Related Posts', 'ratan-related-posts')
        );

        // Loop through each post
        foreach ( $unique_posts as $post_id ) {
            $container_html .= Show_Loop_Html::show_loop_html( $post_id );
        }

        $container_html .= '</div></div>';

        return $container_html;
    }
}