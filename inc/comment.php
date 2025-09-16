<?php


function disable_wpml_comments_multilingual()
{
  // Відключаємо фільтрацію коментарів по мові в WPML
  remove_filter('comments_clauses', array($GLOBALS['sitepress'], 'comments_clauses'));
  remove_filter('comments_clauses', ['WPML_Comments_Filter', 'comments_clauses'], 10, 2);

  // Додаємо наш власний фільтр для повного відключення мовної фільтрації
  add_filter('comments_clauses', 'force_remove_wpml_comments_filter', 999);
}
// Глобальне відключення мультимовності для коментарів
add_action('init', 'disable_wpml_comments_multilingual');

function force_remove_wpml_comments_filter($clauses)
{
  global $wpdb;

  // Повністю очищаємо JOIN від WPML таблиць
  if (isset($clauses['join'])) {
    $clauses['join'] = preg_replace('/LEFT JOIN\s+' . $wpdb->prefix . 'icl_translations[^WHERE]*/', '', $clauses['join']);
    $clauses['join'] = preg_replace('/JOIN\s+' . $wpdb->prefix . 'icl_translations[^WHERE]*/', '', $clauses['join']);
  }

  // Повністю очищаємо WHERE від WPML умов
  if (isset($clauses['where'])) {
    $clauses['where'] = preg_replace("/AND\s+[^.]*icl_translations[^AND]*/", '', $clauses['where']);
    $clauses['where'] = preg_replace("/\s+AND\s+\(\s*\)/", '', $clauses['where']);
  }

  return $clauses;
}



// Hook для збереження коментарів без привязки до мови
add_action('comment_post', 'save_comment_to_original_post', 10, 2);

function save_comment_to_original_post($comment_id, $comment_approved)
{
  $comment = get_comment($comment_id);
  $post_id = $comment->comment_post_ID;

  // Отримуємо ID поста для обох мов
  if (function_exists('wpml_object_id_filter')) {
    $uk_post_id = wpml_object_id_filter($post_id, get_post_type($post_id), false, 'uk');
    $ru_post_id = wpml_object_id_filter($post_id, get_post_type($post_id), false, 'ru');
    
    // Отримуємо рейтинг оригінального коментаря
    $rating = get_comment_meta($comment_id, 'rating', true);
    
    // Якщо коментар додається на українській версії, додаємо його і на російську
    if ($post_id == $uk_post_id && $ru_post_id) {
      // Шукаємо відповідний коментар на російській версії
      $ru_comments = get_comments(array(
        'post_id' => $ru_post_id,
        'meta_query' => array(
          array(
            'key' => 'wpml_original_comment_id',
            'value' => $comment_id
          )
        )
      ));
      
      if (!empty($ru_comments)) {
        $ru_comment = $ru_comments[0];
        // Оновлюємо рейтинг на російській версії
        if ($rating) {
          update_comment_meta($ru_comment->comment_ID, 'rating', $rating);
        }
      } else {
        // Якщо коментар ще не існує, створюємо його
        $new_comment = array(
          'comment_post_ID' => $ru_post_id,
          'comment_author' => $comment->comment_author,
          'comment_author_email' => $comment->comment_author_email,
          'comment_content' => $comment->comment_content,
          'comment_type' => $comment->comment_type,
          'comment_parent' => $comment->comment_parent,
          'user_id' => $comment->user_id,
          'comment_approved' => $comment->comment_approved
        );
        $new_comment_id = wp_insert_comment($new_comment);
        
        // Зберігаємо зв'язок між коментарями
        add_comment_meta($new_comment_id, 'wpml_original_comment_id', $comment_id);
        
        // Копіюємо рейтинг
        if ($rating) {
          add_comment_meta($new_comment_id, 'rating', $rating);
        }
      }
    }
    // Якщо коментар додається на російській версії, додаємо його і на українську
    elseif ($post_id == $ru_post_id && $uk_post_id) {
      // Шукаємо відповідний коментар на українській версії
      $uk_comments = get_comments(array(
        'post_id' => $uk_post_id,
        'meta_query' => array(
          array(
            'key' => 'wpml_original_comment_id',
            'value' => $comment_id
          )
        )
      ));
      
      if (!empty($uk_comments)) {
        $uk_comment = $uk_comments[0];
        // Оновлюємо рейтинг на українській версії
        if ($rating) {
          update_comment_meta($uk_comment->comment_ID, 'rating', $rating);
        }
      } else {
        // Якщо коментар ще не існує, створюємо його
        $new_comment = array(
          'comment_post_ID' => $uk_post_id,
          'comment_author' => $comment->comment_author,
          'comment_author_email' => $comment->comment_author_email,
          'comment_content' => $comment->comment_content,
          'comment_type' => $comment->comment_type,
          'comment_parent' => $comment->comment_parent,
          'user_id' => $comment->user_id,
          'comment_approved' => $comment->comment_approved
        );
        $new_comment_id = wp_insert_comment($new_comment);
        
        // Зберігаємо зв'язок між коментарями
        add_comment_meta($new_comment_id, 'wpml_original_comment_id', $comment_id);
        
        // Копіюємо рейтинг
        if ($rating) {
          add_comment_meta($new_comment_id, 'rating', $rating);
        }
      }
    }
  }
}






