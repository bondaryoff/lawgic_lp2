<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package lawgic
 */

get_header();

$page_template = get_pages([
  'meta_key'   => '_wp_page_template', // мета-ключ шаблону
  'meta_value' => 'templates/blog.php'  // назва шаблону
]);
$post_id = get_the_ID();
$case_link = get_permalink($page_template[0]->ID);
?>

<?php get_template_part('template-parts/reusable/header'); ?>
<div class="breadcrumbs">
  <div class="container">
    <div class="breadcrumbs__row bdl bdr">
      <span property="itemListElement" typeof="ListItem">
        <a property="item" typeof="WebPage" title="<?php _e('Перейти до головна', 'lawgic'); ?>" href="<?php echo home_url(); ?>" class="home">
          <span property="name"><?php _e('Головна', 'lawgic'); ?></span>
        </a>
        <meta property="position" content="1">
      </span>&gt;
      <?php
      $current_language = apply_filters('wpml_current_language', null);
      if ($current_language == 'uk') :
        $slug = '/blog/';
      elseif ($current_language == 'ru') :
        $slug = 'blog/';
      endif;
      ?>
      <span property="itemListElement" typeof="ListItem">
        <a property="item" typeof="WebPage" title="<?php _e('Перейти до Блогу', 'lawgic'); ?>" href="<?php echo home_url(); ?><?php echo $slug; ?>" class="blog">
          <span property="name"><?php _e('Блог', 'lawgic'); ?></span>
        </a>
        <meta property="position" content="2">
      </span>&gt;
      <span property="itemListElement" typeof="ListItem">
        <span property="name" class="post post-page current-item"><?php the_title(); ?></span>
        <meta property="url" content="<?php the_permalink(); ?>">
        <meta property="position" content="3">
      </span>
    </div>
  </div>
</div>
<?php //get_template_part('template-parts/reusable/breadcrumbs'); 
?>
<?php
$oblozhka = get_field('oblozhka');
$vysnovok = get_field('vysnovok');
?>

<div class="single-post">
  <div class="container">
    <div class="bdl bdr bdt">
      <main class="main">
        <div class="single-post__title">
          <h1><?php the_title(); ?></h1>
        </div>
        <div class="row bdt">
          <aside class="sidebar pc bdr">
            <div class="article-author">

              <?php get_sidebar() ?>
              <div class="article__content">
                <div class="article__content__title">
                  <?php _e('Зміст', 'lawgic'); ?>
                </div>
                <div class="article__content__content">

                </div>
              </div>
            </div>

          </aside>
          <div class="article">
            <?php if ($oblozhka) : ?>
              <div class="single-post__cover">
                <?php
                $image_id = $oblozhka['ID'];
                get_picture($image_id, 'cover', get_the_title())
                ?>
              </div>
            <?php endif; ?>
            <div class="single-post__info">
              <div class="single-post__read-time"><?php _e('Час на прочитаня:', 'lawgic'); ?> <span style="margin: 0 5px"> 4 </span><?php _e('хв', 'lawgic'); ?></div>
              <div class="single-post__date"><b><?php _e('Дата:', 'lawgic'); ?> </b><?php echo get_the_date(); ?></div>
            </div>
            <div class="single-post__exerpt">
              <?php the_excerpt(); ?>
            </div>
            <a href="#pop-up" class="btn btn__gold" data-fancybox>
              <span><?php _e('Замовити послугу', 'lawgic'); ?></span>
            </a>
            <div class="single-post__content">
              <div class="content">
                <?php the_content(); ?>
              </div>
            </div>
            <aside class="sidebar mobile bdr">
              <div class="article-author">

                <?php $advokat = get_field('prykripyty_advokata'); ?>
                <?php if (isset($advokat)): ?>
                  <?php $person_id = $advokat->ID; ?>
                  <?php $posada = get_field('posada', $person_id);  ?>
                  <?php $opys = get_field('opys', $person_id); ?>
                  <?php $servisy = get_field('servisy', $person_id); ?>

                  <div class="person">
                    <div class="person__author">
                      <?php _e('Автор', 'lawgic'); ?>
                    </div>


                    <div class="person__photo">

                      <?php if (has_post_thumbnail($advokat->ID)) : ?>
                        <?php
                        $image_id = get_post_thumbnail_id($advokat->ID);
                        get_picture($image_id, 'author', $advokat->post_title . ' - ' . $posada)
                        ?>
                      <?php endif; ?>

                    </div>
                    <div class="person__name">
                      <?php echo $advokat->post_title;
                      ?>
                    </div>
                    <?php if (isset($posada)): ?>
                      <div class="person__posada">
                        <?php echo $posada; ?>
                      </div>
                    <?php endif ?>
                    <?php if (isset($opys)): ?>
                      <div class="person__description">
                        <?php echo $opys; ?>
                      </div>
                    <?php endif ?>
                    <div class="person__social-links"></div>

                    <div class="person__btn">
                      <a href="#pop-up" class="btn btn__gold" data-fancybox>
                        <span><?php _e('Зв’язатись зараз', 'lawgic'); ?></span>
                      </a>
                    </div>
                    <?php get_template_part('template-parts/reusable/stat'); ?>
                  </div>
                <?php endif ?>
                <div class="article__content">
                  <div class="article__content__title">
                    <?php _e('Зміст', 'lawgic'); ?>
                  </div>
                  <div class="article__content__content">

                  </div>
                </div>
              </div>

            </aside>
            <?php if ($vysnovok) : ?>
              <div class="single-post__conclusion">
                <div class="content">
                  <?php echo $vysnovok; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </main>
    </div>
  </div>
</div>
<div class="single-post__order">
  <?php get_template_part('template-parts/reusable/order'); ?>
</div>
<div class="container">
  <div class="pre-footer-divider"></div>
</div>

<script>
  // Отримуємо елемент статті
  const article = document.querySelector('.single-post .article');

  if (article) {
    // Підраховуємо кількість символів у тексті статті
    const text = article.innerText || article.textContent;
    const charCount = text.length;

    // Розраховуємо час на читання (1000 символів ≈ 1 хв)
    const minutes = Math.max(1, Math.ceil(charCount / 1000));

    // Знаходимо елемент для виводу часу
    const output = document.querySelector('.single-post__read-time span');
    if (output) {
      // Виводимо результат
      output.textContent = minutes;

    }
  }



  const headers = document.querySelectorAll('.single-post__content .content h2');
  const tocContainer = document.querySelector('.article__content__content');
  const tocList = document.createElement('ul');

  const tocLinks = []; // Масив для збереження посилань

  headers.forEach((header, index) => {
    const id = `header-id-${index + 1}`;
    header.id = id;

    const li = document.createElement('li');
    const a = document.createElement('a');
    a.href = `#${id}`;
    a.textContent = header.textContent;

    // Обробка кліку — додає клас active
    a.addEventListener('click', (e) => {
      tocLinks.forEach(link => link.classList.remove('active'));
      a.classList.add('active');
    });

    tocLinks.push(a);
    li.appendChild(a);
    tocList.appendChild(li);
  });

  if (tocContainer) tocContainer.appendChild(tocList);

  // Відстеження скролу — оновлення активного пункту
  window.addEventListener('scroll', () => {
    let currentId = null;

    headers.forEach((header) => {
      const rect = header.getBoundingClientRect();
      if (rect.top <= 50) currentId = header.id;
    });

    tocLinks.forEach(link => {
      link.classList.toggle('active', link.getAttribute('href') === `#${currentId}`);
    });
  });
</script>
<?php
get_footer();
