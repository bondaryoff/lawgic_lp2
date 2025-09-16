<section class="family-law" id="family-law">
  <div class="container">
    <div class="bdl bdr">
      <div class="h2-title">
        <?php if (get_field('trouble_zagolovok')) : ?>
          <h2><?php echo get_field('trouble_zagolovok'); ?></h2>
        <?php endif; ?>
      </div>


      <?php $trouble = get_field('trouble'); ?>
      <div class="trouble__bar bdb">
        <div class="trouble__count">
          <?php
          $sytuacziyi = $trouble[0]['sytuacziyi'];
          if ($sytuacziyi == 1) {
            echo 'Знайдено ' . count($sytuacziyi) . ' ситуація';
          } else if ($sytuacziyi > 1 && $sytuacziyi < 5) {
            echo  'Знайдено ' . count($sytuacziyi) . ' ситуації';
          } else {
            echo  'Знайдено ' . count($sytuacziyi) . ' ситуацій';
          }
          ?>
        </div>
        <div class="trouble__dropdown trouble-dropdown">
          <div class="trouble-dropdown__active">
            <span>
              <?php
              $image_id =  $trouble[0]['ikonka'];
              get_picture($image_id['ID'], 'troubleikonka', esc_html(get_the_title()))
              ?>
            </span>
            <?php echo $trouble[0]['pravo']; ?>
          </div>
          <ul>

            <?php foreach ($trouble as $key => $item) : ?>
              <?php $sytuacziyi = $item['sytuacziyi']; ?>
              <li><a href="tab<?php echo $key; ?>" data-count="<?php echo count($sytuacziyi); ?>">

                  <span>
                    <?php
                    $image_id =  $item['ikonka'];
                    get_picture($image_id['ID'], 'troubleikonka', esc_html(get_the_title()))
                    ?>
                  </span>
                  <?php echo $item['pravo']; ?>
                </a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="trouble__body bdt bdb">
        <div class="trouble__left">
          <?php foreach ($trouble as $key => $item) : ?>
            <div class="trouble__tab <?php if ($key == 0) echo ' active'; ?>" id="tab<?php echo $key; ?>">
              <div class="trouble__item active">
                <div class="trouble__img trouble__img--first">
                  <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-lg.svg" alt=""> -->
                </div>
                <?php _e('Немає мого варіату , потребую допомоги', 'lawgic'); ?>
                <div class="trouble__check">
                  <span></span>
                </div>
              </div>
              <?php $sytuacziyi = $item['sytuacziyi']; ?>
              <?php foreach ($sytuacziyi as $key => $st) : ?>
                <div class="trouble__item">
                  <div class="trouble__img">
                    <?php
                    $image_id =  $st['zobrazhennya'];
                    get_picture($image_id['ID'], 'trouble', esc_html(get_the_title()))
                    ?>
                  </div>
                  <?php echo $st['sytuacziya']; ?>
                  <div class="trouble__check">
                    <span></span>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="trouble__right">
          <div class="trouble__wrapp">

            <?php
            $image_id = get_field('trouble_zobrazhennya');
            get_picture($image_id, 'troublebox', '')
            ?>
            <div class="trouble__box">
              <b>Термінова ситуація?</b>
              <span>Зателефонуйте нам негайно — ми реагуємо миттєво</span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/trouble__action.svg" alt="">
            </div>
          </div>
          <div class="trouble__btn">
            <a href="" class="btn btn__gold" data-fancybox>
              <span><?php _e('Швидкий виклик юриста', 'lawgic'); ?></span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone+.svg" class="phone" alt="">
            </a>
          </div>


        </div>
      </div>
    </div>
  </div>
</section>