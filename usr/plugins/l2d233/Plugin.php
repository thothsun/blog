<?php

/**
 * 2233娘的live2d看板娘插件(typecho)，支持换人换装！
 *
 * @package l2d233
 * @author Jrotty，suns
 * @version 1.4.0
 * @link https://ai-developer.net
 */
class l2d233_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {

        Typecho_Plugin::factory('Widget_Archive')->footer = array('l2d233_Plugin', 'footer');

    }

    /* 禁用插件方法 */
    public static function deactivate()
    {
    }

    public static function config(Typecho_Widget_Helper_Form $form)
    {
        echo '<p>本插件需要加载jQuery库与Font Awesome支持，如果你的主题没有引用上述项目，请选择加载。<br />关于提示语的修改，请直接编辑js/waifu-tips.js。</p>';
        $l2dst = new Typecho_Widget_Helper_Form_Element_Checkbox('l2dst', array(
            'jq' => _t('配置是否加载JQ：勾选则加载不勾选则不加载'), 'awesome' => _t('Font Awesome：勾选则加载不勾选则不加载'),
        ),
            array('jq', 'awesome'), _t('基本设置'));
        $form->addInput($l2dst);

    }


    public static function footer()
    {
        if (!self::isMobile()) {
            $options = Helper::options()->plugin('l2d233');
            echo '<div class="l2d_xb">';
            if (!empty(Helper::options()->plugin('l2d233')->l2dst) && in_array('awesome', Helper::options()->plugin('l2d233')->l2dst)) {
                echo '<link rel="stylesheet" href="' . Helper::options()->pluginUrl . '/l2d233/live2d/font-awesome.min.css" type="text/css">';
            }
            echo '<link rel="stylesheet" href="' . Helper::options()->pluginUrl . '/l2d233/live2d/waifu.css" type="text/css">';
            echo '
    <div class="waifu">
        <div class="waifu-tips"></div>
        <canvas id="live2d" class="live2d"></canvas>
        <div class="waifu-tool">
             <span class="fui-home"></span>
             <span class="fui-chat"></span>
             <span class="fui-eye"></span>
             <span class="fui-user"></span>
             <span class="fui-photo"></span>
             <span class="fui-info-circle"></span>
             <span class="fui-cross"></span>
        </div>
    </div>
             ';


            if (!empty(Helper::options()->plugin('l2d233')->l2dst) && in_array('jq', Helper::options()->plugin('l2d233')->l2dst)) {
                echo '<script  src="' . Helper::options()->pluginUrl . '/l2d233/live2d/jquery.min.js?v=2.1.4"></script>' . "\n";
            }
            echo '<script>var l2d = {"xb":"' . Helper::options()->pluginUrl . '/l2d233"};</script>';
            echo '<script  src="' . Helper::options()->pluginUrl . '/l2d233/live2d/live2d.js?v=r3"></script><script  src="' . Helper::options()->pluginUrl . '/l2d233/live2d/waifu-tips.js?v=1.1"></script>  </div>' . "\n";
            echo '<script  type="text/javascript">
                    live2d_settings[\'modelId\'] = 1;                  // 默认模型 ID
                    live2d_settings[\'modelTexturesId\'] = 53;          // 默认材质 ID
	                /* 在 initModel 前添加 */
	                initModel("' . Helper::options()->pluginUrl . '/l2d233/live2d/waifu-tips.json")
                  </script> </div>' . "\n";

        }
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 移动设备识别
     *
     * @return boolean
     */
    private static function isMobile()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_browser = Array(
            "mqqbrowser", // 手机QQ浏览器
            "opera mobi", // 手机opera
            "juc", "iuc", 'ucbrowser', // uc浏览器
            "fennec", "ios", "applewebKit/420", "applewebkit/525", "applewebkit/532", "ipad", "iphone", "ipaq", "ipod",
            "iemobile", "windows ce", // windows phone
            "240x320", "480x640", "acer", "android", "anywhereyougo.com", "asus", "audio", "blackberry",
            "blazer", "coolpad", "dopod", "etouch", "hitachi", "htc", "huawei", "jbrowser", "lenovo",
            "lg", "lg-", "lge-", "lge", "mobi", "moto", "nokia", "phone", "samsung", "sony",
            "symbian", "tablet", "tianyu", "wap", "xda", "xde", "zte"
        );
        $is_mobile = false;
        foreach ($mobile_browser as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }
}