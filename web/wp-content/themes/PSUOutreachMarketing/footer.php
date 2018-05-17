<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package outreach-psu
 */

?>
      <?php custom_breadcrumbs('breadcrumbs-footer','breadcrumbs','&rsaquo;'); ?>
    </div> <!-- #content -->
  </div> <!-- #page -->

	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="foot-container">
          <?php if (is_active_sidebar('footer-contact-info')) : ?>
            <?php dynamic_sidebar('footer-contact-info'); ?>
          <?php endif; ?>
          <div class="footer-navigation">
          <div class="nav-column" id="nav-column-one">
          <?php if (is_active_sidebar('footer-nav-col-1')) : ?>
            <?php dynamic_sidebar('footer-nav-col-1'); ?>
          <?php endif; ?>
        </div>
          <div class="nav-column" id="nav-column-two">
          <?php if (is_active_sidebar('footer-nav-col-2')) : ?>

            <?php dynamic_sidebar('footer-nav-col-2'); ?>
          <?php endif; ?>
        </div>
          <div class="nav-column" id="nav-column-three">
          <?php if (is_active_sidebar('footer-nav-col-3')) : ?>

            <?php dynamic_sidebar('footer-nav-col-3'); ?>
          <?php endif; ?>
        </div>
        </div>
		</div>
      </footer> <!-- #colophon -->
  <div id="legal-footer">
        <div class="legal-container">
          <div id="foot-logo">
            <a href="http://www.psu.edu" title="Penn State"><img src="<?php echo get_template_directory_uri(); ?>/images/psu-mark.png" alt="Penn State" /></a>
          </div>
          <div class="legal-text">
            <p class="marketing-statement"><span class="web-statement">This site is a product of Penn State Outreach and Online Education Marketing.</span><br />
            <span class="web-questions">Website questions:</span> <a href="mailto:webInfo@outreach.psu.edu?subject=<?php echo rawurlencode(get_bloginfo('name', 'raw' ) . ' Web Question'); ?>">WebInfo@outreach.psu.edu</a>
            </p>
            <p class="copyright"><a href="http://www.outreach.psu.edu/accessibility/" target="_self" title="Accessibility">Accessibility</a>
            |
            <a href="http://www.psu.edu/ur/legal.html" target="_self" title="Privacy and Legal Statements">Privacy and Legal Statements</a>
            |
            <a href="http://www.psu.edu/ur/copyright.html" target="_self" title="Copyright">Copyright <?php echo date('Y') ?></a>
            | <a href="http://www.psu.edu" target="_self" title="The Pennsylvania State University">The Pennsylvania State University</a>
          </div> <!-- .legal-text -->
        </div> <!-- .legal-container -->
      </div> <!-- #legal-footer -->

<?php wp_footer(); ?>

</body>
</html>
