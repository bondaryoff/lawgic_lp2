<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lawgic
 */

?>
<footer class="footer">

  <div class="container">
    <div class="footer__services">
      <div class="footer__title">
        <?php
        $zagolovok_futer = get_field('zagolovok_futer', 'option');
        if ($zagolovok_futer):
          echo $zagolovok_futer;
        endif;
        ?>
      </div>
    </div>
    <div class="footer__row">
      <div class="footer__contacts">
        <div class="footer__logo">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-footer.svg" width="96" height="122" alt="Логотип">
        </div>

        <div class="footer__info">

          <?php
          $posylannya_na_kartu = get_field('posylannya_na_kartu', 'option');
          $adressa = get_field('adressa', 'option');
          if ($adressa):
          ?>
            <div class="location">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/location.svg" width="9" height="10"  alt="Розташування">
              <a href="<?php echo $posylannya_na_kartu; ?>"  rel="nofollow" target="_blank"><?php echo $adressa; ?></a>
              <img data-text="<?php _e('Посилання скопійовано', 'lawgic') ?>" class="copy-link" src="<?php echo get_template_directory_uri(); ?>/assets/img/copy.svg" width="10" height="10" alt="Скопіювати посилання">
            </div>
          <?php endif; ?>

          <?php $rozklad = get_field('rozklad', 'option');
          if ($rozklad): ?>
            <div class="rozklad">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/clock-d.svg" width="10" height="10" alt="Розклад">
              <?php echo $rozklad; ?>
            </div>
          <?php endif; ?>


          <?php
          $telefon_1 = get_field('telefon_1', 'option');
          $telefon_2 = get_field('telefon_2', 'option');
          $telefon_3 = get_field('telefon_3', 'option');
          ?>
          <div class="footer__phones">
            <?php if ($telefon_1): ?>
              <a href="tel:<?php echo htmlspecialchars(preg_replace('/\D+/', '', $telefon_1)); ?>" rel="nofollow noopen">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone.svg" width="13" height="18" alt="Телефон">
                <span><?php echo $telefon_1 ?></span></a>
            <?php endif; ?>
            <?php if ($telefon_2): ?>
              <a href="tel:<?php echo htmlspecialchars(preg_replace('/\D+/', '', $telefon_2)); ?>" rel="nofollow noopen">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone.svg" width="13" height="18" alt="Телефон">
                <span><?php echo $telefon_2 ?></span></a>
            <?php endif; ?>
            <?php if ($telefon_3): ?>
              <a href="tel:<?php echo htmlspecialchars(preg_replace('/\D+/', '', $telefon_3)); ?>" rel="nofollow noopen">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone.svg" width="13" height="18" alt="Телефон">
                <span><?php echo $telefon_3 ?></span></a>
            <?php endif; ?>
          </div>

          <div class="footer-menu-mob">
            <?php
            wp_nav_menu(
              array(
                'theme_location' => 'footer_menu2',
                'menu_id'        => 'footer_menu2',
              )
            );
            ?>
          </div>
        </div>
      </div>

    </div>
    <?php if ($adressa): ?>
      <div class="location-mob">
        <a href="<?php echo get_field('posylannya_na_kartu', 'option'); ?>" target="_blank" rel="nofollow"><?php echo $adressa; ?> </a>
      </div>
    <?php endif; ?>
  </div>


  <div class="subfooter">
    <div class="container">
      <div class="footer__row">
        <div class="subfooter__copywrite">
          <?php $kopirajty = get_field('kopirajty', 'option');
          if ($kopirajty): ?>
            © 2010-
            <?php echo date('Y'); ?>
            <?php echo $kopirajty; ?>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>

</footer>

