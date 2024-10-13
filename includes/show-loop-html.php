<?php 

class Show_Loop_Html {
    public static function show_loop_html( $post_id ) {
        $title = get_the_title( $post_id );
        $permalink = get_permalink( $post_id );
        $thumbnail = get_the_post_thumbnail_url( $post_id, 'medium' );

        if ( ! $thumbnail ) {
            $thumbnail = plugin_dir_url( __FILE__ ) . '../assets/images/unisearch.png'; // Add your fallback image path
        }


        $description = wp_trim_words(get_the_content(null, false, $post_id), num_words: 6);
        $date = get_the_date( 'F j, Y', $post_id );

        // Retrieve Author ID, Image, Display Name, URL
        $author_id = get_the_author_meta('ID', $post_id);
        $author_image = get_avatar_url( $author_id );
        $author_name = get_the_author_meta( 'display_name', $author_id );
        $author_nicename = get_the_author_meta( 'user_nicename', $author_id );
        $author_url = get_author_posts_url( $author_id, $author_nicename );

        // Append HTML with original content of the post using sprintf for cleaner HTML
        $loop_html = sprintf(
            '<div class="posts-card">
                <a href="%s"><img src="%s" class="card-img" alt="%s"></a>
                <div class="posts-content">
                    <p class="date">%s</p>
                    <h2><a href="%s">%s</a></h2>
                    <p class="posts-description">%s...<a href="%s"><span>%s</span></a></p>
                </div>
                <div class="posts-author">
                    <img src="%s" class="author-img" alt="%s">
                    <h3><a href="%s">%s</a></h3>
                </div>
            </div>',
            esc_url( $permalink ),
            esc_url( $thumbnail ),
            esc_attr( $title ),
            esc_html( $date ),
            esc_url( $permalink ),
            esc_html( $title ),
            esc_html( $description ),
            esc_url( $permalink ),
            esc_html__('Read More', 'ratan-related-posts'),
            esc_url( $author_image ),
            esc_attr( $author_name ),
            esc_url( $author_url ),
            esc_html( $author_name )
        );

        return $loop_html;
    }
}