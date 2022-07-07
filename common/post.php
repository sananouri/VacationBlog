<?php
    class Post {
        public function __construct($post_entry) {
            $this->username = $post_entry['user_name'];
            $this->img = $post_entry['img_name'];
            $this->user_img = $post_entry['user_image'];
            $this->cities = explode(",", $post_entry['city']);
            $this->country = explode(",", $post_entry['country'])[0];
            $this->start = $post_entry['start_date'];
            $this->end = $post_entry['end_date'];
            $this->cost = $post_entry['cost'];
            $this->transportation = explode(",", $post_entry['transportation']);
            $this->residence = explode(",", $post_entry['residence']);
            $this->highlights = $post_entry['highlights'];
            $this->experience = $post_entry['experience'];
        }
    }
?>