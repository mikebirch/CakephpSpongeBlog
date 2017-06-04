<?php echo $this->Html->script('CakephpSpongeBlog.sb.min.js', ['block' => 'scriptBottom']); ?>
<div class="blogPosts form large-10 medium-9 columns">
    <?= $this->Form->create($blogPost, ['type' => 'file']); ?>
    <fieldset>
        <legend>Edit post</legend>
        <?php
            $myTemplates = [
                'inputContainer' => '<div class="input {{class}} {{type}}{{required}}">{{content}}</div>',
            ];
            $this->Form->templates($myTemplates);
            echo $this->Form->input('title');
            echo $this->Form->input('slug');
            echo $this->Form->input('summary');
            echo $this->Form->input('body', ['class' => 'froala']);
            if($settings['blog']['display_image_on_post']) {
                $photo = $blogPost->get('photo');
                if($photo){
            ?>
                    <div id="blog-post-photo"><?php echo $this->Html->image('/uploads/blogposts/photo/' . $blogPost->get('photo_dir') . '/index_' . $photo); ?></div>
            <?php
                    echo $this->Form->input('replace-photo', ['type' => 'checkbox', 'label' => 'Replace this photo']);
                    echo $this->Form->input('photo', ['type' => 'file', 'templateVars' => ['class' => 'blog-post-photo-input']]);
                } else {
                    echo $this->Form->input('photo', ['type' => 'file']);
                }
                echo $this->Form->input('photo_alt', ['label' => 'Short description of your photo']);
            }
            echo $this->Form->input('published');
            echo $this->Form->input('sticky');
            echo $this->Form->input('in_rss');
            echo $this->Form->input('meta_title');
            echo $this->Form->input('meta_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
