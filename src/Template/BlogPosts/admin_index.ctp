<h1>News</h1>

<p><?php echo $this->Html->link('New post', array('action' => 'add'), array('class' => 'btn button')); ?></p>

<table cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th class="actions">&nbsp;</th>
        <th><?= $this->Paginator->sort('title') ?></th>
        <th><?= $this->Paginator->sort('published') ?></th>
        <th><?= $this->Paginator->sort('sticky') ?></th>
    </tr>
</thead>
<tbody>
<?php foreach ($blogPosts as $blogPost): ?>
    <tr>
        <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $blogPost->slug]) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blogPost->id]) ?>
            
            <?= $this->Delete->createForm(['action' => 'delete', $blogPost->id]) ?>
        </td>
        <td><?= h($blogPost->title) ?></td>
        <td><?= h($blogPost->published) == 1 ? 'Yes' : 'No' ?></td>
        <td><?= h($blogPost->sticky) == 1 ? 'Yes' : 'No' ?></td>
    </tr>

<?php endforeach; ?>
</tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
</div>

