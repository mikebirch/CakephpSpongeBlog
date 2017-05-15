<?php $this->assign('title', 'News | ' . $settings['Site']['title']); ?>
<?php $this->Paginator->options( [ 'url'=>[ 'sort'=>null, 'direction'=>null ] ] ) ?>
<h1>News</h1>

<?php if (!empty($blogPosts)) : ?>

<?php foreach ($blogPosts as $blogPost) : ?>

  <article<?php if ($blogPost->sticky) {echo ' class="sticky"';} ?>>

    <header>
      <h2><?= $this->Html->link(h($blogPost->title), ['controller' => 'blogPosts', 'action' => 'view', 'slug' => $blogPost->slug], ['title' => h($blogPost->title), 'rel' => 'bookmark']); ?></h2>
      <time datetime="<?= $this->Time->format($blogPost->created, 'YYYY-MM-dd HH:mm:ssZ'); ?>">
          <?= $this->Time->format($blogPost->created,'d MMM YYYY'); ?>
      </time>
    </header>

    <?php if (strtolower($settings['blog']['use_summary_or_body_on_post_index']) == 'summary') : ?>
      <p class="summary"><?= $this->Text->autoParagraph(h($blogPost->summary)); ?></p>
    <?php else : ?>
      <div class="post">
        <?= $blogPost->body; ?>
      </div>
    <?php endif; ?>

  </article>

<?php endforeach; ?>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
</div>

<?php else : ?>

<p><?= 'Sorry, there are no news articles.' ?></p>

<?php endif; ?>