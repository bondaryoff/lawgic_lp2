<?php

/**
 * Template Name: Лендинг Версія 1
 **/

get_header();
?>

<div class="wrapper">
  <?php
  get_template_part('template-parts/header', 'v1');
  get_template_part('template-parts/family_law');
  get_template_part('template-parts/other_help');
  get_template_part('template-parts/trouble');
  get_template_part('template-parts/steps');
  get_template_part('template-parts/example');
  get_template_part('template-parts/trusted');
  get_template_part('template-parts/reviews');
  get_template_part('template-parts/questions');
  get_template_part('template-parts/feedback');
  ?>
  <div class="container">
    <div class="pre-footer-divider"></div>
  </div>
</div>
<?php get_footer();
