<?= $this->Form->create($blogPost, ['type' => 'file']); ?>
<fieldset>
    <legend>Add Post</legend>
    <?php
        echo $this->Form->control('title');
        echo $this->Form->control('summary');
        echo $this->Form->control('body', ['class' => 'froala']);
        if($settings['blog']['display_image_on_post']) {
            echo $this->Form->control('photo', ['type' => 'file']);
            echo $this->Form->control('photo_alt', ['label' => 'Short description of your photo']);
        }
        echo $this->Form->control('published');
        echo $this->Form->control('sticky');
        echo $this->Form->control('in_rss');
        echo $this->Form->control('meta_title');
        echo $this->Form->control('meta_description');
    ?>
</fieldset>
<?= $this->Form->button('Submit') ?>
<?= $this->Form->end() ?>
