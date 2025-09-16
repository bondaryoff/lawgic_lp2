<section class="promo">
  <header class="header bdb">
    <div class="container">
      <div class="header__row">
        <div class="header__burger" id="burger">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/burger.svg" width="40" height="26" alt="Меню">
        </div>
        <div class="header__left">
          <?php if (is_front_page()): ?>
            <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sm-front.svg" width="63" height="64" alt="Логотип"> -->
          <?php else: ?>
            <a href="<?php echo home_url(); ?>">
              <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sm-front.svg" width="63" height="64" alt="Логотип"> -->
            </a>
          <?php endif; ?>
        </div>
        <div class="header__center">
          <?php
          $menu_locations = get_nav_menu_locations();
          $menu_id = $menu_locations['main_menu'];
          $menu_items = wp_get_nav_menu_items($menu_id);

          $total_items = count($menu_items);
          $half = floor($total_items / 2);
          ?>

          <nav class="main-menu">
            <ul>
              <?php foreach ($menu_items as $index => $item):
              ?>
                <?php if (($index) == $half): ?>
                  <!-- Логотип між пунктами -->
                  <!-- <li class="menu-logo">
                    <?php if (is_front_page()): ?>
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-frontpage.svg" width="172" height="29" alt="Logo">
                    <?php else: ?>
                      <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-frontpage.svg" width="172" height="29" alt="Logo">
                      </a>
                    <?php endif; ?>
                  </li> -->
                <?php endif;
                ?>
                <li class="menu-item">
                  <a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        </div>
        <div class="header__logo">
          <!-- <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" width="108" height="30.77" alt="Logo">
          </a> -->
        </div>
        <div class="header__right">
          <div class="language-switcher">
            <?php
            wp_nav_menu(
              array(
                'theme_location' => 'lang_menu',
                'menu_id'        => 'lang_menu',
              )
            );
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="mobile-menu">
      <div class="mobile-menu-wr">
        <div class="mobile-menu-top-wr">
          <div class="mobile-menu-top">
            <div class="mobile-menu-close">
              <svg width="40" height="34" viewBox="0 0 40 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6.82812" width="40" height="4" transform="rotate(45 6.82812 0)" fill="white" />
                <rect x="4" y="28.3047" width="40" height="4" transform="rotate(-45.0432 4 28.3047)" fill="white" />
              </svg>
            </div>
            <div class="language-switcher">
              <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'lang_menu',
                  'menu_id'        => 'lang_menu',
                )
              );
              ?>
            </div>

          </div>


          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'main_menu',
              'menu_id'        => 'main_menu',
            )
          );
          ?>
        </div>
      </div>
    </div>
  </header>
  <script>
    const currentLanguage = document.querySelector('.wpml-ls-current-language');
    if (currentLanguage) {
      const displaySpan = currentLanguage.querySelector('.wpml-ls-native');
      if (displaySpan) {
        const newWrapper = document.createElement('span');
        const newInnerSpan = displaySpan.cloneNode(true);
        newWrapper.appendChild(newInnerSpan);

        currentLanguage.innerHTML = '';
        currentLanguage.appendChild(newWrapper);
      }
    }
  </script>
  <div class="container">
    <div class="promo__row bdl bdr">
      <div class="promo__box">
        <div class="promo__top">
          <div class="promo__contacts-bar">
            <?php if (get_field('telefon_1', 'option')) : ?>
              <?php $telefon_1 = get_field('telefon_1', 'option'); ?>
              <a href="tel:<?php echo htmlspecialchars(preg_replace('/\D+/', '', $telefon_1)); ?>" class="phone" rel="nofollow noopen">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-white-phone.svg" width="19" height="19" alt="phone">
              </a>
            <?php endif; ?>
            <?php if (get_field('emejl', 'option')) : ?>
              <a href="mailto:<?php echo get_field('emejl', 'option'); ?>" class="mail">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-white-mail.svg" width="20" height="16" alt="email">
              </a>
            <?php endif; ?>
          </div>

          <?php if (get_field('promo_zagolovok')) : ?>
            <h1><?php echo get_field('promo_zagolovok'); ?></h1>
          <?php endif; ?>
          <?php if (get_field('promo_pidzagorlovok')) : ?>
            <div class="subtext"><?php the_field('promo_pidzagorlovok'); ?></div>
          <?php endif; ?>

          <?php $promo_tekst = get_field('promo_tekst'); ?>

          <?php if ($promo_tekst) : ?>
            <div class="promo-text">
              <span>|</span>
              <?php foreach ($promo_tekst as $tekst) : ?>
                <div class="promo-text__item">
                  <?php echo $tekst['tekst'];  ?>
                  <span>|</span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>

        <div class="promo__butom">
          <div class="promo__buttons">
            <a href="#pop-up" class="btn btn__gold" data-fancybox>
              <span><?php _e('Звернутись за допомогою', 'lawgic') ?></span>
            </a>
          </div>
          <div class="promo-to-down">
            <a href="#lawyers">
              <svg width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.555662 1.3064C0.712437 1.14908 0.898723 1.02426 1.10384 0.939088C1.30896 0.853916 1.52888 0.810071 1.75097 0.810071C1.97307 0.810071 2.19299 0.853916 2.3981 0.939088C2.60322 1.02426 2.78951 1.14908 2.94629 1.3064L12.9996 11.3597L23.0557 1.3064C23.3727 0.989387 23.8027 0.81129 24.251 0.81129C24.6993 0.81129 25.1293 0.989387 25.4463 1.3064C25.7633 1.62342 25.9414 2.05339 25.9414 2.50172C25.9414 2.95005 25.7633 3.38001 25.4463 3.69703L14.1963 14.947C14.0395 15.1043 13.8532 15.2292 13.6481 15.3143C13.443 15.3995 13.2231 15.4434 13.001 15.4434C12.7789 15.4434 12.559 15.3995 12.3538 15.3143C12.1487 15.2292 11.9624 15.1043 11.8057 14.947L0.555662 3.69703C0.398342 3.54025 0.273516 3.35396 0.188345 3.14885C0.103173 2.94373 0.0593299 2.72381 0.0593299 2.50171C0.05933 2.27962 0.103173 2.0597 0.188345 1.85458C0.273517 1.64946 0.398342 1.46318 0.555662 1.3064Z" fill="white" />
              </svg>

            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>