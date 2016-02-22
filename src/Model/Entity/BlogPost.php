<?php
namespace CakephpSpongeBlog\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlogPost Entity.
 */
class BlogPost extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'slug' => true,
        'summary' => true,
        'body' => true,
        'published' => true,
        'sticky' => true,
        'in_rss' => true,
        'meta_title' => true,
        'meta_description' => true,
        'meta_keywords' => true,
    ];
}
