<?php
namespace CakephpSpongeBlog\Controller;

use CakephpSpongeBlog\Controller\AppController;
use Cake\Event\Event;

/**
 * BlogPosts Controller
 *
 * @property \App\Model\Table\BlogPostsTable $BlogPosts
 */
class BlogPostsController extends AppController
{

    public $paginate = [
        'limit' => 10,
        'order' => [
            'BlogPosts.created' => 'desc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
    }
    
    public function isAuthorized($user = null)
    {
        $action = $this->request->params['action'];

        if (in_array($action, ['add'])) {
            return (bool)($user['role'] === 'admin');
        }

        return parent::isAuthorized($user);
    }

    public function adminIndex()
    {
        $this->set('blogPosts', $this->paginate($this->BlogPosts));
        $this->viewBuilder()->layout('admin');
    }

    public function index()
    {
        $this->paginate = [
            'finder' => 'published'
        ];
        $this->set('blogPosts', $this->paginate($this->BlogPosts));
    }

    public function latest()
    {   
        $latestPosts = $this->BlogPosts->find('latest');
        if ($this->request->is('requested')) {
            $this->response->body($latestPosts);
            return $this->response;
        }
    }

    /**
     * View method
     *
     * @param string|null $id Blog Post id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $blogPost = $this->BlogPosts->find('slugged', ['slug' => $slug])->firstOrFail();;
        $this->set('blogPost', $blogPost);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blogPost = $this->BlogPosts->newEntity();
        if ($this->request->is('post')) {
            $blogPost = $this->BlogPosts->patchEntity($blogPost, $this->request->data);
            if ($this->BlogPosts->save($blogPost)) {
                $this->Flash->success(__('The blog post has been saved.'));
                return $this->redirect(['action' => 'admin_index']);
            } else {
                $this->Flash->error(__('The blog post could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('blogPost'));
        $this->viewBuilder()->layout('admin');
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog Post id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blogPost = $this->BlogPosts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blogPost = $this->BlogPosts->patchEntity($blogPost, $this->request->data);
            if ($this->BlogPosts->save($blogPost)) {
                $this->Flash->success(__('The blog post has been saved.'));
                return $this->redirect(['action' => 'admin_index']);
            } else {
                $this->Flash->error(__('The blog post could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('blogPost'));
        $this->viewBuilder()->layout('admin');
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog Post id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blogPost = $this->BlogPosts->get($id);
        if ($this->BlogPosts->delete($blogPost)) {
            $this->Flash->success(__('The blog post has been deleted.'));
        } else {
            $this->Flash->error(__('The blog post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'admin_index']);
    }
}
