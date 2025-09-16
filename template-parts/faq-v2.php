<?php

/**
 * Template part for faq2 section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lavgic
 */

?>
<section class="faq2" id="faq">
  <div class="container">
    <div class="bdl bdr">
      <?php if (get_field('pytannya_zagolovok')) : ?>
        <div class="h2-title">
          <h2><?php echo get_field('pytannya_zagolovok'); ?></h2>
        </div>
      <?php endif; ?>
      <?php $faq2 = get_field('pytannya'); ?>
      <?php if (isset($faq2)) : ?>
        <div class="faq2__row">
          <?php foreach ($faq2 as $key => $item) : ?>
            <div class="faq2__item <?php echo $key == 0 ? 'active' : ''; ?> bdb">
              <div class="faq2__question ">
                <h3><?php echo $item['pytannya']; ?></h3>
              </div>
              <div class="faq2__answer">
                <p><?php echo $item['vidpovid']; ?></p>
              </div>
            </div>
          <?php endforeach ?>
        </div>
        <?php if (get_field('dodatkovyj_tekst_dlya_poslug')) : ?>
          <div class="faq2__subtext">
            <?php echo get_field('dodatkovyj_tekst_dlya_poslug'); ?>
          </div>
        <?php endif; ?>

      <?php endif; ?>

      <?php if (isset($faq2)) : ?>
        <script type="application/ld+json">
          {
            "@context": "https://schema.org",
            "@type": "faq2Page",
            "mainEntity": [
              <?php foreach ($faq2 as $index => $item): ?> {
                  "@type": "Question",
                  "name": "<?php echo esc_js($item['zapytannya']); ?>",
                  "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "<?php echo esc_js(wp_strip_all_tags($item['vidpovid'])); ?>"
                  }
                }
                <?php echo $index + 1 < count($faq2) ? ',' : ''; ?>
              <?php endforeach; ?>
            ]
          }
        </script>
      <?php endif; ?>
    </div>
  </div>
</section>