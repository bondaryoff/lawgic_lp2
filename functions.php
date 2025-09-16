<?php

/**
 * lawgic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lawgic
 */

if (! defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lawgic_setup()
{
  /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on lawgic, use a find and replace
		* to change 'lawgic' to the name of your theme in all the template files.
		*/
  load_theme_textdomain('lawgic', get_template_directory() . '/languages');

  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
  add_theme_support('title-tag');

  /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
  add_theme_support('post-thumbnails');




  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(
    array(
      'main_menu' => esc_html__('Primary', 'lawgic'),
      'lang_menu' => esc_html__('Language switcher', 'lawgic'),
      'footer_menu' => esc_html__('Footer service', 'lawgic'),
      'footer_menu2' => esc_html__('Footer menu', 'lawgic'),
    )
  );
  // register_nav_menus([
  //   'main_menu' => 'Головне меню',
  // ]);



  /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  // Set up the WordPress core custom background feature.
  add_theme_support(
    'custom-background',
    apply_filters(
      'lawgic_custom_background_args',
      array(
        'default-color' => 'ffffff',
        'default-image' => '',
      )
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Add support for core custom logo.
   *
   * @link https://codex.wordpress.org/Theme_Logo
   */
  add_theme_support(
    'custom-logo',
    array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    )
  );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lawgic_content_width()
{
  $GLOBALS['content_width'] = apply_filters('lawgic_content_width', 640);
}
add_action('after_setup_theme', 'lawgic_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lawgic_widgets_init()
{
  register_sidebar(
    array(
      'name'          => esc_html__('Sidebar', 'lawgic'),
      'id'            => 'sidebar-1',
      'description'   => esc_html__('Add widgets here.', 'lawgic'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'lawgic_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function lawgic_scripts()
{
  wp_enqueue_style('lawgic-style', get_stylesheet_uri(), array(), _S_VERSION);
  wp_style_add_data('lawgic-style', 'rtl', 'replace');
  wp_enqueue_style('lawgic-stylesheet', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION);
  // wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), _S_VERSION);
  // wp_enqueue_style('fancyapps', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), _S_VERSION);

  // wp_enqueue_script('lawgic-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
  // wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), _S_VERSION, true);
  // wp_enqueue_script('fancyapps', get_template_directory_uri() . '/assets/js/fancybox.umd.js', array(), _S_VERSION, true);
  wp_enqueue_script('jquery');
  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), _S_VERSION, true);
  wp_enqueue_script('fancyapps', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), _S_VERSION, true);
  wp_enqueue_script('inputmask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js', ['jquery'], null, true);
  wp_enqueue_script('lawgic-scripts', get_template_directory_uri() . '/assets/js/app.min.js', array(), _S_VERSION, true);
  // Підключення бібліотеки Inputmask


  // if (is_singular() && comments_open() && get_option('thread_comments')) {
  //   wp_enqueue_script('comment-reply');
  // }

}
add_action('wp_enqueue_scripts', 'lawgic_scripts');

// Вимикаємо Gutenberg block-library, якщо не потрібно
add_action('wp_enqueue_scripts', function () {
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
}, 100);


// Підключення Google Fonts з preconnect і відкладеним завантаженням
add_action('wp_head', function() {
    ?>
    <!-- Попереднє з'єднання -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Відкладене завантаження шрифтів -->
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" 
          rel="stylesheet" 
          media="print" 
          onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </noscript>
    <?php
}); 


add_action('wp_footer', function () {
  ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print" onload="this.media='all'">
  <noscript>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  </noscript>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" media="print" onload="this.media='all'">
  <noscript>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
  </noscript>
  <!-- <script src="'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js" ></script> -->
<?php
});


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}


require get_template_directory() . '/inc/telegram.php';
require get_template_directory() . '/inc/comment.php';






add_filter('bcn_display', 'replace_breadcrumb_separator_with_svg', 10, 3);

// Замінюємо стандартний текстовий роздільник на SVG
function replace_breadcrumb_separator_with_svg($output, $breadcrumb_type, $return)
{
  // SVG-код
  $svg = '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.203508 9.80823C0.139003 9.74766 0.0878223 9.67568 0.0528999 9.59643C0.0179775 9.51718 6.4542e-08 9.43221 6.82929e-08 9.3464C7.20439e-08 9.26059 0.0179775 9.17562 0.0528999 9.09637C0.0878223 9.01712 0.139003 8.94514 0.203508 8.88457L4.3256 5.00031L0.203508 1.11496C0.0735239 0.992472 0.000499686 0.826346 0.000499697 0.653126C0.000499707 0.479906 0.0735239 0.313781 0.203508 0.191296C0.333493 0.0688112 0.509789 -2.37404e-07 0.693615 -2.31949e-07C0.877441 -2.26495e-07 1.05374 0.0688112 1.18372 0.191296L5.79649 4.53793C5.861 4.59851 5.91218 4.67048 5.9471 4.74973C5.98202 4.82899 6 4.91395 6 4.99976C6 5.08558 5.98202 5.17054 5.9471 5.2498C5.91218 5.32905 5.861 5.40102 5.79649 5.4616L1.18372 9.80823C1.11944 9.86902 1.04306 9.91724 0.958954 9.95015C0.87485 9.98306 0.78468 10 0.693615 10C0.602549 10 0.512379 9.98306 0.428275 9.95015C0.344172 9.91724 0.267789 9.86902 0.203508 9.80823Z" fill="#686868"/></svg>';

  // Замінюємо звичайний роздільник
  $output = str_replace('&gt;', $svg, $output); // якщо використовується `>` як роздільник
  $output = str_replace('»', $svg, $output);    // або якщо використовується `»`

  return $output;
}



add_action('acf/init', function () {
  if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
      'page_title'    => 'Налаштування теми',
      'menu_title'    => 'Налаштування теми',
      'menu_slug'     => 'theme-general-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false
    ));

    acf_add_options_sub_page(array(
      'page_title'    => 'Соціальні мережі',
      'menu_title'    => 'Соціальні мережі',
      'parent_slug'   => 'theme-general-settings',
      'menu_slug'     => 's-networks-settings',
    ));

    acf_add_options_sub_page(array(
      'page_title'    => 'Поп-ап',
      'menu_title'    => 'Поп-ап',
      'parent_slug'   => 'theme-general-settings',
      'menu_slug'     => 'pop-up-settings',
    ));

    acf_add_options_sub_page(array(
      'page_title'    => 'Конверсійний блок',
      'menu_title'    => 'Конверсійний блок',
      'parent_slug'   => 'theme-general-settings',
      'menu_slug'     => 'convercion-settings',
    ));

    acf_add_options_sub_page(array(
      'page_title'    => 'Блок знижка',
      'menu_title'    => 'Блок знижка',
      'parent_slug'   => 'theme-general-settings',
      'menu_slug'     => 'sale-settings',
    ));

    acf_add_options_sub_page(array(
      'page_title'    => 'Статистика консультантів',
      'menu_title'    => 'Статистика консультантів',
      'parent_slug'   => 'theme-general-settings',
      'menu_slug'     => 'stat-settings',
    ));
    acf_add_options_sub_page(array(
      'page_title'    => 'Мікро розмітка',
      'menu_title'    => 'Мікро розмітка',
      'parent_slug'   => 'theme-general-settings',
      'menu_slug'     => 'shema-settings',
    ));
  }
});



add_filter('bcn_breadcrumb_separator', 'my_custom_navxt_separator');
function my_custom_navxt_separator($separator)
{
  return '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.203508 9.80823C0.139003 9.74766 0.0878223 9.67568 0.0528999 9.59643C0.0179775 9.51718 6.4542e-08 9.43221 6.82929e-08 9.3464C7.20439e-08 9.26059 0.0179775 9.17562 0.0528999 9.09637C0.0878223 9.01712 0.139003 8.94514 0.203508 8.88457L4.3256 5.00031L0.203508 1.11496C0.0735239 0.992472 0.000499686 0.826346 0.000499697 0.653126C0.000499707 0.479906 0.0735239 0.313781 0.203508 0.191296C0.333493 0.0688112 0.509789 -2.37404e-07 0.693615 -2.31949e-07C0.877441 -2.26495e-07 1.05374 0.0688112 1.18372 0.191296L5.79649 4.53793C5.861 4.59851 5.91218 4.67048 5.9471 4.74973C5.98202 4.82899 6 4.91395 6 4.99976C6 5.08558 5.98202 5.17054 5.9471 5.2498C5.91218 5.32905 5.861 5.40102 5.79649 5.4616L1.18372 9.80823C1.11944 9.86902 1.04306 9.91724 0.958954 9.95015C0.87485 9.98306 0.78468 10 0.693615 10C0.602549 10 0.512379 9.98306 0.428275 9.95015C0.344172 9.91724 0.267789 9.86902 0.203508 9.80823Z" fill="#686868"/></svg>';
}




add_filter('wpcf7_autop_or_not', '__return_false');


function get_localized_field($base_field_name, $option = null)
{
  $lang = apply_filters('wpml_current_language', null);
  $field_name = ($lang == 'uk') ? $base_field_name : $base_field_name . '_' . $lang;
  return get_field($field_name, $option);
}


// 
// 
// 
// 
// 
// 


// Додаємо колонку "Послуга" у список кейсів
function add_service_column_to_case_admin($columns)
{
  $columns['related_service'] = 'Послуга';
  return $columns;
}
add_filter('manage_edit-case_columns', 'add_service_column_to_case_admin');

// Виводимо значення послуги
function show_service_column_in_case_admin($column, $post_id)
{
  if ($column === 'related_service') {
    $service_id = get_field('service', $post_id); // повертає ID

    if ($service_id) {
      echo '<a href="' . get_edit_post_link($service_id) . '">' . esc_html(get_the_title($service_id)) . '</a>';
    } else {
      echo '—';
    }
  }
}
add_action('manage_case_posts_custom_column', 'show_service_column_in_case_admin', 10, 2);





// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 








function mobilization_help_button_shortcode($atts)
{
  $atts = shortcode_atts([
    'text' => '',
    'url'  => '#pop-up'
  ], $atts, 'short_button');

  ob_start(); ?>
  <div style="text-align: center; margin: 20px 0;">
    <a href="<?php echo esc_url($atts['url']); ?>" class="short_button" data-fancybox>
      <?php echo esc_html($atts['text']); ?>
    </a>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode('short_button', 'mobilization_help_button_shortcode');
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 

add_action('after_setup_theme', 'lawgic_setup');


add_action('after_setup_theme', function () {

  // home-person
  // add_image_size('home-person-img-pc-1x', 474, 482, true);
  // add_image_size('home-person-img-pc-2x', 948, 964, true);

  // add_image_size('home-person-img-mobile-1x', 410, 482, true);
  // add_image_size('home-person-img-mobile-2x', 820, 964, true);


  // advocat-slider
  add_image_size('advocat-slider-mobile-1x', 349, 461, true);
  add_image_size('advocat-slider-mobile-2x', 698, 922, true);

  add_image_size('advocat-slider-pc-1x', 353, 468, true);
  add_image_size('advocat-slider-pc-2x', 703, 936, true);


  // advocat
  add_image_size('advocat-pc-1x', 263, 388, true);
  add_image_size('advocat-pc-2x', 526, 776, true);

  add_image_size('advocat-mobile-1x', 349, 463, true);
  add_image_size('advocat-mobile-2x', 698, 926, true);



  // cases
  // add_image_size('cases-pc-1x', 258, 202, true);
  // add_image_size('cases-pc-2x', 516, 404, true);

  // add_image_size('cases-mobile-1x', 429, 202, true);
  // add_image_size('cases-mobile-2x', 858, 404, true);


  // author
  // add_image_size('author-pc-1x', 168, 168, true);
  // add_image_size('author-pc-2x', 336, 336, true);

  // add_image_size('author-mobile-1x', 168, 168, true);
  // add_image_size('author-mobile-2x', 336, 336, true);

  // service
  // add_image_size('service-pc-1x', 62, 59, true);
  // add_image_size('service-pc-2x', 124, 118, true);

  // add_image_size('service-mobile-1x', 62, 59, true);
  // add_image_size('service-mobile-2x', 124, 118, true);


  // Posts 
  // add_image_size('post-pc-1x', 297, 265, true);
  // add_image_size('post-pc-2x', 594, 530, true);

  // add_image_size('post-mobile-1x', 421, 303, true);
  // add_image_size('post-mobile-2x', 842, 606, true);

  // sertificates 
  // add_image_size('sertificates-pc-1x', 523, 378, true);
  // add_image_size('sertificates-pc-2x', 1046, 756, true);

  // add_image_size('sertificates-mobile-1x', 357, 267, true);
  // add_image_size('sertificates-mobile-2x', 714, 534, true);

  // cover 
  // add_image_size('cover-pc-1x', 1001, 572, true);
  // add_image_size('cover-pc-2x', 2002, 1144, true);

  // add_image_size('cover-mobile-1x', 441, 252, true);
  // add_image_size('cover-mobile-2x', 882, 504, true);

  // example 
  add_image_size('example-pc-1x', 105, 102, true);
  add_image_size('example-pc-2x', 210, 204, true);

  add_image_size('example-mobile-1x', 67, 65, true);
  add_image_size('example-mobile-2x', 134, 130, true);
  
  
  // example 2
  add_image_size('example2-pc-1x', 420, 500, true);
  add_image_size('example2-pc-2x', 840, 1000, true);

  add_image_size('example2-mobile-1x', 132, 157, true);
  add_image_size('example2-mobile-2x', 264, 314, true);

  // example 
  add_image_size('rev-pc-1x', 72, 72, true);
  add_image_size('rev-pc-2x', 144, 144, true);

  add_image_size('rev-mobile-1x', 44, 44, true);
  add_image_size('rev-mobile-2x', 88, 88, true);


  // example 
  add_image_size('revimg-pc-1x', 146, 158, true);
  add_image_size('revimg-pc-2x', 292, 316, true);

  add_image_size('revimg-mobile-1x', 90, 98, true);
  add_image_size('revimg-mobile-2x', 180, 196, true);

  // example 
  add_image_size('trouble-pc-1x', 191, 137, true);
  add_image_size('trouble-pc-2x', 382, 274, true);

  add_image_size('trouble-mobile-1x', 140, 100, true);
  add_image_size('trouble-mobile-2x', 280, 200, true);

  // troublebox 
  add_image_size('troublebox-pc-1x', 870, 670, true);
  add_image_size('troublebox-pc-2x', 1740, 1340, true);

  add_image_size('troublebox-mobile-1x', 349, 269, true);
  add_image_size('troublebox-mobile-2x', 698, 538, true);

  // troubleikonka 
  add_image_size('troubleikonka-pc-1x', 57, 51, true);
  add_image_size('troubleikonka-pc-2x', 114, 102, true);

  add_image_size('troubleikonka-mobile-1x', 37, 33, true);
  add_image_size('troubleikonka-mobile-2x', 74, 66, true);

  // troubleikonka 
  add_image_size('familylaw-pc-1x', 81, 70, true);
  add_image_size('familylaw-pc-2x', 162, 140, true);

  add_image_size('familylaw-mobile-1x', 56, 43, true);
  add_image_size('familylaw-mobile-2x', 112, 86, true);


  
  // troubleikonka 
  add_image_size('militarylaw-pc-1x', 74, 74, true);
  add_image_size('militarylaw-pc-2x', 148, 148, true);

  add_image_size('militarylaw-mobile-1x', 74, 74, true);
  add_image_size('militarylaw-mobile-2x', 148, 148, true);
  
  // solutions 
  add_image_size('solutions-pc-1x', 550, 310, true);
  add_image_size('solutions-pc-2x', 1100, 620, true);

  add_image_size('solutions-mobile-1x', 350, 196, true);
  add_image_size('solutions-mobile-2x', 700, 392, true); 

  // solutions 
  add_image_size('howworks-pc-1x', 78, 60, true);
  add_image_size('howworks-pc-2x', 156, 120, true);

  add_image_size('howworks-mobile-1x', 52, 40, true);
  add_image_size('howworks-mobile-2x', 104, 80, true);

  // avatar 
  add_image_size('avatar-pc-1x', 54, 54, true);
  add_image_size('avatar-pc-2x', 108, 108, true);

  add_image_size('avatar-mobile-1x', 54, 54, true);
  add_image_size('avatar-mobile-2x', 108, 108, true);

  // cover 
  add_image_size('video', 297, 223, true);
});
function get_picture($image_id = '', $thumbnail_name, $alt = '', $ariaHidden = 'false')
{
  if ($image_id != '' && $image_id != null) {
  ?>
    <img
      aria-hidden="<?php echo $ariaHidden; ?>"
      decoding="async"
      alt="<?php echo $alt; ?>"
      title="<?php echo $alt; ?>"
      src="<?php echo wp_get_attachment_image_src($image_id, $thumbnail_name . '-pc-1x')[0]; ?>"
      srcset="
      <?php echo wp_get_attachment_image_src($image_id, $thumbnail_name . '-mobile-2x')[0]; ?> 720w,
    <?php echo wp_get_attachment_image_src($image_id, $thumbnail_name . '-pc-2x')[0]; ?> 1080w"
      sizes="(max-width: 1025px) 100vw, (max-width: 1200px) 50vw, 576px"
      width="<?php echo wp_get_attachment_image_src($image_id, $thumbnail_name . '-pc-1x')[1]; ?>"
      height="<?php echo wp_get_attachment_image_src($image_id, $thumbnail_name . '-pc-1x')[2]; ?>">
<?php
  }
}

// Вимикаємо додавання <noscript> Smush
add_filter('wp_smush_should_skip_noscript', '__return_true');


// Старт output buffering
add_action('template_redirect', function () {
  ob_start('remove_smush_noscript');
});

// Функція для видалення <noscript> усередині <picture>
function remove_smush_noscript($content)
{
  return preg_replace('#<picture[^>]*>.*?<noscript>.*?</noscript>.*?</picture>#is', '', $content);
}


// Прибирає слеш у <link>
add_filter('style_loader_tag', function ($tag) {
  return str_replace(' />', '>', $tag);
}, 10, 1);


// Фільтр для прибирання кінцевих слешів у void-елементах (HTML5)
add_filter('language_attributes', function ($output) {
  return str_replace(' />', '>', $output);
});


add_filter('wpcf7_form_elements', function ($form) {
  return str_replace(' />', '>', $form);
});


// Замінюємо <br /> на <br> у контенті постів
add_filter('the_content', function ($content) {
  return str_replace('<br />', '<br>', $content);
});

remove_filter('the_content', 'wpautop');
add_filter('the_content', function ($content) {
  // Викликаємо wpautop, але замінюємо <br /> на <br>
  return str_replace('<br />', '<br>', wpautop($content));
});

// // Глобальна заміна: прибирає ' />' після обробки всього контенту
// add_filter('the_content', function($content) {
//     return str_replace(' />', '>', $content);
// }, 9999);

// // Також працює для віджетів, шорткодів, форм тощо
// add_action('wp_footer', function() {
//     ob_start(function($html) {
//         return str_replace(' />', '>', $html);
//     });
// }, 0);


// Додаємо канонічний URL у <head>
// add_action('wp_head', 'custom_canonical_tag');
function custom_canonical_tag() {
    if (is_singular(['post', 'page', 'team', 'case', 'poslugy', 'vakansiyi'])) {
        global $post;
        // Канонічне посилання для записів, сторінок і кастомних типів
        echo '<link rel="canonical" href="' . get_permalink($post) . '">' . "\n";
    } elseif (is_post_type_archive(['team', 'case', 'poslugy', 'vakansiyi'])) {
        // Канонічне посилання для архівів кастомних типів
        $post_type = get_post_type();
        echo '<link rel="canonical" href="' . get_post_type_archive_link($post_type) . '">' . "\n";
    } elseif (is_home() || is_front_page()) {
        // Канонічне посилання для головної сторінки
        echo '<link rel="canonical" href="' . home_url('/') . '">' . "\n";
    } elseif (is_category() || is_tag() || is_tax()) {
        // Канонічне посилання для таксономій
        echo '<link rel="canonical" href="' . get_term_link(get_queried_object()) . '">' . "\n";
    } elseif (is_author()) {
        // Архів автора
        echo '<link rel="canonical" href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . "\n";
    } elseif (is_date()) {
        // Архів за датою
        echo '<link rel="canonical" href="' . get_month_link(get_query_var('year'), get_query_var('monthnum')) . '">' . "\n";
    }
}

add_action('wp_head', function() {
  echo '<link rel="icon" href="https://lawgic.com.ua/favicon.ico" type="image/x-icon">' . "\n";
});


// Змінюємо атрибут lang для WPML
add_filter('language_attributes', function($output) {
    $current_lang = apply_filters('wpml_current_language', null);

    if ($current_lang === 'ru') {
        $output = str_replace('lang="ru-RU"', 'lang="ru"', $output);
    }

    return $output;
});



