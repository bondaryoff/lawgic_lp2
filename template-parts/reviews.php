<?php

/**
 * Template part for rev section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lawgic
 */

?>
<?php $vidguky = get_field('vidguky'); ?>
<?php if (isset($vidguky)) : ?>
  <section class="rev" id="rev">
    <div class="container">
      <div class="bdl bdr">

        <div class="h2-title">
          <?php if (get_field('vidguky_zagolovok')) : ?>
            <h2><?php echo get_field('vidguky_zagolovok'); ?></h2>
          <?php endif; ?>
        </div>

        <div class="rev__slider">
          <div class="swiper-wrapper">
            <?php foreach ($vidguky as $item) : ?>
              <div class="swiper-slide">
                <div class="rev__item">
                  <div class="rev__head">
                    <div class="rev__img">
                      <?php
                      $image_id = $item['avatar'];
                      get_picture($image_id, 'rev', esc_html($item['imya']))
                      ?>
                    </div>
                    <div class="rev__info">
                      <?php if ($item['imya']) : ?>
                        <div class="rev__imya">
                          <?php echo $item['imya']; ?>
                        </div>
                      <?php endif; ?>
                      <div class="rev__rejtyng">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/stars.png" alt="">
                      </div>
                    </div>
                  </div>
                  <?php if ($item['vidguk']) : ?>
                    <div class="rev__vidguk">
                      <?php echo $item['vidguk']; ?>
                    </div>
                  <?php endif; ?>
                  <!--  -->
                  <?php $zobrazhennya = $item['zobrazhennya']; ?>
                  <?php if ($zobrazhennya) : ?>
                    <div class="rev__gallery">
                      <?php foreach ($zobrazhennya as $item) : ?>
                        <a href="<?php echo wp_get_attachment_image_url($item['zobrazhennya'], 'full'); ?>" data-fancybox="gallery">
                          <?php
                          $image_id = $item['zobrazhennya'];
                          get_picture($image_id, 'revimg', esc_html($item['imya']))
                          ?>
                          <span class="overlay">
                            <svg width="49" height="50" viewBox="0 0 49 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M48.188 44.8263L37.4285 34.0623C40.6546 29.8584 42.1607 24.5847 41.6414 19.3111C41.1222 14.0376 38.6164 9.15894 34.6324 5.66494C30.6484 2.17094 25.4845 0.323197 20.1883 0.496531C14.892 0.669865 9.85999 2.8513 6.11297 6.59832C2.36595 10.3453 0.184513 15.3774 0.011179 20.6736C-0.162155 25.9699 1.68559 31.1337 5.17959 35.1177C8.67359 39.1017 13.5522 41.6075 18.8258 42.1268C24.0994 42.6461 29.373 41.1399 33.577 37.9139L44.3455 48.6847C44.5984 48.9375 44.8986 49.1382 45.229 49.275C45.5595 49.4119 45.9136 49.4823 46.2713 49.4823C46.6289 49.4823 46.9831 49.4119 47.3135 49.275C47.6439 49.1382 47.9441 48.9375 48.197 48.6847C48.4499 48.4318 48.6505 48.1315 48.7874 47.8011C48.9243 47.4707 48.9947 47.1165 48.9947 46.7589C48.9947 46.4012 48.9243 46.0471 48.7874 45.7166C48.6505 45.3862 48.4499 45.086 48.197 44.8331L48.188 44.8263ZM5.48321 21.3748C5.48321 18.3277 6.38677 15.3491 8.07963 12.8156C9.77249 10.282 12.1786 8.30736 14.9937 7.14129C17.8089 5.97523 20.9066 5.67014 23.8951 6.26459C26.8836 6.85904 29.6287 8.32635 31.7833 10.4809C33.9379 12.6356 35.4052 15.3807 35.9997 18.3692C36.5941 21.3577 36.289 24.4554 35.123 27.2705C33.9569 30.0857 31.9823 32.4918 29.4487 34.1846C26.9152 35.8775 23.9365 36.7811 20.8895 36.7811C16.8048 36.7769 12.8886 35.1524 10.0002 32.264C7.11191 29.3757 5.48741 25.4595 5.48321 21.3748Z" fill="#D6B07C" />
                            </svg>

                          </span>
                        </a>
                      <?php endforeach ?>
                    </div>
                  <?php endif; ?>
                  <!--  -->
                  <!--  -->
                  <?php $zobrazhennya1 = $item['zobrazhennya']; ?>
                  <?php if ($zobrazhennya1) : ?>
                    <div class="rev__gallery">
                      <?php foreach ($zobrazhennya1 as $item) : ?>
                        <a href="<?php echo wp_get_attachment_image_url($item['zobrazhennya'], 'full'); ?>" data-fancybox="gallery">
                          <?php
                          // $image_id = $item['zobrazhennya'];
                          // get_picture($image_id, 'revimg', esc_html($item['imya']))
                          ?>
                          <span class="overlay">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M55 40L31 53.8564L31 26.1436L55 40Z" fill="#D6B07C" />
                              <circle cx="40" cy="40" r="37.5" stroke="#D6B07C" stroke-width="5" />
                            </svg>


                          </span>
                        </a>
                      <?php endforeach ?>
                    </div>
                  <?php endif; ?>
                  <!--  -->
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="rev__more">
          <div class="rev__navigation">
            <div class="rev__prev">
              <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-prev.svg" alt="">
            </div>
            <div class="rev__next">
              <img class="svg" src="<?php echo get_template_directory_uri(); ?>/assets/img/arr-next.svg" alt="">
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>