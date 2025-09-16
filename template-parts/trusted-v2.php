<?php

/**
 * Template part for trusted section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lawgic
 */
?>

<section class="trusted">
  <div class="container">
    <div class="row bdl bdr bdb">
      <div class="trusted__item">
        <?php if (get_field('bl4_punkt_1_chysla')) : ?>
          <span><?php echo get_field('bl4_punkt_1_chysla'); ?></span>
        <?php endif; ?>
        <?php if (get_field('bl4_punkt_1_tekst')) : ?>
          <p><?php echo get_field('bl4_punkt_1_tekst'); ?></p>
        <?php endif; ?>
      </div>
      <div class="trusted__item">
        <?php if (get_field('bl4_punkt_2_chysla')) : ?>
          <span><?php echo get_field('bl4_punkt_2_chysla'); ?></span>
        <?php endif; ?>
        <?php if (get_field('bl4_punkt_2_tekst')) : ?>
          <p><?php echo get_field('bl4_punkt_2_tekst'); ?></p>
        <?php endif; ?>
      </div>
      <div class="trusted__item">
        <?php if (get_field('bl4_punkt_3_chysla')) : ?>
          <span><?php echo get_field('bl4_punkt_3_chysla'); ?></span>
        <?php endif; ?>
        <?php if (get_field('bl4_punkt_3_tekst')) : ?>
          <p><?php echo get_field('bl4_punkt_3_tekst'); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>