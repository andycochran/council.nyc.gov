<?php /* Template Name: Print Districts */ ?><!doctype html>

<html class="no-js"  <?php language_attributes(); ?>>

  <head>
    <meta charset="utf-8">

    <!-- Force IE to use the latest rendering engine available -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

    <?php wp_head(); ?>

    <style>
    @media all {
      .site-logo a {
        text-decoration: none !important;
      }
      .cm-thumbnail {
        position: relative !important;
        background-size: cover !important;
        background-position: center !important;
        width: 100% !important;
        height: 0 !important;
        padding-bottom: 150% !important;
        margin-bottom: 0rem !important;
        overflow: hidden !important;
      }
      .cm-thumbnail img {
        position: absolute !important;
        top: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        left: 0 !important;
        height: 100% !important;
        max-width: none !important;
      }
    }
    </style>

  </head>

  <body <?php body_class(); ?>>

    <div class="site-container">

      <div class="row">
        <div class="columns">

          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

            <header class="page-header text-center">
              <h1 class="header-xxlarge site-logo"><a style="font-size:2em;"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/nyc-seal-blue.png">New York City Council</a></h1>
              <p class="header-small subheader sans-serif"><em>as of <?php $todayDateTime = date("F j, Y"); echo $todayDateTime ?></em></p>
            </header>

            <?php the_content(); ?>

            <div id="districts-list">
              <div class="row small-up-3 medium-up-6 text-center text-small">
                <?php

                // Get all the pages that use the District template
                $args = array(
                  'post_type' => 'page',
                  'post_status' => 'publish',
                  'orderby'    => 'menu_order',
                  'order'      => 'ASC',
                  'posts_per_page' => '-1',
                  'meta_query' => array(
                      array(
                          'key' => '_wp_page_template',
                          'value' => 'page-district.php',
                      )
                  )
                );
                $list_districts = new WP_Query( $args );

                // Loop through the District pages
                if ( $list_districts->have_posts() ) {
                  while ( $list_districts->have_posts() ) : $list_districts->the_post();

                  // Get the District meta
                  $current_member_site_ID = get_post_meta($post->ID, 'current_member_site', true);

                  if ($current_member_site_ID) {
                    // Switch to the current Member's site
                    switch_to_blog($current_member_site_ID);

                    // Get the Member's site meta
                    $number = get_blog_option($current_member_site_ID,'council_district_number');
                    $name = get_blog_option($current_member_site_ID,'council_member_name' );
                    $thumbnail = get_blog_option($current_member_site_ID,'council_member_thumbnail' );

                    restore_current_blog();
                    wp_reset_postdata();
                  } else {
                    $number = $post->menu_order;
                    $name = 'Vacant';
                    $thumbnail = null;
                  }
                  ?>

                  <div class="column">
                    <div class="column cm-thumbnail"><?php if ($thumbnail) { ?><img src="<?php echo $thumbnail; ?>"><?php } ?></div>
                    <strong><?php echo $name; ?></strong><br>District&nbsp;<?php echo $number; ?>
                  </div>

                  <?php
                  endwhile;
                  wp_reset_postdata();
                }
                ?>
              </div>
            </div>

          </article>

          <?php endwhile; endif; ?>

        </div>
      </div>

    </div>

  </body>
</html>
