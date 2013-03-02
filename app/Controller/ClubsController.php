<?php

App::uses('AppController', 'Controller');

/**
 * Clubs Controller
 *
 * @property Club $Club
 */
class ClubsController extends AppController {

	public function setSearchOptions() {
		return array(
			'club_name' => __('Nama klub'),
			'league' => __('Liga'),
			'created_date' => __('Tgl terdaftar'),
		);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->set('options', $this->setSearchOptions());
		$this->Club->recursive = 0;
		
		# if there's search
		$model = $this->modelClass;
		if (isset($this->params->query['q']) && ($this->params->query['c'] !== "")) {
			$data = $this->paginate($model, array(h($this->params->query['c']) . ' LIKE' => '%' . h($this->params->query['q']) . '%'));
		} else {
			$data = $this->paginate();
		}
		
//		# if there's search
//		$model = $this->modelClass;
//		if (isset($this->data[$model]['q']) && ($this->data[$model]['c'] !== "")) {
//			#$this->Paginator->options(array('url' => $this->url));
//			$data = $this->paginate($model, array(h($this->data[$model]['c']) . ' LIKE' => '%' . h($this->data[$model]['q']) . '%'));
//		} else {
//			$data = $this->paginate();
//		}

		$this->set('clubs', $data);
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Club->id = $id;
		if (!$this->Club->exists()) {
			throw new NotFoundException(__('Invalid club'));
		}
		$this->set('club', $this->Club->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Club->create();
			$this->request->data['Club']['created_date'] = date('Y-m-d H:i:s');
			
			if ($this->Club->save($this->request->data)) {
				$this->Session->setFlash(__('The club has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Club->id = $id;
		if (!$this->Club->exists()) {
			throw new NotFoundException(__('Invalid club'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Club->save($this->request->data)) {
				$this->Session->setFlash(__('The club has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Club->read(null, $id);
		}
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Club->id = $id;
		if (!$this->Club->exists()) {
			throw new NotFoundException(__('Invalid club'));
		}
		if ($this->Club->delete()) {
			$this->Session->setFlash(__('Club deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Club was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
