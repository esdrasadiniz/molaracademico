<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Educational Zone
 */

$educational_zone_post_page_meta =  get_theme_mod( 'educational_zone_post_page_meta', 1 );

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>
      <header class="entry-header">
        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');?>
        <hr>
        <?php if ($educational_zone_post_page_meta == 1 ) {?>
          <?php if ('post' === get_post_type()) : ?>
              
            <div class="entry-meta">
              <?php
              educational_zone_posted_on();
              ?>
            </div>
              
          <?php endif; ?>
        <?php }?>
      </header>
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the gallery.
          if ( get_post_gallery() ) {
            echo '<div class="entry-gallery">';
              echo ( get_post_gallery() );
            echo '</div>';
          };
        };
      ?>
      <header class="entry-header">
        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');?>
        <hr>
        <?php if ($educational_zone_post_page_meta == 1 ) {?>
          <?php if ('post' === get_post_type()) : ?>
              
            <div class="entry-meta">
              <?php
              educational_zone_posted_on();
              ?>
            </div>
              
          <?php endif; ?>
        <?php }?>
      </header>
    </article>