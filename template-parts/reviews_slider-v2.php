<?php

/**
 * Template part for reviews-slider2 section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lavgic
 */

?>


<section class="reviews-slider2" id="reviews">
  <div class="container">
    <div class="bdl bdr">
      <div class="h2-title">
        <?php if (get_field('vidguky_zagolovok')) : ?>
          <h2><?php echo get_field('vidguky_zagolovok'); ?></h2>
        <?php endif; ?>
      </div>
    </div>
    <div class="reviews-slider2__grid">
      <div class="swiper-wrapper">
        <?php $vidguky = get_field('vidguky'); ?>
        <?php foreach ($vidguky as $item) { ?>
          <div class="swiper-slide">
            <div class="reviews-slider2__item">

              <div>
                <div class="reviews-slider2__reit">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/stars2.png" alt="">
                </div>
                <div class="reviews-slider2__text"><?php echo  $item['vidguk']; ?></div>
              </div>

              <div class="reviews-slider2__author">
                <div class="reviews-slider2__avatar">
                  <?php
                  $image_id = $item['avatar'];
                  get_picture($image_id, 'avatar', esc_html(get_the_title()))
                  ?>
                </div>

                <div class="reviews-slider2__name"><?php echo  $item['imya']; ?></div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="reviews-slider2__more">
      <div class="reviews-slider2__navigation">
        <div class="reviews-slider2__prev">
          <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-prev.svg" alt="">
        </div>
        <div class="reviews-slider2__next">
          <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-next.svg" alt="">
        </div>
      </div>
    </div>
  </div>
</section>