add_action('comment_post', 'save_comment_rating');
function save_comment_rating($comment_id)
{
  $comment = get_comment($comment_id);
  $user = get_user_by('id', $comment->user_id);

  // Пропускаємо рейтинг для адміністраторів
  if ($user && in_array('administrator', (array)$user->roles)) {
    return;
  }

  // Збереження тільки для коментарів першого рівня
  if ($comment->comment_parent == 0 && isset($_POST['rating']) && $_POST['rating'] != '') {
    $rating = intval($_POST['rating']);
    if ($rating >= 1 && $rating <= 5) {
      add_comment_meta($comment_id, 'rating', $rating);
    }
  }
}


add_filter('preprocess_comment', 'require_rating_field');

function require_rating_field($commentdata)
{
  // Отримуємо користувача
  $user = wp_get_current_user();

  // Пропускаємо рейтинг для адміністраторів
  if (in_array('administrator', (array)$user->roles)) {
    return $commentdata;
  }

  // Пропускаємо рейтинг для відповідей
  if (!isset($commentdata['comment_parent']) || $commentdata['comment_parent'] == 0) {
    if (!isset($_POST['rating']) || empty($_POST['rating'])) {
      wp_die(__('Помилка: Будь ласка, оберіть рейтинг від 1 до 5 зірок.', 'lawgic'));
    }

    $rating = intval($_POST['rating']);
    if ($rating < 1 || $rating > 5) {
      wp_die(__('Помилка: Рейтинг повинен бути від 1 до 5 зірок.', 'lawgic'));
    }
  }

  return $commentdata;
}


// Відображення рейтингу в колонці адмінки
function show_rating_in_comments_column($column, $comment_ID)
{
  if ($column == 'rating') {
    $rating = get_comment_meta($comment_ID, 'rating', true);
    $comment = get_comment($comment_ID);

    // Показуємо рейтинг тільки для коментарів першого рівня
    if ($comment->comment_parent == 0 && $rating) {
      echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating) . ' (' . $rating . '/5)';
    } elseif ($comment->comment_parent != 0) {
      echo '<span style="color: #999;">Відповідь</span>';
    } else {
      echo '—';
    }
  }
}
add_action('manage_comments_custom_column', 'show_rating_in_comments_column', 10, 2);

