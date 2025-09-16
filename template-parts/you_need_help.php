  <?php

  /**
   * Template part for feedback section
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package lawgic
   */

  ?>

  <section class="ynh" id="ynh">
    <div class="container">
      <div class="bdl bdr">
        <div class="h2-title">
          <?php if (get_field('ynh_zagolovok')) : ?>
            <h2><?php echo get_field('ynh_zagolovok'); ?></h2>
          <?php endif; ?>
        </div>
        <div class="subtitle">
          <?php if (get_field('ynh_pidzagolovok')) : ?>
            <h2><?php echo get_field('ynh_pidzagolovok'); ?></h2>
          <?php endif; ?>
        </div>
      </div>

      <div class="bdl bdr">
        <div class="ynh__grid">

          <?php $family_law = get_field('ynh'); ?>
          <?php foreach ($family_law as $key => $item) : ?>
            <a href="#pop-up" data-source="<?php echo htmlspecialchars(strip_tags($item['nazva'])); ?>"  data-fancybox class="ynh__item">
              <div class="ynh__title">
                <?php echo $item['nazva']; ?>
              </div>
            </a>
          <?php endforeach ?>

        </div>
      </div>
    </div>
  </section>