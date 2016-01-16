<?php

/**
 * Unset core css files.
 */
function manystories_css_alter(&$css) {
  unset($css[drupal_get_path('module','system').'/system.theme.css']);
  unset($css[drupal_get_path('module','system').'/system.base.css']);
  unset($css[drupal_get_path('module','system').'/system.messages.css']);
  unset($css[drupal_get_path('module','system').'/system.menus.css']);
}

/**
 * Add/Remove classes for several pages
 */
function manystories_preprocess_html(&$variables) {
  if (arg(0) == "taxonomy" && is_numeric(arg(2))) {
    $title = i18n_taxonomy_localize_terms(taxonomy_term_load(arg(2)))->name;
    $variables['head_title'] = $title . " | " . variable_get('site_name', '');
  }

  global $theme;
  global $base_url;
  $path = "/" . drupal_get_path('theme', $theme) . "/images/favicons";

  $headers = drupal_get_http_header();
  if (isset($headers['status']) && $headers['status'] == '404 Not Found') {
    $variables['classes_array'][] = 'page-404';
  }

  // Icons for mobile etc
  $touchicon = '<link rel="apple-touch-icon" sizes="57x57" href="'.$path.'/apple-touch-icon-57x57.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="60x60" href="'.$path.'/apple-touch-icon-60x60.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="72x72" href="'.$path.'/apple-touch-icon-72x72.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="76x76" href="'.$path.'/apple-touch-icon-76x76.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="114x114" href="'.$path.'/apple-touch-icon-114x114.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="120x120" href="'.$path.'/apple-touch-icon-120x120.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="144x144" href="'.$path.'/apple-touch-icon-144x144.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="152x152" href="'.$path.'/apple-touch-icon-152x152.png">' . "\n";
  $touchicon .= '<link rel="apple-touch-icon" sizes="180x180" href="'.$path.'/apple-touch-icon-180x180.png">' . "\n";
  $touchicon .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-32x32.png" sizes="32x32">' . "\n";
  $touchicon .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-194x194.png" sizes="194x194">' . "\n";
  $touchicon .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-96x96.png" sizes="96x96">' . "\n";
  $touchicon .= '<link rel="icon" type="image/png" href="'.$path.'/android-chrome-192x192.png" sizes="192x192">' . "\n";
  $touchicon .= '<link rel="icon" type="image/png" href="'.$path.'/favicon-16x16.png" sizes="16x16">' . "\n";
  $touchicon .= '<link rel="manifest" href="'.$path.'/manifest.json">' . "\n";
  $touchicon .= '<link rel="mask-icon" href="'.$path.'/safari-pinned-tab.svg" color="#5bbad5">' . "\n";
  $touchicon .= '<meta name="msapplication-TileColor" content="#ffffff">' . "\n";
  $touchicon .= '<meta name="msapplication-TileImage" content="'.$path.'/mstile-144x144.png">' . "\n";
  $touchicon .= '<meta name="msapplication-config" content="'.$path.'/browserconfig.xml">' . "\n";
  $touchicon .= '<meta name="theme-color" content="#ffffff">' . "\n";

  $variables['appletouchicon'] = $touchicon;
}

/**
 * Implements hook_html_head_alter().
 */
function manystories_html_head_alter(&$head_elements) {
  // Remove meta added by Mothership base theme
  unset($head_elements['my_meta']);
}

/**
 * Implements hook_menu_alter()
 */
function manystories_menu_alter(&$items) {
  global $user;
  if ($user->uid != '1') {
    $items['admin/config/people']['access callback'] = FALSE;
  }
}