// Додавання поля рейтингу в форму редагування коментаря
function add_rating_field_to_comment_edit($comment)
{
  $rating = get_comment_meta($comment->comment_ID, 'rating', true);

  // Показуємо поле рейтингу тільки для коментарів першого рівня
  if ($comment->comment_parent == 0) {
?>
    <tr>
      <td class="first"><label for="rating"><?php _e('Рейтинг:', 'lawgic'); ?></label></td>
      <td>
        <select name="rating" id="rating">
          <option value=""><?php _e('Без рейтингу', 'lawgic'); ?></option>
          <?php for ($i = 1; $i <= 5; $i++) : ?>
            <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>>
              <?php echo $i; ?> <?php echo str_repeat('★', $i); ?>
            </option>
          <?php endfor; ?>
        </select>
      </td>
    </tr>
  <?php
  } else {
  ?>
    <tr>
      <td class="first"><?php _e('Тип коментаря:', 'lawgic'); ?></td>
      <td><strong><?php _e('Відповідь (без рейтингу)', 'lawgic'); ?></strong></td>
    </tr>
  <?php
  }
}
add_action('add_meta_boxes_comment', function () {
  add_meta_box('rating', __('Рейтинг коментаря', 'lawgic'), 'add_rating_field_to_comment_edit', 'comment', 'normal', 'high');
});

// Збереження рейтингу при редагуванні коментаря в адмінці
function save_rating_in_comment_edit($comment_id)
{
  $comment = get_comment($comment_id);

  // Збереження рейтингу тільки для коментарів першого рівня
  if ($comment->comment_parent == 0) {
    if (isset($_POST['rating'])) {
      $rating = intval($_POST['rating']);
      if ($rating >= 1 && $rating <= 5) {
        update_comment_meta($comment_id, 'rating', $rating);
      } elseif ($rating == 0) {
        delete_comment_meta($comment_id, 'rating');
      }
    }
  }
}
add_action('edit_comment', 'save_rating_in_comment_edit');



// CSS для адмінки
function admin_rating_styles()
{
  ?>
  <style>
    .column-rating {
      width: 120px;
    }

    .average-rating-shortcode .stars {
      color: #ffc107;
      font-size: 16px;
      margin-right: 8px;
    }

    .average-rating-shortcode .rating-text {
      font-size: 14px;
      color: #666;
    }

    .no-rating {
      color: #999;
      font-style: italic;
    }
  </style>
<?php
}
add_action('admin_head', 'admin_rating_styles');

// Додавання рейтингу до RSS (тільки для коментарів першого рівня)
function add_rating_to_rss($content)
{
  if (is_feed()) {
    global $comment;
    if (isset($comment) && is_object($comment) && $comment->comment_parent == 0) {
      $rating = get_comment_meta($comment->comment_ID, 'rating', true);

      if ($rating) {
        $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
        $rating_html = '<p><strong>Рейтинг: ' . $stars . ' (' . $rating . '/5)</strong></p>';
        $content = $rating_html . $content;
      }
    }
  }
  return $content;
}
add_filter('comment_text_rss', 'add_rating_to_rss');

// Функція для отримання рейтингу конкретного коментаря
function get_comment_rating($comment_id = null)
{
  if (! $comment_id) {
    $comment_id = get_comment_ID();
  }

  $comment = get_comment($comment_id);
  // Повертаємо рейтинг тільки для коментарів першого рівня
  if ($comment && $comment->comment_parent == 0) {
    return get_comment_meta($comment_id, 'rating', true);
  }

  return null;
}

// Функція для підрахунку тільки коментарів з рейтингом (першого рівня)
function get_rating_comments_count($post_id = null)
{
  if (!$post_id) {
    $post_id = get_the_ID();
  }

  $comments = get_comments(array(
    'post_id' => $post_id,
    'status' => 'approve',
    'parent' => 0 // Тільки коментарі першого рівня
  ));

  $count = 0;
  foreach ($comments as $comment) {
    $rating = get_comment_meta($comment->comment_ID, 'rating', true);
    if ($rating) {
      $count++;
    }
  }

  return $count;
}


