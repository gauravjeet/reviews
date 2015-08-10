<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>
<header id="header">
  <hgroup id="logo">
    <h1 class="logo-font"><a href="<?php print $front_page; ?>" title="<?php print $site_name; ?>"><?php print $site_name; ?></a></h1>
    <div class="site-slogan"><?php print $site_slogan; ?></div>
  </hgroup>
  <nav id="navigation" role="navigation">
    <div id="main-menu" class="main-menu-fonts">
      <?php 
        if (module_exists('i18n_menu')) {
          $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
        } else {
          $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
        }
        print drupal_render($main_menu_tree);
      ?>
    </div>
  </nav>
</header>

<div class="container">

  <?php if($page['preface_first'] || $page['preface_middle'] || $page['preface_last']) : ?>
  <div id="preface-wrapper" class="in<?php print (bool) $page['preface_first'] + (bool) $page['preface_middle'] + (bool) $page['preface_last']; ?> clearfix">
    <?php if($page['preface_first']) : ?>
    <div class="column A">
      <?php print render ($page['preface_first']); ?>
    </div>
    <?php endif; ?>
    <?php if($page['preface_middle']) : ?>
    <div class="column B">
      <?php print render ($page['preface_middle']); ?>
    </div>
    <?php endif; ?>
    <?php if($page['preface_last']) : ?>
    <div class="column C">
      <?php print render ($page['preface_last']); ?>
    </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <?php print render($page['header']); ?>
  

  <section id="content" role="main">
    <?php if (theme_get_setting('breadcrumbs')): ?><?php if ($breadcrumb): ?><div id="breadcrumbs"><?php print $breadcrumb; ?></div><?php endif;?><?php endif; ?>
    <?php print $messages; ?>
    <?php if ($page['content_top']): ?><div id="content_top"><?php print render($page['content_top']); ?></div><?php endif; ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?><h1 class="page-title"><?php print $title; ?></h1><?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
    <?php print render($page['content']); ?>
  </section> <!-- /#main -->

  <?php if ($page['sidebar_first']): ?>
    <aside id="sidebar" role="complementary">
     <?php print render($page['sidebar_first']); ?>
    </aside> 
  <?php endif; ?>

  <div class="clear"></div>
  
  <?php print render($page['footer']); ?>

  <?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third']): ?>
  <div id="bottom-teaser" class="in<?php print (bool) $page['footer_first'] + (bool) $page['footer_second'] + (bool) $page['footer_third']; ?>">
      <?php if($page['footer_first']) : ?>
      <div class="column A">
        <?php print render ($page['footer_first']); ?>
      </div>
      <?php endif; ?>
      <?php if($page['footer_second']) : ?>
      <div class="column B">
        <?php print render ($page['footer_second']); ?>
      </div>
      <?php endif; ?>
      <?php if($page['footer_third']) : ?>
      <div class="column C">
        <?php print render ($page['footer_third']); ?>
      </div>
      <?php endif; ?>
      <div class="clear"></div>
  </div>

  <?php endif; ?>

  <div id="footer">
    <div id="copyright" class="footer-links">
      <?php print t('Copyright'); ?> &copy; <?php echo date("Y"); ?>, <a href="<?php print $front_page; ?>"><?php print $site_name; ?></a>
      |
      <span class="site-disclaimer footer-links"> <a class="ctools-use-modal ctools-modal-ctools-modal-entity-style" href="<?php echo $front_page; ?>?q=modal/node/nojs/6"> Disclaimer</a></span>
      |
      <span class="site-feedback footer-links"> <a class="ctools-use-modal ctools-modal-ctools-modal-entity-style" href="<?php echo $front_page; ?>?q=modal/node/nojs/6"> Feedback</a></span>
      <div class="footer-right"> Developed by <a href="http://gauravjeet.com" class="credits"> GJ</a></div>
    </div>
  </div>
</div>