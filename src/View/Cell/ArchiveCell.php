<?php
namespace CakephpSpongeBlog\View\Cell;

use Cake\View\Cell;

/**
 * Archive cell
 */
class ArchiveCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->loadModel('CakephpSpongeBlog.BlogPosts');
        $archives = $this->BlogPosts->find('archive');
        $this->set('archives', $archives);
    }
}
