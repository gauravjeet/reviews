<header id="header">
  <hgroup id="logo">
    <h1 class="logo-font"><a href="<?php print $front_page; ?>" title="<?php print $site_name; ?>"><?php print $site_name; ?></a></h1>
    <div class="site-slogan"><?php print $site_slogan; ?></div>
  </hgroup>
  <nav id="navigation" role="navigation">
  </nav>
</header>

<div class="container">
  <section id="content" class="content-404" role="main">
    <?php if (theme_get_setting('breadcrumbs')): ?><?php if ($breadcrumb): ?><div id="breadcrumbs"><?php print $breadcrumb; ?></div><?php endif;?><?php endif; ?>
    <?php print $messages; ?>
    <?php if ($page['content_top']): ?><div id="content_top"><?php print render($page['content_top']); ?></div><?php endif; ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?><h1 class="page-title-404"><?php print '404'; ?></h1><?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
    <div class="error-404-text">PAGE NOT FOUND</div>
    <div class="error-404-desc">So Sorry, couldn't find the page you were looking for.</div>
    <div><a class="error-404" href="<?php print $front_page; ?>">Go to <?php print $site_name; ?></a></div>
  </section>

  <div class="clear"></div>

  <div id="footer" class="footer-404">
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