<?php

App::uses('AppController', 'Controller');

/**
 * People Controller
 *
 * @property Person $Person
 */
class PeopleController extends AppController {

	public function setSearchOptions() {
		return array(
			'person_first_name' => __('Nama depan'),
			'person_last_name' => __('Nama belakang'),
			'person_downline' => __('Alamat'),
			'person_mobile_phone' => __('Ponsel'),
		);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->set('options', $this->setSearchOptions());
		$this->Person->recursive = 0;

		# if there's search
		$model = $this->modelClass;
		if (isset($this->params->query['q']) && ($this->params->query['c'] !== "")) {
			$data = $this->paginate($model, array(h($this->params->query['c']) . ' LIKE' => '%' . h($this->params->query['q']) . '%'));
		} else {
			$data = $this->paginate();
		}

		$this->set('people', $data);
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Person->id = $id;
		$person = $this->Person->read(null, $id);
		if (!$this->Person->exists()) {
			throw new NotFoundException(__('Invalid person'));
		}
		$this->set('person', $person);

		$model = 'BetDetail';
		if (isset($this->data[$model]['fdate']) && ($this->data[$model]['tdate'] !== "")) {
			$temp = $this->data[$model]['fdate'];
			$fdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$temp = $this->data[$model]['tdate'];
			$tdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$data = $this->paginate($model, array(
				'Bet.created_date >=' => $fdate,
				'Bet.created_date <=' => $tdate,
				'Person.id' => $id,
					));
		} else if (isset($this->params->query['fdate'])) {
			$params = $this->params->query;
			$data = $this->paginate($model, array(
				'Bet.created_date >=' => $params['fdate'],
				'Bet.created_date <=' => $params['tdate'],
				'Person.id' => $id,
					));
		} else {
			$data = $this->paginate('BetDetail', array('Person.id' => $id));
		}
		$this->set('betDetails', $data);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['People']['created_date'] = date('Y-m-d');
			$this->Person->create();
			if ($this->Person->save($this->request->data)) {
				$this->Session->setFlash(__('The person has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The person could not be saved. Please, try again.'));
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
		$this->Person->id = $id;
		if (!$this->Person->exists()) {
			throw new NotFoundException(__('Invalid person'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Person->save($this->request->data)) {
				$this->Session->setFlash(__('The person has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The person could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Person->read(null, $id);
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
		$this->Person->id = $id;
		if (!$this->Person->exists()) {
			throw new NotFoundException(__('Invalid person'));
		}
		if ($this->Person->delete()) {
			$this->Session->setFlash(__('Person deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Person was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
