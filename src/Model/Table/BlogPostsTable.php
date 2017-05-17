<?php
namespace CakephpSpongeBlog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CakephpSpongeBlog\Model\Entity\BlogPost;
use Cake\Core\Configure;
use Cake\Event\Event;
use ArrayObject;

/**
 * BlogPosts Model
 *
 */
class BlogPostsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $settings = Configure::read('settings');
        $this->table('blog_posts');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Tools.Slugged', ['label' => 'title', 'unique' => true, 'case' => 'low']);
        $this->addBehavior('Proffer.Proffer', [
            'photo' => [
                'root' => $settings['blog']['image-directory'],
                'dir' => 'photo_dir',
                'thumbnailSizes' => [ 
                    'index' => ['w' => $settings['blog']['image-dimension-on-post-index'], 'h' => $settings['blog']['image-dimension-on-post-index'], 'fit' => true],  // used in index action and edit action
                    'view' => [ // used in view action
                        'jpeg_quality' => 75,
                        'custom' => 'resize', 
                        'params' => [
                            $settings['blog']['max-image-width'], // 2x max width of containing element: #blogposts article
                            null, 
                            function ($constraint) { 
                                $constraint->aspectRatio(); 
                                $constraint->upsize(); 
                            }
                        ]
                    ],
                ],
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');
            
        $validator
            ->allowEmpty('summary');
            
        $validator
            ->allowEmpty('body');

        $validator
            ->requirePresence('photo', 'create')
            ->allowEmpty('photo', 'update');
            
        $validator
            ->add('published', 'valid', ['rule' => 'boolean'])
            ->requirePresence('published', 'create')
            ->notEmpty('published');
            
        $validator
            ->add('sticky', 'valid', ['rule' => 'boolean'])
            ->requirePresence('sticky', 'create')
            ->notEmpty('sticky');
            
        $validator
            ->add('in_rss', 'valid', ['rule' => 'boolean'])
            ->requirePresence('in_rss', 'create')
            ->notEmpty('in_rss');
            
        $validator
            ->allowEmpty('meta_title');
            
        $validator
            ->allowEmpty('meta_description');
            
        $validator
            ->allowEmpty('meta_keywords');

        return $validator;
    }

    public function findSlugged(Query $query, array $options)
    {
        $query->where([
            'BlogPosts.slug' => $options['slug'],
            'BlogPosts.published' => true
        ]);
        return $query;
    }

    public function findLatest(Query $query, array $options)
    {
        $query->where([
            'BlogPosts.published' => true
        ])
        ->limit(2)
        ->order(['created' => 'desc']);
        return $query;
    }
}
