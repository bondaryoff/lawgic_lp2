<?php

/**
 * Template part for example section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lawgic
 */
?>
<?php $case = get_field('case'); ?>
<?php if (isset($case)) : ?>
  <section class="example2" id="example">
    <div class="container">
      <div class="bdl bdr bdb example2-wr">
        <?php if (get_field('case_zagolovok')) : ?>
          <div class="h2-title">
            <h2><?php echo get_field('case_zagolovok'); ?></h2>
          </div>
        <?php endif; ?>
        <div class="example2__slider-wrapp">
          <div class="example2__slider">
            <div class="swiper-wrapper">
              <?php foreach ($case as $key => $item) : ?>
                <div class="swiper-slide">
                  <div class="example2__item">
                    <div class="example2__left">
                      <div class="example2__top">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-lg.svg" alt="">
                      </div>
                      <?php if ($item['nazva']) : ?>
                        <div class="example2__title">
                          <?php echo $item['nazva']; ?>
                        </div>
                      <?php endif; ?>

                      <?php if ($item['opys']) : ?>
                        <div class="example2__opys">
                          <?php echo $item['opys']; ?>
                        </div>
                      <?php endif; ?>

                      <?php if ($item['rishennya']) : ?>
                        <div class="example2__rishennya">
                          <b><?php _e('Рішення:', 'lawgic'); ?></b>
                          <?php echo $item['rishennya']; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                    <div class="example2__lawyer">
                      <?php $advokat = $item['advokat']; ?>
                      <div class="example2__img">
                        <?php
                        $image_id = get_field('foto_2', $advokat->ID);
                        get_picture($image_id['ID'], 'example2', esc_html(get_the_title()))
                        ?>
                      </div>
                      <div class="example2__text">
                        <div>

                          <b><?php echo $advokat->post_title;  ?></b>
                          <span>
                            <?php if (get_field('posada', $advokat->ID)) : ?>
                              <?php echo get_field('posada', $advokat->ID); ?>
                            <?php endif; ?>
                          </span>
                        </div>
                        <a href="#pop-up" data-source="<?php echo htmlspecialchars(strip_tags($item['nazva'])); ?>"  class="btn btn__gold" data-fancybox><span class="pc"><?php _e('Допомога від адвоката', 'lawgic'); ?></span><span class="mob"><?php _e('Допомога', 'lawgic'); ?></span></a>
                      </div>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="example2__prev">
            <svg width="22" height="105" viewBox="0 0 22 105" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.5" d="M20.5633 2.52136C20.7757 3.15568 20.9408 3.90821 21.0492 4.73581C21.1575 5.5634 21.207 6.44979 21.1946 7.3441C21.1823 8.23842 21.1085 9.12309 20.9774 9.94738C20.8463 10.7717 20.6605 11.5194 20.4306 12.1476L5.7413 52.4342L19.3149 93.1215C19.7429 94.4042 19.9694 96.139 19.9445 97.9443C19.9196 99.7495 19.6454 101.477 19.1822 102.748C18.719 104.018 18.1048 104.727 17.4746 104.718C16.8444 104.71 16.2498 103.984 15.8218 102.701L0.632303 57.1835C0.419863 56.5492 0.254738 55.7966 0.146396 54.969C0.0380545 54.1415 -0.0113718 53.2551 0.00095125 52.3608C0.0132742 51.4664 0.0871042 50.5818 0.218208 49.7575C0.349311 48.9332 0.535108 48.1855 0.764945 47.5572L17.2029 2.47505C17.432 1.84461 17.7007 1.34559 17.9938 1.0066C18.2869 0.66762 18.5984 0.495329 18.9106 0.499631C19.2228 0.503933 19.5295 0.684743 19.8131 1.03167C20.0967 1.37861 20.3516 1.88484 20.5633 2.52136Z" fill="url(#paint0_linear_2060_3681)"></path>
              <defs>
                <linearGradient id="paint0_linear_2060_3681" x1="-85.715" y1="111.315" x2="28.5247" y2="25.6238" gradientUnits="userSpaceOnUse">
                  <stop offset="0.0580958" stop-color="#E6D1BE"></stop>
                  <stop offset="0.929784" stop-color="#896954"></stop>
                </linearGradient>
              </defs>
            </svg>
          </div>
          <div class="example2__next">
            <svg width="21" height="105" viewBox="0 0 21 105" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.5" d="M0.697723 102.616C0.476562 101.984 0.301086 101.234 0.181352 100.408C0.0616181 99.582 -1.79011e-05 98.6964 -1.79118e-05 97.802C-1.79225e-05 96.9076 0.061618 96.022 0.181352 95.1959C0.301086 94.3699 0.476562 93.6197 0.697723 92.9884L14.8306 52.5032L0.697722 12.0068C0.25206 10.7301 0.00169001 8.99864 0.00168999 7.19319C0.00168997 5.38774 0.25206 3.65624 0.697722 2.3796C1.14338 1.10295 1.74783 0.385742 2.37809 0.385742C3.00835 0.385742 3.61279 1.10295 4.05845 2.3796L19.8737 47.684C20.0948 48.3153 20.2703 49.0655 20.39 49.8915C20.5098 50.7176 20.5714 51.6032 20.5714 52.4976C20.5714 53.392 20.5098 54.2776 20.39 55.1036C20.2703 55.9296 20.0948 56.6798 19.8737 57.3112L4.05846 102.616C3.83806 103.249 3.57618 103.752 3.28782 104.095C2.99947 104.438 2.69031 104.614 2.37809 104.614C2.06586 104.614 1.75671 104.438 1.46835 104.095C1.18 103.752 0.918115 103.249 0.697723 102.616Z" fill="url(#paint0_linear_2060_3681)"></path>
              <defs>
                <linearGradient id="paint0_linear_2060_3681" x1="105.467" y1="-7.63184" x2="-7.58125" y2="79.625" gradientUnits="userSpaceOnUse">
                  <stop offset="0.0580958" stop-color="#E6D1BE"></stop>
                  <stop offset="0.929784" stop-color="#896954"></stop>
                </linearGradient>
              </defs>
            </svg>
          </div>
        </div>
        <div class="example2__pagination">
        </div>
      </div>

    </div>
  </section>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>