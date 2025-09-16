<?php

/**
 * Template part for example section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lawgic
 */
?>
<?php $example = get_field('example'); ?>
<?php if (isset($example)) : ?>
  <section class="example" id="example">
    <div class="container">
      <div class="bdl bdr">
        <?php if (get_field('example_zagolovok')) : ?>
          <div class="h2-title">
            <h2><?php echo get_field('example_zagolovok'); ?></h2>
          </div>
        <?php endif; ?>

        <div class="example__slider">
          <div class="swiper-wrapper">
            <?php foreach ($example as $key => $item) : ?>
              <div class="swiper-slide">
                <div class="example__item">
                  <div class="example__top">
                    <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-lg.svg" alt=""> -->
                    <span>
                      <?php _e('Кейс', 'lawgic'); ?>
                      <?php echo $key + 1; ?>
                    </span>
                  </div>
                  <?php if ($item['nazva']) : ?>
                    <div class="example__title">
                      <?php echo $item['nazva']; ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($item['opys']) : ?>
                    <div class="example__opys">
                      <?php echo $item['opys']; ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($item['rishennya']) : ?>
                    <div class="example__rishennya">
                      <b><?php _e('Рішення:', 'lawgic'); ?></b>
                      <?php echo $item['rishennya']; ?>
                    </div>
                  <?php endif; ?>

                  <div class="example__lawyer">
                    <?php $advokat = $item['advokat']; ?>
                    <div class="example__img">
                      <?php
                      $image_id = get_field('foto_2', $advokat->ID);
                      get_picture($image_id['ID'], 'example', esc_html(get_the_title()))
                      ?>
                    </div>
                    <div class="example__text">
                      <b><?php echo $advokat->post_title;  ?></b>
                      <span>
                        <?php if (get_field('posada', $advokat->ID)) : ?>
                          <?php echo get_field('posada', $advokat->ID); ?>
                        <?php endif; ?>
                      </span>
                    </div>
                  </div>
                  <a href="" class="btn btn__gold" data-fancybox><span><?php _e('Поставити запитання юристу', 'lawgic'); ?></span></a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="example__more">
          <div class="example__navigation">
            <div class="example__prev">
              <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-prev.svg" alt="">
            </div>
            <div class="example__next">
              <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-next.svg" alt="">
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>