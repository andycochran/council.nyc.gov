<?php

// Register sidebars
function nycc_register_sidebars() {
    register_sidebar(
        array(
            'id' => 'posts-sidebar',
            'name' => __( 'Posts Sidebar', 'nycc' ),
            'description' => __( 'widget area for posts, archives, search, etc', 'nycc' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        )
    );
    register_sidebar(
        array(
            'id' => 'frontpage-sidebar',
            'name' => __( 'Front Page Sidebar', 'nycc' ),
            'description' => __( 'widget area for front page only', 'nycc' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        )
    );
}
add_action( 'widgets_init', 'nycc_register_sidebars' );
