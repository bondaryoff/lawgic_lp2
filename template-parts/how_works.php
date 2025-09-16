  <?php

  /**
   * Template part for feedback section
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package lawgic
   */

  ?>


  <section class="how_works" id="how_works">
    <div class="container">
      <div class="bdl bdr">
        <div class="h2-title">
          <?php if (get_field('how_works_zagolovok')) : ?>
            <h2><?php echo get_field('how_works_zagolovok'); ?></h2>
          <?php endif; ?>
        </div>
      </div>
      <div class="how_works__slider">
        <div class="swiper-wrapper">
          <?php $family_law = get_field('how_works'); ?>
          <?php foreach ($family_law as $key => $item) : ?>
            <div class="swiper-slide">
              <div class="how_works__item">
                <div>
                  <div class="how_works__title">
                    <h3><?php echo $item['nazva_etapu']; ?></h3>
                  </div>
                  <div class="how_works__text">
                    <?php echo $item['tekst']; ?>
                  </div>
                </div>
                <div class="how_works__img">
                  <?php
                  $image_id = $item['zobrazhennya'];
                  get_picture($image_id, 'howworks', esc_html(get_the_title()))
                  ?>
                </div>
                <div class="how_works__number">
                  <?php echo $key + 1 ?>
                </div>

              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
      <div class="how_works__more">
        <div class="how_works__navigation">
          <div class="how_works__prev">
            <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-prev.svg" alt="">
          </div>
          <div class="how_works__next">
            <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-next.svg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>