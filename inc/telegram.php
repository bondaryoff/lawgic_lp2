<?php
// 🔄 Відправка даних CF7 у Telegram
add_action('wpcf7_mail_sent', 'send_cf7_to_telegram');
function send_cf7_to_telegram($contact_form)
{
$submission = WPCF7_Submission::get_instance();
if (!$submission) return;

$data = $submission->get_posted_data();
$uploaded_files = $submission->uploaded_files();

// ✏️ Отримуємо поля
// $names = sanitize_text_field($data['names'] ?? '');
// $phone = sanitize_text_field($data['phone '] ?? '');
// $telegram = sanitize_text_field($data['telegram'] ?? '');
// $mess = sanitize_text_field($data['mess'] ?? '');
// $texts = sanitize_text_field($data['text'] ?? '');
// $title = sanitize_text_field($data['title'] ?? '');
// $all_answers = sanitize_text_field($data['all_answers'] ?? '');
// $privacy = sanitize_text_field($data['privacy'] ?? '');

// // 📩 Формуємо повідомлення
// $letter = "📥 <b>Нова заявка з сайту lawgic.com.ua</b>\n\n";
// if ($names) $letter .= "<b>ПІБ:</b> <code>$names</code>\n";
// if ($phone ) $letter .= "<b>Телефон:</b> <code>$phone </code>\n";
// if ($phone ) $letter .= "<b>Телефон:</b> $phone \n";
// if ($telegram) {
// $tg = ltrim($telegram, '@');
// $letter .= "Telegram: [@$tg](https://t.me/$tg) \n";
// }
// if ($title) $letter .= "Заголовок: $title\n";
// if ($texts) $letter .= "📝 <b>Текст:</b>\n<code>$texts</code>\n";
// if ($all_answers) $letter .= "📝 <b>Текст:</b>\n<code>$all_answers</code>\n";
// if ($texts) $letter .= "\n";
// if ($mess) $letter .= "📝 <b>Повідомлення:</b>\n<code> $mess</code>\n";
// if ($mess) $letter .= "\n";
// ✏️ Отримуємо поля
$names = sanitize_text_field($data['names'] ?? '');
$phone = sanitize_text_field($data['phone'] ?? '');
$telegram = sanitize_text_field($data['telegram'] ?? '');
$mess = sanitize_text_field($data['mess'] ?? '');
$texts = sanitize_text_field($data['text'] ?? '');
$title = sanitize_text_field($data['title'] ?? '');
$source = sanitize_text_field($data['source'] ?? '');
$radio44 = sanitize_text_field($data['radio-44'] ?? '');
// 🔄 Використовуємо sanitize_textarea_field для довгого тексту
$all_answers = sanitize_textarea_field($data['all_answers'] ?? '');
$privacy = sanitize_text_field($data['privacy'] ?? '');

// 📩 Формуємо повідомлення
$letter = "📥 <b>Нова заявка з лендингу 'ВІЙСЬКОВИЙ АДВОКАТ'</b>\n\n";
if ($source) $letter .= "<b>Ресурс:</b> <code>$source</code>\n";
if ($names) $letter .= "<b>ПІБ:</b> <code>$names</code>\n";
if ($phone) $letter .= "<b>Телефон:</b> <code>$phone</code>\n";
if ($phone) $letter .= "<b>Телефон:</b> $phone\n";
if ($radio44) $letter .= "<b>Тема:</b> $radio44\n";
if ($telegram) {
$tg = ltrim($telegram, '@');
$letter .= "Telegram: [@$tg](https://t.me/$tg) \n";
}
if ($title) $letter .= "Заголовок: $title\n";
if ($texts) $letter .= "📝 <b>Текст:</b>\n<code>$texts</code>\n";

// 📋 Форматуємо та додаємо all_answers
if ($all_answers) {
// Розбиваємо по номерах питань
$parts = preg_split('/\d+\.\s*/', $all_answers, -1, PREG_SPLIT_NO_EMPTY);

// Збираємо назад з правильним форматуванням
$formatted_answers = '';
foreach ($parts as $index => $part) {
$num = $index + 1;
$formatted_answers .= "$num. " . trim($part) . "\n\n";
}

$letter .= "📋 <b>Опитування:</b>\n<code>$formatted_answers</code>\n";
}

if ($mess) {
$letter .= "📝 <b>Повідомлення:</b>\n<code>$mess</code>\n";
}



// 📎 Обробка файлів CFDB7 (якщо є)
if (!empty($uploaded_files)) {
foreach ($uploaded_files as $field_name => $files) {
if (is_array($files)) {
foreach ($files as $file_path) {
if (file_exists($file_path)) {
// Генеруємо правильний URL для CFDB7
$file_url = generate_cfdb7_file_url($file_path);
$file_name = basename($file_path);
$letter .= "📎 Файл: <a href=\"$file_url\">$file_name</a>\n";
}
}
} else {
// Якщо це не масив, а одиночний файл
$file_path = $files;
if (file_exists($file_path)) {
// Генеруємо правильний URL для CFDB7
$file_url = generate_cfdb7_file_url($file_path);
$file_name = basename($file_path);
$letter .= "📎 Файл: <a href=\"$file_url\">$file_name</a>\n";
}
}
}
}

// 📤 Відправка в Telegram
$token = '8022928575:AAG49N6gEAg4t0uIPcyF-eGi7rwAG5yUrKU';
$chat_id = '-1002596385956';
$url = "https://api.telegram.org/bot$token/sendMessage";

wp_remote_post($url, [
'body' => [
'chat_id' => $chat_id,
'text' => $letter,
'parse_mode' => 'HTML',
'disable_web_page_preview' => true
]
]);
}

// 🔧 Функція для пошуку файлу в CFDB7 папці
function find_cfdb7_file($original_path)
{
$upload_dir = wp_upload_dir();
$file_name = basename($original_path);

// Шукаємо файл в cfdb7_uploads з патерном: timestamp-fieldname-filename
$cfdb7_pattern = $upload_dir['basedir'] . '/cfdb7_uploads/*-documents-' . $file_name;
$matching_files = glob($cfdb7_pattern);

if (!empty($matching_files)) {
return $matching_files[0]; // Повертаємо перший знайдений файл
}

// Якщо не знайдено з documents, шукаємо без префіксу
$cfdb7_pattern2 = $upload_dir['basedir'] . '/cfdb7_uploads/*-' . $file_name;
$matching_files2 = glob($cfdb7_pattern2);

if (!empty($matching_files2)) {
return $matching_files2[0];
}

return $original_path; // Якщо нічого не знайдено, повертаємо оригінальний шлях
}

// 🔧 Функція для генерації правильного URL для CFDB7 файлів
function generate_cfdb7_file_url($file_path)
{
  $upload_dir = wp_upload_dir();

  // Якщо файл знаходиться в cfdb7_uploads
  if (strpos($file_path, 'cfdb7_uploads') !== false) {
    return str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $file_path);
  }

  // Якщо файл знаходиться в wpcf7_uploads, конвертуємо в cfdb7 формат
  if (strpos($file_path, 'wpcf7_uploads') !== false) {
    // Витягуємо ім'я файлу
    $file_name = basename($file_path);

    // Шукаємо файл в cfdb7_uploads
    $cfdb7_pattern = $upload_dir['basedir'] . '/cfdb7_uploads/*-documents-' . $file_name;
    $matching_files = glob($cfdb7_pattern);

    if (!empty($matching_files)) {
      $cfdb7_file_path = $matching_files[0];
      return str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $cfdb7_file_path);
    }
  }

  // Якщо нічого не знайдено, повертаємо стандартний URL
  return str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $file_path);
}