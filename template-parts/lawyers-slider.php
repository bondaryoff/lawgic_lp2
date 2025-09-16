<?php

/**
 * Template part for lawyers-slider section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lavgic
 */

?>
<?php
$args = array(
  'post_type' => 'team',
  'posts_per_page' => -1,
  'post__in' =>  $bl5_yurysty,
  'orderby' => 'post__in',
  'order' => 'ASC'
);
$query = new WP_Query($args);
?>
<?php if ($query->have_posts()) : ?>
  <section class="lawyers-slider" id="lawyers">
    <div class="container">
      <div class="bdl bdr">
        <?php if (get_field('yurysty_zagolovok')) : ?>
          <div class="h2-title">
            <h2><?php echo get_field('yurysty_zagolovok'); ?></h2>
          </div>
        <?php endif; ?>
        <div class="bdt bdb">
          <div class="lawyers-slider__slider">
            <div class="swiper-wrapper">
              <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="swiper-slide">
                  <div class="lawyers-slider__item">
                    <a href="<?php the_permalink(); ?>" class="lawyers-slider__img">
                      <?php
                      $image_id = get_field('foto_2');
                      get_picture($image_id['ID'], 'advocat-slider', esc_html(get_the_title()))
                      ?>
                    </a>

                    <div class="lawyers-slider__info">
                      <a href="<?php the_permalink(); ?>">
                        <div class="lawyers-slider__name"><?php the_title(); ?></div>
                      </a>
                      <?php if (get_field('posada')) : ?>
                        <div class="lawyers-slider__position"><?php echo get_field('posada'); ?></div>
                      <?php endif; ?>
                      <?php if (get_field('opys')) : ?>
                        <div class="lawyers-slider__description"><?php echo get_field('opys'); ?></div>
                      <?php endif; ?>

                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
          <div class="lawyers-slider__more">
            <div class="lawyers-slider__navigation">
              <div class="lawyers-slider__prev">
                <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-prev.svg" alt="">
              </div>
              <div class="lawyers-slider__next">
                <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-next.svg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>