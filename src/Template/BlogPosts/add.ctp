<?= $this->Form->create($blogPost) ?>
<fieldset>
    <legend>Add Post</legend>
    <?php
        echo $this->Form->input('title');
        echo $this->Form->input('summary');
        echo $this->Form->input('body');
        echo $this->Form->input('published');
        echo $this->Form->input('sticky');
        echo $this->Form->input('in_rss');
        echo $this->Form->input('meta_title');
        echo $this->Form->input('meta_description');
        echo $this->Form->input('meta_keywords');
    ?>
</fieldset>
<?= $this->Form->button('Submit') ?>
<?= $this->Form->end() ?>

