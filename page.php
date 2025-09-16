<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lawgic
 */

get_header();
?>
<?php get_template_part('template-parts/reusable/header'); ?>
<?php get_template_part('template-parts/reusable/breadcrumbs'); ?>
<div class="single-page">
  <div class="container">
    <div class="bdl bdr bdt">
      <div class="h1-title bdb">
        <?php the_title('<h1>', '</h1>') ?>
      </div>
      <div class="content">
        <?php the_content(); ?> 
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
