<article class="blog-view">
    <?php
        $photo = $blogPost->photo;
        if($photo && $settings['blog']['display_image_on_post_view']){
            echo $this->Html->image('/uploads/blogposts/photo/' . 
                $blogPost->photo_dir . 
                '/view_' . $photo, [
                    'class' => 'blog-post-photo',
                    'alt' => $blogPost->photo_alt
                ]
            ); 
        }
    ?>
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