<div class="pop-up" id="pop-up" style="display: none">
  <div class="pop-up__row">
    <div class="pop-up__cover">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/popap2.webp" alt="">
    </div>
    <div class="pop-up__box bd">
      <div class="pop-up__bar bdb">
        <div class="feedback__s-links">
          <ul>
            <?php if (get_field('linkedin', 'option')) : ?>
              <li>
                <a href=" <?php echo get_field('linkedin', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/in.svg"  width="20" height="20" alt="linkedin">
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_field('faceboock', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('faceboock', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fb.svg"  width="20" height="19" alt="faceboock">
                </a>
              </li>
            <?php endif; ?>
            <?php if (get_field('x', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('x', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/x.svg"  width="18" height="17" alt="x">
                </a>
              </li>
            <?php endif; ?>
            <?php if (get_field('instagram', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('instagram', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/insta.svg"  width="21" height="19" alt="instagram">
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="pop-up__close">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/close.svg" alt="close">
        </div>

      </div>
      <div class="pop-up__body">
        <?php if (get_field('popup_zagolovok', 'option')) : ?>
          <div class="pop-up__title"><?php echo get_field('popup_zagolovok', 'option'); ?></div>
        <?php endif; ?>

        <?php if (get_field('popup_pidzagolovok', 'option')) : ?>
          <div class="pop-up__subtitle"><?php echo get_field('popup_pidzagolovok', 'option'); ?></div>
        <?php endif; ?>

        <div class="pop-up__form">
          <?php echo do_shortcode('[contact-form-7 id="0651bde" title="Заявка на допомогу"]'); ?>
        </div>
        <div class="pop-up__items">
          <ul>
            <?php if (get_field('popup_tekst_1', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-1-1.svg" width="19" height="auto" alt=""></span><?php the_field('popup_tekst_1', 'option'); ?></li>
            <?php endif; ?>
            <?php if (get_field('popup_tekst_2', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-3-1.svg" width="22" height="auto"  alt=""></span> <?php the_field('popup_tekst_2', 'option'); ?></li>
            <?php endif; ?>
            <?php if (get_field('popup_tekst_3', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-2-1.svg"  width="16" height="auto"  alt=""></span><?php the_field('popup_tekst_3', 'option'); ?></li>
            <?php endif; ?>
            <?php if (get_field('popup_tekst_4', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-4-1.svg"  width="24" height="auto"  alt=""></span><?php the_field('popup_tekst_4', 'option'); ?></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <div class="pop-up__footer bdt">
        <div class="location">
          <?php _e('Адреса:', 'lawgic'); ?>
          <a href="<?php echo $posylannya_na_kartu; ?>"  rel="nofollow" target="_blank"><?php echo $adressa; ?></a>
          <img data-text="<?php _e('Посилання скопійовано', 'lawgic') ?>" class="copy-link" src="<?php echo get_template_directory_uri(); ?>/assets/img/copy.svg" width="10" height="10" alt="Скопіювати посилання">
        </div>
      </div>
    </div>
  </div>
</div>
<!--  -->
<div class="pop-up" id="pop-up-calc" style="display: none">
  <div class="pop-up__row">
    <div class="pop-up__cover">
     <img src="<?php echo get_template_directory_uri(); ?>/assets/img/popap2.webp" alt="">
    </div>
    <div class="pop-up__box bd">
      <div class="pop-up__bar bdb">
        <div class="feedback__s-links">
          <ul>
            <?php if (get_field('linkedin', 'option')) : ?>
              <li>
                <a href=" <?php echo get_field('linkedin', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/in.svg"  width="20" height="20" alt="linkedin">
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_field('faceboock', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('faceboock', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fb.svg"  width="20" height="19" alt="faceboock">
                </a>
              </li>
            <?php endif; ?>
            <?php if (get_field('x', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('x', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/x.svg"  width="18" height="17" alt="x">
                </a>
              </li>
            <?php endif; ?>
            <?php if (get_field('instagram', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('instagram', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/insta.svg"  width="21" height="19" alt="instagram">
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="pop-up__close">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/close.svg" alt="Закрити">
        </div>

      </div>
      <div class="pop-up__body">
        <?php if (get_field('popup_zagolovok', 'option')) : ?>
          <div class="pop-up__title"><?php echo get_field('popup_zagolovok', 'option'); ?></div>
        <?php endif; ?>

        <?php if (get_field('popup_pidzagolovok', 'option')) : ?>
          <div class="pop-up__subtitle"><?php echo get_field('popup_pidzagolovok', 'option'); ?></div>
        <?php endif; ?>

        <div class="pop-up__form">
          <?php echo do_shortcode('[contact-form-7 id="0651bde" title="Заявка на допомогу"]'); ?>
        </div>
        <div class="pop-up__items">
          <ul>
            <?php if (get_field('popup_tekst_1', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-1-1.svg" alt=""></span><?php the_field('popup_tekst_1', 'option'); ?></li>
            <?php endif; ?>
            <?php if (get_field('popup_tekst_2', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-3-1.svg" alt=""></span> <?php the_field('popup_tekst_2', 'option'); ?></li>
            <?php endif; ?>
            <?php if (get_field('popup_tekst_3', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-2-1.svg" alt=""></span><?php the_field('popup_tekst_3', 'option'); ?></li>
            <?php endif; ?>
            <?php if (get_field('popup_tekst_4', 'option')): ?>
              <li><span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-order-4-1.svg" alt=""></span><?php the_field('popup_tekst_4', 'option'); ?></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <div class="pop-up__footer bdt">
        <div class="location">
          <?php _e('Адреса:', 'lawgic'); ?>
          <a href="<?php echo $posylannya_na_kartu; ?>"  rel="nofollow" target="_blank"><?php echo $adressa; ?></a>
          <img data-text="<?php _e('Посилання скопійовано', 'lawgic') ?>" class="copy-link" src="<?php echo get_template_directory_uri(); ?>/assets/img/copy.svg" width="10" height="10" alt="Скопіювати посилання">
        </div>
      </div>
    </div>
  </div>
</div>
<!--  -->
<div class="pop-up" id="pop-up-thank" style="display: none">
  <div class="pop-up__row">
    <div class="pop-up__cover">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pop-up-cover.webp" alt="">
    </div>
    <div class="pop-up__box bd">
      <div class="pop-up__bar bdb">
        <div class="feedback__s-links">
          <ul>
            <?php if (get_field('linkedin', 'option')) : ?>
              <li>
                <a href=" <?php echo get_field('linkedin', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/in.svg"  width="20" height="20" alt="linkedin">
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_field('faceboock', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('faceboock', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/fb.svg"  width="20" height="19" alt="faceboock">
                </a>
              </li>
            <?php endif; ?>
            <?php if (get_field('x', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('x', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/x.svg"  width="18" height="17" alt="x">
                </a>
              </li>
            <?php endif; ?>
            <?php if (get_field('instagram', 'option')) : ?>
              <li>
                <a href="<?php echo get_field('instagram', 'option'); ?>" target="_blank" rel="nofollow noopener">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/insta.svg"  width="21" height="19" alt="instagram">
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="pop-up__close">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/close.svg" alt="">
        </div>

      </div>
      <div class="pop-up__body">
        <?php if (get_field('popup_zagolovok_podyaky', 'option')) : ?>
          <div class="pop-up__title"><?php echo get_field('popup_zagolovok_podyaky', 'option'); ?></div>
        <?php endif; ?>
        <?php if (get_field('popup_pidzagolovok_podyaky', 'option')) : ?>
          <div class="pop-up__subtitle"><?php echo get_field('popup_pidzagolovok_podyaky', 'option'); ?></div>
        <?php endif; ?>

      </div>

      <div class="pop-up__footer bdt">
        <div class="location">
          <?php _e('Адреса:', 'lawgic'); ?>
          <a href="<?php echo $posylannya_na_kartu; ?>"  rel="nofollow" target="_blank"><?php echo $adressa; ?></a>
          <img data-text="<?php _e('Посилання скопійовано', 'lawgic') ?>" class="copy-link" src="<?php echo get_template_directory_uri(); ?>/assets/img/copy.svg" width="10" height="10" alt="Скопіювати посилання">
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$current_language = apply_filters('wpml_current_language', NULL);
?>
<?php if ($current_language == 'uk'): ?>
<?php elseif ($current_language == 'ru'): ?>
<?php endif; ?>


<?php wp_footer(); ?>
<script>
  if (typeof swiper !== 'undefined' && swiper !== null) {
    swiper.update(); 
  }
</script>

<?php $advokat = get_field('prykripyty_advokata'); ?>
<?php //if (isset($advokat)): ?>


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "@id": "<?php echo esc_url(home_url('/')); ?>#organization",
  "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
  "url": "<?php echo esc_url(home_url('/')); ?>",
  "sameAs": [
    <?php
      $links = [];
      if (get_field('linkedin', 'option')) $links[] = '"' . esc_url(get_field('linkedin', 'option')) . '"';
      if (get_field('x', 'option')) $links[] = '"' . esc_url(get_field('x', 'option')) . '"';
      if (get_field('instagram', 'option')) $links[] = '"' . esc_url(get_field('instagram', 'option')) . '"';
      if (get_field('faceboock', 'option')) $links[] = '"' . esc_url(get_field('faceboock', 'option')) . '"';
      if (get_field('youtube', 'option')) $links[] = '"' . esc_url(get_field('youtube', 'option')) . '"';
      echo implode(",", $links);
    ?>
  ]
}
</script>


<?php //endif ?>


</body>

</html>