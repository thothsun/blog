<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>


    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <p>
                    <textarea style="background-color:#F5F5F5;resize:none" rows="4" cols="50" name="text"
                              placeholder="想对作者说点什么..." id="textarea" class="textarea"
                              required><?php $this->remember('text'); ?></textarea>
                </p>
                <?php if ($this->user->hasLogin()): ?>
                    <p><?php _e('已登录: '); ?><a
                                href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>.
                        <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
                    </p>
                <?php else: ?>
                    <p>
                        <label for="author"><?php _e('怎么称呼您：'); ?></label>
                        <input style="background-color:#F5F5F5" type="text" name="author" id="author" class="text"
                               value="<?php $this->remember('author'); ?>" required/>
                    </p>
                <?php endif; ?>
                <p align="right">
                    <button type="submit" class="submit"><?php _e('发表'); ?></button>
                </p>
            </form>
        </div>
    <?php else: ?>
    <?php endif; ?>


    <?php if ($comments->have()): ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>

        <?php $comments->listComments(); ?>

        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <?php endif; ?>
</div>
