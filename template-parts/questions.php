<?php

/**
 * Template part for feedback section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lawgic
 */

?>

<section class="questions">
  <div class="container">
    <div class="bdl bdr">
      <div class="h2-title">
        <?php if (get_field('pytannya_zagolovok')) : ?>
          <h2><?php echo get_field('pytannya_zagolovok'); ?></h2>
        <?php endif; ?>

      </div>
    </div>
    <div class="bdl  bdr bdb">
      <div class="questions__grid">
        <?php $pytannya = get_field('pytannya'); ?>
        <div class="questions__left bdr">
          <?php foreach ($pytannya as $key => $item) : ?>
            <a href="#tbs<?php echo $key; ?>" class="questions__item <?php if ($key == 0) echo ' active'; ?> ">
              <?php echo $item['pytannya']; ?>
              <div class="questions__number">
                <?php if ($key + 1 < 10) : ?>0<?php echo $key + 1; ?><?php endif; ?>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
        <div class="questions__right">

          <div class="questions__body bdb">
            <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-lg.svg" alt="" width="218" height="223"> -->
            <?php foreach ($pytannya as $key => $item) : ?>
              <div class="question__tab <?php if ($key == 0) echo ' active'; ?>" id="tbs<?php echo $key; ?>">
                <?php echo $item['vidpovid']; ?>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="questions__footer ">
            <b><?php _e('Є питання? Наш експерт допоможе знайти рішення саме для вас!', 'lawgic'); ?></b>
            <a href="" class="btn btn__gold" data-fancybox><span>Задати питання експерту</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>