// Додаємо чекбокс в адмінку
add_action('add_meta_boxes_comment', function () {
  add_meta_box(
    'show_on_home',
    __('Виводити на головній', 'lawgic'),
    'render_show_on_home_checkbox',
    'comment',
    'normal',
    'high'
  );
  add_meta_box(
    'show_on_about',
    __('Виводити на Про нас', 'lawgic'),
    'render_show_on_about_checkbox',
    'comment',
    'normal',
    'high'
  );
});

// HTML для чекбоксу
function render_show_on_home_checkbox($comment)
{
  $value = get_comment_meta($comment->comment_ID, 'show_on_home', true);
?>
  <label>
    <input type="checkbox" name="show_on_home" value="1" <?php checked($value, '1'); ?> />
    <?php _e('Показати цей коментар на головній', 'lawgic'); ?>
  </label>
<?php
}
function render_show_on_about_checkbox($comment)
{
  $value = get_comment_meta($comment->comment_ID, 'show_on_about', true);
?>
  <label>
    <input type="checkbox" name="show_on_about" value="1" <?php checked($value, '1'); ?> />
    <?php _e('Показати цей коментар на сторінці Про нас', 'lawgic'); ?>
  </label>
  <?php
}

// Зберігаємо мета-поле
add_action('edit_comment', function ($comment_ID) {
  $show = isset($_POST['show_on_home']) ? '1' : '';
  update_comment_meta($comment_ID, 'show_on_home', $show);
  $show = isset($_POST['show_on_about']) ? '1' : '';
  update_comment_meta($comment_ID, 'show_on_about', $show);
});



// Додаємо нову колонку
add_filter('manage_edit-comments_columns', function ($columns) {
  $columns['show_on_home'] = __('На головній', 'lawgic');
  $columns['show_on_about'] = __('Про нас', 'lawgic');
  return $columns;
});



// Виводимо статус для нової колонки
add_action('manage_comments_custom_column', function ($column, $comment_ID) {
  if ($column === 'show_on_home') {
    $value = get_comment_meta($comment_ID, 'show_on_home', true);
    echo $value ? '✅' : '—';
  }

  if ($column === 'show_on_about') {
    $value = get_comment_meta($comment_ID, 'show_on_about', true);
    echo $value ? '✅' : '—';
  }
}, 10, 2);



