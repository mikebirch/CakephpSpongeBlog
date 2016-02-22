<article class="blog-view">

  <header class="blog-header">
    <h1 class="blog-title"><?= h($blogPost->title) ?></h1>
    <time datetime="<?= $this->Time->format($blogPost->created, 'YYYY-MM-dd HH:mm:ssZ'); ?>">
        <?= $this->Time->format($blogPost->created,'d MMM YYYY'); ?>
    </time>
  </header>
  <div class="blog-body">
  <?= $blogPost->body ?>
  </div>

</article>




<?php
$this->assign('title', $blogPost->meta_title);
$this->set('metaDescription', h($blogPost->meta_description));
?>

<!-- 
<div class="blogPosts view large-10 medium-9 columns">
    <h2><?= h($blogPost->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($blogPost->title) ?></p>
            <h6 class="subheader"><?= __('Slug') ?></h6>
            <p><?= h($blogPost->slug) ?></p>
            <h6 class="subheader"><?= __('Meta Title') ?></h6>
            <p><?= h($blogPost->meta_title) ?></p>
            <h6 class="subheader"><?= __('Meta Description') ?></h6>
            <p><?= h($blogPost->meta_description) ?></p>
            <h6 class="subheader"><?= __('Meta Keywords') ?></h6>
            <p><?= h($blogPost->meta_keywords) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($blogPost->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($blogPost->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($blogPost->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Published') ?></h6>
            <p><?= $blogPost->published ? __('Yes') : __('No'); ?></p>
            <h6 class="subheader"><?= __('Sticky') ?></h6>
            <p><?= $blogPost->sticky ? __('Yes') : __('No'); ?></p>
            <h6 class="subheader"><?= __('In Rss') ?></h6>
            <p><?= $blogPost->in_rss ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Summary') ?></h6>
            <?= $this->Text->autoParagraph(h($blogPost->summary)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Body') ?></h6>
            <?= $this->Text->autoParagraph(h($blogPost->body)) ?>
        </div>
    </div>
</div>
 -->