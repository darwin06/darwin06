<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <title>
    <?php
    if (function_exists('is_tag') && is_tag()) {
        echo 'Tag Archive for &quot;'.$tag.'&quot; - ';
    } elseif (is_archive()) {
        wp_title('');
        echo ' Archive - ';
    } elseif (is_search()) {
        echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
    } elseif (!(is_404()) && (is_single()) || (is_page())) {
        wp_title('');
        echo ' - ';
    } elseif (is_404()) {
        echo 'Not Found - ';
    }
    bloginfo('name');
    ?>
  </title>
  <meta name="description" content="<?php if (is_single()) {
        single_post_title('', true);
    } else {
        bloginfo('name');
        echo " - ";
        bloginfo('description');
    }
    ?>" />
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0' />

  <?php if (is_single() || is_page() || is_home()) { ?>
  <meta name="googlebot" content="index,noarchive,follow,noodp" />
  <meta name="robots" content="all,index,follow" />
  <meta name="msnbot" content="all,index,follow" />
  <?php } else { ?>
  <meta name="googlebot" content="noindex,noarchive,follow,noodp" />
  <meta name="robots" content="noindex,follow" />
  <meta name="msnbot" content="noindex,follow" />
  <?php }?>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php do_action('after_body_open_tag'); ?>
  <header>
    <?php get_template_part('inc/components/top-nav'); ?>
  </header>
