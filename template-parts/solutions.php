  <section class="solutions" id="solutions">
    <div class="container">
      <div class="bdl bdr">
        <div class="h2-title">
          <?php if (get_field('solutions_zagolovok')) : ?>
            <h2><?php echo get_field('solutions_zagolovok'); ?></h2>
          <?php endif; ?>
        </div>
      </div>


      <div class="solutions__grid">
        <?php $solutions = get_field('solutions'); ?>
        <?php foreach ($solutions as $item) : ?>
          <div class="solutions__item">
            <div class="solutions__img">
              <?php
              $image_id = $item['zobrazhennya'];
              get_picture($image_id, 'solutions', esc_html(get_the_title()))
              ?>
            </div>
            <div class="solutions__title">
              <h3><?php echo $item['nazva'] ?></h3>
            </div>
            <div class="solutions__more">
              <a href="#pop-up" data-source="<?php echo htmlspecialchars(strip_tags($item['nazva'])); ?>"  class="more" data-fancybox>У мене схожа ситуація</a>
              <a href="#pop-up" data-source="<?php echo htmlspecialchars(strip_tags($item['nazva'])); ?>"  data-fancybox class="more2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone-green.svg" alt="" class="svg"></a>

            </div>
          </div>
        <?php endforeach; ?>
        <div class="solutions__item solutions__item--last">
          <?php if (get_field('solutions_text_1')) : ?>
            <div class="solutions__text1">
              <?php echo get_field('solutions_text_1'); ?>
            </div>
          <?php endif; ?>
          <?php if (get_field('solutions_text_2')) : ?>
            <div class="solutions__text2">
              <?php echo get_field('solutions_text_2'); ?>
            </div>
          <?php endif; ?>
          <?php if (get_field('solutions_btn')) : ?>
            <a href="#pop-up" data-fancybox class="btn btn__gold">
              <span><?php echo get_field('solutions_btn'); ?></span>
            </a>
          <?php endif; ?>



        </div>

      </div>
    </div>
  </section>