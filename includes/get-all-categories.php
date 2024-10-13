<?php 

class Get_All_Categories {
    public static function get_all_the_categories() {
        $unique_post_ids = []; // Initialize as an empty array
        $current_post_id = get_the_ID();
        $categories = get_the_terms( $current_post_id, 'category' );
        
        $store_category_ids = [];
    
        if ( !empty($categories) ) {
            foreach ( $categories as $category ) {
                $store_category_ids[] = $category->term_id;
            }

            $args = [
                'post_type'         => 'post',
                'category__in'      => $store_category_ids,
                'posts_per_page'    => 5,
                'orderby'           => 'rand',
                'post__not_in'      => [$current_post_id],
                'fields'            => '', // Ensures full post objects are returned
            ];
    
            $query = new WP_Query( $args );
    
            // Check if posts exist and pluck IDs
            if ( $query->have_posts() ) {
                $unique_post_ids = wp_list_pluck($query->posts, 'ID');
            }
            
            wp_reset_postdata(); // Reset post data
        }
    
        return array_unique( $unique_post_ids );
    }
}