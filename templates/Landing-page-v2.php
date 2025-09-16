<?php

/**
 * Template Name: Лендинг Версія 2
 **/

get_header();
?>

<div class="wrapper">
  <?php
  get_template_part('template-parts/header', 'v2');
  get_template_part('template-parts/military_law');
  get_template_part('template-parts/solutions');
  get_template_part('template-parts/trusted', 'v2');
  get_template_part('template-parts/how_works');
  get_template_part('template-parts/you_need_help');
  get_template_part('template-parts/example', 'v2');
  get_template_part('template-parts/lawyers-slider');
  get_template_part('template-parts/reviews_slider', 'v2');
  get_template_part('template-parts/faq', 'v2');
  get_template_part('template-parts/feedback', 'v2');
  ?>
  <div class="container">
    <div class="pre-footer-divider"></div>
  </div>
</div>
<?php get_footer();
