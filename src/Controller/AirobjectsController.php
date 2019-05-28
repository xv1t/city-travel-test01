<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Airobjects Controller
 *
 * @property \App\Model\Table\AirobjectsTable $Airobjects
 *
 * @method \App\Model\Entity\Airobject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AirobjectsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $airobjects = $this->paginate($this->Airobjects);

        $this->set(compact('airobjects'));
    }

    /**
     * View method
     *
     * @param string|null $id Airobject id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $airobject = $this->Airobjects->get($id, [
            'contain' => []
        ]);

        $this->set('airobject', $airobject);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $airobject = $this->Airobjects->newEntity();
        if ($this->request->is('post')) {
            $airobject = $this->Airobjects->patchEntity($airobject, $this->request->getData());
            if ($this->Airobjects->save($airobject)) {
                $this->Flash->success(__('The airobject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airobject could not be saved. Please, try again.'));
        }
        $this->set(compact('airobject'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Airobject id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $airobject = $this->Airobjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $airobject = $this->Airobjects->patchEntity($airobject, $this->request->getData());
            if ($this->Airobjects->save($airobject)) {
                $this->Flash->success(__('The airobject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airobject could not be saved. Please, try again.'));
        }
        $this->set(compact('airobject'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Airobject id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $airobject = $this->Airobjects->get($id);
        if ($this->Airobjects->delete($airobject)) {
            $this->Flash->success(__('The airobject has been deleted.'));
        } else {
            $this->Flash->error(__('The airobject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
