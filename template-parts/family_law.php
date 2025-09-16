  <section class="family-law" id="family-law">
    <div class="container">
      <div class="bdl bdr">
        <div class="h2-title">
          <?php if (get_field('family_law_zagolovok')) : ?>
            <h2><?php echo get_field('family_law_zagolovok'); ?></h2>
          <?php endif; ?>
        </div>
      </div>
      <div class="bdl bdr">
        <div class="family-law__grid">
          <?php $family_law = get_field('family_law'); ?>
          <?php foreach ($family_law as $item) : ?>
            <a href="" class="family-law__item" data-fancybox>
              <span>
                <?php
                $image_id = $item['zobrazhennya'];
                get_picture($image_id, 'familylaw', esc_html(get_the_title()))
                ?>
              </span>
              <?php echo $item['nazva']; ?>
            </a>
          <?php endforeach ?>
        </div>
        <div class="family-law__btn">
          <a href="" class="btn btn__gold" data-fancybox><span><?php _e('Написати нам', 'lawgic'); ?></span></a>
        </div>
      </div>
    </div>
  </section>