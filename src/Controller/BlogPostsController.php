<?php
namespace CakephpSpongeBlog\Controller;

use CakephpSpongeBlog\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Chronos\Chronos;

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
        $settings = Configure::read('settings');
        $this->paginate = [
            'conditions' => ['BlogPosts.published' => true],
            'limit' => $settings['blog']['number_posts_on_post_index'],
            'order' => ['sticky' => 'desc', 'created' => 'desc']
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

    public function archive($year, $month=null)
    {
        if ($month == null) { // show news for year selected
            $date = $year;
            $time_year = Chronos::create()->year($year);
            $conditions = [
                'created >=' => $time_year->startOfYear(),
                'created <=' => $time_year->endOfYear()
            ];
        } else { // show news for month selected
            $date = date('F, Y', strtotime($year . '-' . $month . '-01'));
            $time_month = Chronos::create()->year($year)->month($month);
            $conditions = [
                'created >=' => $time_month->startOfMonth(),
                'created <=' => $time_month->endOfMonth()
            ];
        }
        
        $settings = Configure::read('settings');
        $this->paginate = [
            'conditions' => $conditions,
            'limit' => $settings['blog']['number_posts_on_post_index'],
            'order' => ['sticky' => 'desc', 'created' => 'desc']
        ];
        $this->set('blogPosts', $this->paginate($this->BlogPosts));
        $this->set('archiveDate', $date);
		$this->render('index');      
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
        $settings = Configure::read('settings');
        $this->set(compact('blogPost', 'settings'));
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
        $settings = Configure::read('settings');
        $this->set(compact('blogPost', 'settings'));
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
