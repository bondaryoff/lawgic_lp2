  <?php

  /**
   * Template part for feedback section
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package lawgic
   */

  ?>


  <section class="steps" id="steps">
    <div class="container">
      <div class="bdl bdr">
        <div class="h2-title">
          <?php if (get_field('etapy_zagolovok')) : ?>
            <h2><?php echo get_field('etapy_zagolovok'); ?></h2>
          <?php endif; ?>
        </div>
      </div>
      <div class="bdl bdr">
        <?php $family_law = get_field('etapy'); ?>
        <?php foreach ($family_law as $key => $item) : ?>
          <div class="steps__item">
            <div class="steps__number">
              <?php echo $key + 1 ?>
            </div>
            <div class="steps__img steps__img--pc">
              <?php echo wp_get_attachment_image($item['zobrazhennya'], 'full'); ?>
            </div>
            <div class="steps__box">
              <div class="steps__img steps__img--mob">
                <?php echo wp_get_attachment_image($item['zobrazhennya'], 'full'); ?>
              </div>
              <div class="steps__title">
                <?php echo $item['nazva_etapu']; ?>
              </div>
              <div class="steps__text">
                <?php echo $item['tekst']; ?>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>