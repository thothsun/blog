<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

</div><!-- end .row -->
</div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    <?php _e('<a href = "http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=21011202000327">辽公网安备 21011202000327号</a>'); ?>
    <?php _e('|'); ?>
    <?php _e('冀ICP备16021363号-4'); ?>
    <?php _e('|'); ?>
    &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('All rights reserved.'); ?>
    <br/>
    <?php _e('Powered by <a href="http://www.typecho.org">Typecho</a>'); ?>.
    <?php _e('Theme by <a href="https://github.com/Sun-Shuai/blog">SunShuai</a>'); ?>.


</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>