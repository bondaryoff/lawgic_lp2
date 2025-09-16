<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lawgic
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-PJHKK8PW');
  </script>
  <!-- End Google Tag Manager -->
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
  <link rel="shortcut icon" href="/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="lawgic.com.ua" />
  <link rel="manifest" href="/site.webmanifest" />


  <?php $mr_kontakt = get_field('mr_kontakt','option') ?>
  <?php $mr_logo = get_field('mr_logo','option') ?>
  <!-- <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "url": "<?php echo esc_url( home_url() ); ?>",
    "logo": "<?php echo $mr_logo; ?>",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "<?php echo $mr_kontakt ?>",
      "contactType": "customer service"
    }
  }
  </script> -->
  

  <?php wp_head(); ?>


    <?php $curr_lang = apply_filters( 'wpml_current_language', NULL ); ?> 
  <?php if($curr_lang == 'ua'){
    $person = 'Валерія Одинцова';
  } else {
    $person = 'Валерия Одинцова';
  }
    ?>

      <!-- <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Article",
    "@id": "<?php the_permalink(); ?>#richSnippet",
    "headline": "<?php echo esc_js( get_post_meta( get_the_ID(), '_yoast_wpseo_focuskw', true ) ); ?>",
    "keywords": "<?php echo esc_js( get_post_meta( get_the_ID(), '_yoast_wpseo_focuskw', true ) ); ?>",
    "datePublished": "<?php echo get_the_date( DATE_W3C ); ?>",
    "dateModified": "<?php echo get_the_modified_date( DATE_W3C ); ?>",
    "description": "<?php echo esc_js( get_the_excerpt() ); ?>",
    "name": "<?php echo esc_js( get_post_meta( get_the_ID(), '_yoast_wpseo_focuskw', true ) ); ?>",
    "inLanguage": "<?php echo apply_filters( 'wpml_current_language', NULL ); ?>",
    "author": {
      "@type": "Person",
      "@id": "<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>",
      "name": "<?php echo $person; ?>",
      "sameAs": "<?php echo esc_url( home_url() ); ?>",
      "image": {
        "@type": "ImageObject",
        "url": "<?php echo get_avatar_url( get_the_author_meta('ID') ); ?>",
        "caption": "<?php echo esc_js( get_bloginfo('name') ); ?>", // назва сайту
        "inLanguage": "<?php echo apply_filters( 'wpml_current_language', NULL ); ?>"
      }
    },
    "publisher": {
      "@type": "Organization",
      "@id": "<?php echo esc_url( home_url( '#organization' ) ); ?>",
      "name": "<?php echo esc_js( get_bloginfo('name') ); ?>",
      "sameAs": "<?php echo get_field('faceboock', 'option'); ?>",
      "logo": {
        "@type": "ImageObject",
        "@id": "<?php echo esc_url( home_url( '#logo' ) ); ?>",
        "url": "<?php echo esc_url( get_template_directory_uri() . '/images/logo_white_on_black2.png' ); ?>",
        "contentUrl": "<?php echo esc_url( get_template_directory_uri() . '/images/logo_white_on_black2.png' ); ?>",
        "caption": "<?php echo esc_js( get_bloginfo('name') ); ?>", // назва сайту
        "inLanguage": "<?php echo apply_filters( 'wpml_current_language', NULL ); ?>",
        "width": 1300,
        "height": 1300
      }
    },
    "image": {
      "@type": "ImageObject",
      "url": "<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>",
      "caption": "<?php echo esc_js( get_bloginfo('name') ); ?>", // назва сайту
      "inLanguage": "<?php echo apply_filters( 'wpml_current_language', NULL ); ?>"
    },
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "<?php the_permalink(); ?>",
      "url": "<?php the_permalink(); ?>",
      "name": "<?php echo esc_js( get_the_title() ); ?>",
      "datePublished": "<?php echo get_the_date( DATE_W3C ); ?>",
      "dateModified": "<?php echo get_the_modified_date( DATE_W3C ); ?>",
      "inLanguage": "<?php echo apply_filters( 'wpml_current_language', NULL ); ?>"
    }
  }
  </script> -->
  <?php if (is_front_page()) { ?>


  <!-- <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "<?php echo esc_url( home_url() ); ?>",
    "inLanguage": "<?php echo apply_filters( 'wpml_current_language', NULL ); ?>",
    "name": "<?php echo esc_js( get_bloginfo( 'name' ) ); ?>",
    "potentialAction": {
      "@type": "SearchAction",
      "target": {
        "@type": "EntryPoint",
        "urlTemplate": "<?php echo esc_url( home_url( '/?s={search_term_string}' ) ); ?>"
      },
      "query-input": {
        "@type": "PropertyValueSpecification",
        "valueRequired": "http://schema.org/True",
        "valueName": "search_term_string"
      }
    }
  }
  </script> -->




    <style id="critical-style">
      
    </style>
  <?php } else { ?>
    <style id="critical-style">
   
    </style>
  <?php } ?>
</head>

<body <?php body_class(); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PJHKK8PW"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <?php wp_body_open(); ?>