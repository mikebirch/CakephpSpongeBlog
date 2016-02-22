<div class="blogPosts form large-10 medium-9 columns">
    <?= $this->Form->create($blogPost) ?>
    <fieldset>
        <legend>Edit post</legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('slug');
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
