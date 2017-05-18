<?php $this->assign('title', 'News | ' . $settings['Site']['title']); ?>
<?php $this->Paginator->options( [ 'url'=>[ 'sort'=>null, 'direction'=>null ] ] ) ?>
<h1>News</h1>

<?php if (!empty($blogPosts)) : ?>

<?php foreach ($blogPosts as $blogPost) : ?>

  <article<?php if ($blogPost->sticky) {echo ' class="sticky"';} ?>>
    <?php $link_url = $this->Url->build(
        [
            'controller' => 'blogPosts', 
            'action' => 'view', 
            'slug' => $blogPost->slug
        ]
    ); ?>
    <?php if (strtolower($settings['blog']['use_summary_or_body_on_post_index']) == 'summary') : ?>
    <a href="<?= $link_url ?>" rel="bookmark" title="<?= h($blogPost->title) ?>" class="blog-post-link">
    <?php endif ?>
    <?php
    $photo = $blogPost->photo;
    if($photo && $settings['blog']['display_image_on_post_index']) : 
    ?>
        <figure class="blog-index-figure">
        <?php
            echo $this->Html->image('/uploads/blogposts/photo/' . 
                $blogPost->photo_dir . 
                '/index_' . $photo, 
                [
                    'class' => 'blog-post-photo',
                    'alt' => $blogPost->photo_alt
                ]
            ); 
        ?>
        </figure>
    <?php endif ?>

    <header>
      <h2><?= h($blogPost->title) ?></h2>
      <time datetime="<?= $this->Time->format($blogPost->created, 'YYYY-MM-dd HH:mm:ssZ'); ?>">
          <?= $this->Time->format($blogPost->created,'d MMM YYYY'); ?>
      </time>
    </header>

    <?php if (strtolower($settings['blog']['use_summary_or_body_on_post_index']) == 'summary') : ?>
      <p class="summary"><?= $this->Text->autoParagraph(h($blogPost->summary)); ?></p>
      </a>
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