<?php 

class Class_Related_Posts {
    public function __construct() {
        add_action('init', [$this, 'init']);
    }   

    public function init() {
        Class_Enqueue_Styles::register_scripts();
        Class_Related_Posts_Functions::after_content_filter();
    }

}