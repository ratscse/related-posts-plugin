<?php 

class Class_Related_Posts_Functions {
    public static function after_content_filter() {
        add_filter( 'the_content', [__CLASS__, 'related_posts_after_content'] );
    }

    public static function related_posts_after_content($content) {
        if(is_singular( 'post' )) {
            $unique_posts = Get_All_Categories::get_all_the_categories();

            if ( !empty($unique_posts) ) {
                $content .= Show_Related_Posts_Html::show_related_posts_html( $unique_posts );
            }
        }
        return $content;
    }
}