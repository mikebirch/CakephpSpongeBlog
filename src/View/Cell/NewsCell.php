<?php
namespace CakephpSpongeBlog\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

/**
 * News cell
 */
class NewsCell extends Cell
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
        $blogPosts = $this->BlogPosts->find('all')
            ->where([
                'BlogPosts.published' => true
            ])
            ->limit(2)
            ->order(['created' => 'desc']);
        $this->set('blogPosts', $blogPosts);
        $settings = Configure::read('settings');
        $this->set('settings', $settings);
    }
}