function theme_enqueue_comment_reply()
{
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_comment_reply');


// Додаємо скрипт для алерта після відправки відгука
add_action('wp_footer', function () {
  // Перевіряємо, чи був щойно відправлений коментар
  if (isset($_COOKIE['wp_comment_status']) && $_COOKIE['wp_comment_status'] === 'awaiting') : ?>
    <?php if (get_field('tekst_flerta_vidguka', 'option')) : ?>
      <script>
        const alertMessage = '<?php echo get_field('tekst_flerta_vidguka', 'option'); ?>';
        alert(alertMessage);
        // Видаляємо cookie, щоб алерт не зʼявлявся при перезавантаженні
        document.cookie = "wp_comment_status=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      </script>
    <?php else: ?>
      <script>
        alert('Ваш відгук на модерації.');
        // Видаляємо cookie, щоб алерт не зʼявлявся при перезавантаженні
        document.cookie = "wp_comment_status=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      </script>
    <?php endif; ?>

  <?php endif;
});

// Ставимо cookie після сабміту коментаря, якщо він чекає модерації
add_filter('comment_post_redirect', function ($location, $comment) {
  if ($comment->comment_approved === '0') {
    // Ставимо cookie на короткий час
    setcookie('wp_comment_status', 'awaiting', time() + 30, '/');
  }
  return $location;
}, 10, 2);


// Перевизначаємо поведінку при помилці валідації коментаря
function custom_comment_post_redirect($location, $comment)
{
  if (isset($_SERVER['HTTP_REFERER']) && is_wp_error($comment)) {
    // Додаємо GET-параметр з кодом помилки
    $location = add_query_arg('comment_error', 'required', $_SERVER['HTTP_REFERER']);
  }
  return $location;
}
add_filter('comment_post_redirect', 'custom_comment_post_redirect', 10, 2);

// Виводимо JavaScript alert, якщо є помилка в параметрах URL
function custom_comment_error_alert()
{
  if (isset($_GET['comment_error']) && $_GET['comment_error'] === 'required') {
  ?>
    <script>
      // Показуємо alert українською
      alert("Будь ласка, заповніть усі обов'язкові поля коментаря.");
    </script>
<?php
  }
}
add_action('wp_footer', 'custom_comment_error_alert'); // Виводимо скрипт в footer



function display_star_rating($rating)
{
  $rating = floatval($rating);
  $stars = '';

  for ($i = 1; $i <= 5; $i++) {
    if ($i <= $rating) {
      $stars .= '<span class="star filled">★</span>';
    } elseif ($i - 0.5 <= $rating) {
      $stars .= '<span class="star half">☆</span>';
    } else {
      $stars .= '<span class="star empty">☆</span>';
    }
  }

  return '<span class="stars">' . $stars . '</span>';
}


add_filter('comments_clauses', function($clauses, $query) {
  if (!is_admin() && $query->is_main_query() && is_singular()) {
      global $sitepress;
      // Отримати ID оригінального поста
      $original_id = apply_filters('wpml_object_id', get_the_ID(), get_post_type(), FALSE, $sitepress->get_default_language());
      if ($original_id && $original_id != get_the_ID()) {
          $clauses['where'] = str_replace("comment_post_ID = " . get_the_ID(), "comment_post_ID = $original_id", $clauses['where']);
      }
  }
  return $clauses;
}, 10, 2);

// Синхронізація рейтингів після підтвердження коментаря
add_action('transition_comment_status', 'sync_comment_ratings_after_approval', 10, 3);

function sync_comment_ratings_after_approval($new_status, $old_status, $comment) {
    // Перевіряємо, чи коментар був підтверджений
    if ($new_status === 'approved' && $old_status !== 'approved') {
        $post_id = $comment->comment_post_ID;
        
        // Отримуємо рейтинг оригінального коментаря
        $rating = get_comment_meta($comment->comment_ID, 'rating', true);
        
        if ($rating && function_exists('wpml_object_id_filter')) {
            // Отримуємо ID поста для обох мов
            $uk_post_id = wpml_object_id_filter($post_id, get_post_type($post_id), false, 'uk');
            $ru_post_id = wpml_object_id_filter($post_id, get_post_type($post_id), false, 'ru');
            
            // Визначаємо, на якій мові був створений коментар
            if ($post_id == $uk_post_id && $ru_post_id) {
                // Шукаємо відповідний коментар на російській версії
                $ru_comments = get_comments(array(
                    'post_id' => $ru_post_id,
                    'meta_query' => array(
                        array(
                            'key' => 'wpml_original_comment_id',
                            'value' => $comment->comment_ID
                        )
                    )
                ));
                
                if (!empty($ru_comments)) {
                    $ru_comment = $ru_comments[0];
                    // Оновлюємо рейтинг на російській версії
                    update_comment_meta($ru_comment->comment_ID, 'rating', $rating);
                }
            } elseif ($post_id == $ru_post_id && $uk_post_id) {
                // Шукаємо відповідний коментар на українській версії
                $uk_comments = get_comments(array(
                    'post_id' => $uk_post_id,
                    'meta_query' => array(
                        array(
                            'key' => 'wpml_original_comment_id',
                            'value' => $comment->comment_ID
                        )
                    )
                ));
                
                if (!empty($uk_comments)) {
                    $uk_comment = $uk_comments[0];
                    // Оновлюємо рейтинг на українській версії
                    update_comment_meta($uk_comment->comment_ID, 'rating', $rating);
                }
            }
        }
    }
}
