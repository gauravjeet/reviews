<?php
/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
function beauty_theme_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Insert themed breadcrumb page navigation at top of the node content.
 */
function beauty_theme_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Use CSS to hide titile .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // comment below line to hide current page to breadcrumb
	$breadcrumb[] = drupal_get_title();
    $output .= '<nav class="breadcrumb">' . implode(' » ', $breadcrumb) . '</nav>';
    return $output;
  }
}


/**
 * Override or insert variables into the page template.
 */
function beauty_theme_preprocess_page(&$vars) {

  // Add JS to close Ctools modal.
  drupal_add_js(drupal_get_path('theme', 'beauty_theme') . '/js/ctools_close_modal.js');

  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }

  // Sat a default 404 page theme.
  $header = drupal_get_http_header('status');
  if ($header == "404 Not Found") {
    $vars['theme_hook_suggestions'][] = 'page__404_error';
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function beauty_theme_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function beauty_theme_preprocess_node(&$variables) {
  $node = $variables['node'];
  $variables['blog'] = 0;
  $variables['my_thoughts'] = 0;
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }

  // Prepend quotes.
  if ($node->type == 'blog') {
    $variables['blog'] = 1;
    $variables['quote_left'] = '<i class="fa fa-quote-left fa-3x fa-pull-left fa-border"></i>';
  }
  if ($node->type == 'my_thoughts' && $node->field_category[LANGUAGE_NONE][0]['tid'] == 2) {
    $variables['my_thoughts'] = 1;
    $variables['quote_info'] = '<i class="fa fa-info fa-3x fa-pull-left fa-border"></i>';
  }
  $variables['date1'] = t('!datetime', array('!datetime' =>  date('\<\s\p\a\n\>d\<\/\s\p\a\n\>\<\b\r\>M\<\b\r\>Y', $variables['created'])));
  $variables['date'] = t('!datetime', array('!datetime' =>  date('l, j F Y', $variables['created'])));
}

function beauty_theme_page_alter($page) {
  // <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
    'name' =>  'viewport',
    'content' =>  'width=device-width, initial-scale=1, maximum-scale=1'
    )
  );
  drupal_add_html_head($viewport, 'viewport');
}