<article style="margin:0 0 2rem;padding-top:0;border:0;" id="post-<?php the_ID(); ?>" <?php post_class('columns medium-6'); ?>>
  <?php
  $content = apply_filters('the_content', get_post_field('post_content', $post_id));
  $iframes = get_media_embedded_in_content( $content, 'iframe' );
  echo $iframes[0];
  ?>
  <p class="byline" style="margin:-0.5rem 0 0;"><?php the_time('F j, Y') ?></p>
  <h2 class="header-tiny sans-serif"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
</article>