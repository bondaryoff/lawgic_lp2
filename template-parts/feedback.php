<?php

/**
 * Template part for feedback section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lawgic
 */

?>

<section class="feedback">
  <div class="container">
    <div class="bdl bdr">
      <div class="h2-title">
        <h2>Контакти</h2>
      </div>
    </div>
    <div class="bdl  bdr bdb">
      <div class="feedback__grid">
        <div class="feedback__left bdr">
          <div class="feedback__header">

            <?php if (get_field('rozklad', 'option')) : ?>
              <div class="promo__schedule">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/clock-d.svg" width="17" height="17" alt="shedule">
                <?php echo get_field('rozklad', 'option'); ?>
              </div>
            <?php endif; ?>

          </div>

          <div class="feedback__body bdt bdb">
            <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-lg.svg" width="104" height="107" alt="feedback" class="feedback__logo"> -->
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/map.png" width="219.28" height="224.36" alt="feedback">
          </div>
          <?php
          $posylannya_na_kartu = get_field('posylannya_na_kartu', 'option');
          $adressa = get_field('adressa', 'option');
          ?>
          <div class="feedback__footer">
            <div class="location">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/location.svg" width="15" height="18" aria-hidden="true" alt="">
              <a href="<?php echo $posylannya_na_kartu; ?>" rel="nofollow" target="_blank"><?php echo $adressa; ?></a>
              <img data-text="<?php _e('Посилання скопійовано', 'lawgic') ?>" class="copy-link" src="<?php echo get_template_directory_uri(); ?>/assets/img/copy.svg" width="18" height="18" alt="Скопіювати посилання">
            </div>
          </div>
        </div>
        <div class="feedback__right">
          <div class="feedback__header">
            <div class="feedback__title">
              <?php _e('Ваш успіх - наша мета.', 'lawgic') ?>


            </div>
            <div class="feedback__phone">
              <?php $telefon_1 = get_field('telefon_1', 'option'); ?>
              <a href="tel:<?php echo htmlspecialchars(preg_replace('/\D+/', '', $telefon_1)); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone-g.svg" width="35" height="35" alt="Подзвонити">
              </a>
            </div>
          </div>
          <div class="feedback__body bdb bdt">
            <?php echo do_shortcode('[contact-form-7 id="a4f30c4" title="feedback-ua"]'); ?>
          </div>
          <div class="feedback__footer ">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>