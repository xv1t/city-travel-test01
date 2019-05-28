<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Route Controller
 *
 * @property \App\Model\Table\RouteTable $Route
 * @property \App\Model\Table\AirobjectsTable $Airobjects
 *
 * @method \App\Model\Entity\Route[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RouteController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $route = $this->paginate($this->Route);

        $this->set(compact('route'));
    }

    /**
     * View method
     *
     * @param string|null $id Route id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $route = $this->Route->get($id, [
            'contain' => []
        ]);

        $this->set('route', $route);
    }

    public function checkAirObject($code)
    {
        $this->loadModel('Airobjects');
        return ($this->Airobjects->exists(['code' => $code]));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $route = $this->Route->newEntity();
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $this->response->type('json');

            $data = [
                'status' => 'error',
                'message' => 'Unknown error',
                'request' => $this->request->getData()
            ];

            if (!$this->checkAirObject($this->request->data('from'))) {
                $data['message'] = 'Введенный код [from] не корректный';
                $this->response->body(json_encode($data));
                return $this->response;
            }

            if (!$this->checkAirObject($this->request->data('to'))) {
                $data['message'] = 'Введенный код [to] не корректный';
                $this->response->body(json_encode($data));
                return $this->response;
            }

            $route = $this->Route->patchEntity($route, $this->request->getData());
            
            if ($this->Route->save($route)) {
                $data['status'] = 'success';
                $this->response->body(json_encode($data));
                return $this->response;
            }
            $this->response->body(json_encode($data));
            return $this->response;
            
        }

        if ($this->request->is('post')) {
            $route = $this->Route->patchEntity($route, $this->request->getData());
            if ($this->Route->save($route)) {
                $this->Flash->success(__('The route has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The route could not be saved. Please, try again.'));
        }
        $this->set(compact('route'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Route id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $route = $this->Route->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $route = $this->Route->patchEntity($route, $this->request->getData());
            if ($this->Route->save($route)) {
                $this->Flash->success(__('The route has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The route could not be saved. Please, try again.'));
        }
        $this->set(compact('route'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Route id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $route = $this->Route->get($id);
        if ($this->Route->delete($route)) {
            $this->Flash->success(__('The route has been deleted.'));
        } else {
            $this->Flash->error(__('The route could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Search data from ajax
     * 
     */
    public function search()
    {
        $data = [];
        if ($this->request->is('ajax')) {
            $term = $this->request->query('term');
            $this->loadModel('Airobjects');
            $data = $this->Airobjects
                ->find('all')
                ->where([
                    'OR' => [                        
                        "code LIKE" => $term . '%', 
                        "city_name LIKE" => $term . '%', 
                        "airport_name LIKE" => $term . '%', 
                    ],
                    'AND' => [
                        "code <> \"\"" 
                    ]
                ]
                )
                ->limit(10)
                ->order('code')
                ->toArray();  
        }
        $this->response->type('json');
        $this->response->body(json_encode($data));
        return $this->response;
    }

    /**
     * Task 1 method
     * 
     */
    public function task1()
    {

        $route = $this->Route->newEntity();

        $sql = \file_get_contents(APP . '../config/schema/select1.sql');
        $data = ConnectionManager::get('default')
            ->query($sql)
            ->fetchAll();

        $this->set(compact('data', 'route', 'data2'));

       
    }
}
