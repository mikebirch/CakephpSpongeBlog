<?php
namespace CakephpSpongeBlog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CakephpSpongeBlog\Model\Entity\BlogPost;

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
        $this->table('blog_posts');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Tools.Slugged', ['label' => 'title', 'unique' => true, 'case' => 'low']);
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

    public function findPublished(Query $query, array $options)
    {
        return $this->find()
        ->where([
            'BlogPosts.published' => true
        ]);
    }

    public function findLatest(Query $query, array $options)
    {
/*        return $this->find()
        ->where([
            'BlogPosts.published' => true
        ])*/
        

        $query->where([
            'BlogPosts.published' => true
        ])
        ->limit(2)
        ->order(['created' => 'desc']);
        return $query;
    }
}
