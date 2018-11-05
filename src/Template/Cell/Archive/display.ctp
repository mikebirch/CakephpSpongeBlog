<div id="archivelinks">	
	<h2>News Archives</h2>
	<ul id="archive">
        <?php $curr_year = ''; ?>
<?php foreach ($archives as $archive) : ?>
    <?php if ($curr_year != $archive->year) : ?>
        <?php if ($curr_year != '') : ?>
        </ul>
            </li>
        <?php endif; ?>
        <li>
            <?php  echo $this->Html->link($archive->year, array('plugin'=>'CakephpSpongeBlog', 'controller'=>'BlogPosts',  'action'=>'archive', $archive->year)); ?>
        <ul>
    <?php endif; ?>
        <li>
        <?php echo $this->Html->link($archive->fullmonth.'  ('.$archive->total_posts.')', array('plugin'=>'CakephpSpongeBlog', 'controller'=>'BlogPosts',  'action'=>'archive', $archive->year ,$archive->month )); ?>
            </li>
        <?php $curr_year = $archive->year; ?>
<?php endforeach; ?>
        </ul>
	</li>
</ul>
</div>
