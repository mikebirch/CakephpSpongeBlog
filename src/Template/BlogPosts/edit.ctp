<?php echo $this->Html->script('CakephpSpongeBlog.sb.min.js', ['block' => 'scriptBottom']); ?>
<?php $this->Form->setTemplates([
    'dateWidget' => '{{day}}{{month}}{{year}} &nbsp; {{hour}}{{minute}}{{meridian}}',
    'inputContainer' => '<div class="input {{class}} {{type}}{{required}}">{{content}}</div>'
]); ?>
<div class="blogPosts form large-10 medium-9 columns">
    <?= $this->Form->create($blogPost, ['type' => 'file']); ?>
    <fieldset>
        <legend>Edit post</legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('slug');
            echo $this->Form->control('summary');
            echo $this->Form->control('body', ['class' => 'froala']);
            if($settings['blog']['display_image_on_post']) {
                $photo = $blogPost->get('photo');
                if($photo){
            ?>
                    <div id="blog-post-photo"><?php echo $this->Html->image('/uploads/blogposts/photo/' . $blogPost->get('photo_dir') . '/index_' . $photo); ?></div>
            <?php
                    echo $this->Form->control('replace-photo', ['type' => 'checkbox', 'label' => 'Replace this photo']);
                    echo $this->Form->control('photo', ['type' => 'file', 'templateVars' => ['class' => 'blog-post-photo-input']]);
                } else {
                    echo $this->Form->control('photo', ['type' => 'file']);
                }
                echo $this->Form->control('photo_alt', ['label' => 'Short description of your photo']);
            }
            echo $this->Form->control('created', [
                'timeFormat' => 12
            ]);
            echo $this->Form->control('published');
            echo $this->Form->control('sticky');
            echo $this->Form->control('in_rss');
            echo $this->Form->control('meta_title');
            echo $this->Form->control('meta_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
