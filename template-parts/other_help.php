  <section class="other-help" id="other-help">
    <div class="container">
      <div class="bdl bdr">
        <div class="h2-title">
          <?php if ( get_field('other_help_zagolovok') ) : ?>
            <h2><?php echo get_field('other_help_zagolovok'); ?></h2>
          <?php endif; ?>
        </div>
      </div>
      <div class="bdl bdr">
        <?php $other_help = get_field('other_help');
        $left_col = [];
        $right_col = [];

        if ($other_help) {
          foreach ($other_help as $i => $item) {
            $index = $i + 1; // рахуємо з 1
            if ($index % 2 === 1) {
              $left_col[] = $item; // непарні
            } else {
              $right_col[] = $item; // парні
            }
          }
        }
        ?>

        <div class="other-help__grid">
          <div class="other-help__left">
            <?php foreach ($left_col as $item) : ?>
              <div href="" class="other-help__item">
                <div class="other-help__title">
                  <!-- <span><?php echo wp_get_attachment_image($item['zobrazhennya'], 'full'); ?></span> -->
                  <span>
                    <?php
                    $image_id = $item['zobrazhennya'];
                    get_picture($image_id, 'familylaw', esc_html(get_the_title()))
                    ?>
                  </span>
                  <?php echo $item['nazva']; ?>
                </div>
                <?php $pidpunkty = $item['pidpunkty']; ?>
                <?php if ($pidpunkty) : ?>
                  <div class="other-help__dropdown">
                    <ul>
                      <?php foreach ($pidpunkty as $item) : ?>
                        <li>
                          <a href="" data-fancybox><?php echo $item['nazva']; ?></a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
                <div class="other-help__foter">
                  <div class="other-help__text">
                    <b><?php _e('Залиште заявку', 'lawgic'); ?></b><?php _e('Наш менеджер зв’яжеться з Вами ', 'lawgic'); ?>
                  </div>
                  <div class="other-help__btn">
                    <a href="" class="btn btn__gold" data-fancybox><span><?php _e('Отримати індивідуальний план дій', 'lawgic'); ?></span></a>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
          <div class="other-help__right">
            <?php foreach ($right_col as $item) : ?>
              <div href="" class="other-help__item">
                <div class="other-help__title">
                  <span><?php echo wp_get_attachment_image($item['zobrazhennya'], 'full'); ?></span>
                  <?php echo $item['nazva']; ?>
                </div>
                <?php $pidpunkty = $item['pidpunkty']; ?>
                <?php if ($pidpunkty) : ?>
                  <div class="other-help__dropdown">
                    <ul>
                      <?php foreach ($pidpunkty as $item) : ?>
                        <li>
                          <a href="" data-fancybox><?php echo $item['nazva']; ?></a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
                <div class="other-help__foter">
                  <div class="other-help__text">
                    <b><?php _e('Залиште заявку', 'lawgic'); ?></b><?php _e('Наш менеджер зв’яжеться з Вами ', 'lawgic'); ?>
                  </div>
                  <div class="other-help__btn">
                    <a href="" class="btn btn__gold" data-fancybox><span><?php _e('Отримати індивідуальний план дій', 'lawgic'); ?></span></a>
                  </div>
                </div>
              </div>
            <?php endforeach ?>

          </div>
        </div>
      </div>
    </div>
  </section>