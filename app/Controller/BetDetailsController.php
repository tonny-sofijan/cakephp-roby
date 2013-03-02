<?php

App::uses('AppController', 'Controller');

/**
 * BetDetails Controller
 *
 * @property BetDetail $BetDetail
 */
class BetDetailsController extends AppController {
	
	public function ou_options() {
		return array(
			'0' => 'Under',
			'1' => 'Over',
		);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->BetDetail->recursive = 0;
		$this->set('betDetails', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->BetDetail->id = $id;
		if (!$this->BetDetail->exists()) {
			throw new NotFoundException(__('Invalid bet detail'));
		}
		$this->set('betDetail', $this->BetDetail->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add($bet_id) {
		if ($this->request->is('post')) {
			$this->BetDetail->create();
			$this->request->data['BetDetail']['bet_id'] = $bet_id;
			if ($this->BetDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The bet detail has been saved'));
				$this->redirect(array('controller' => 'bets', 'action' => 'view', $bet_id));
			} else {
				$this->Session->setFlash(__('The bet detail could not be saved. Please, try again.'));
			}
		}

		$pp = $this->BetDetail->Person->find('all', array('recursive' => -1, 'order' => 'person_first_name asc'));
		$people = array();
		foreach ($pp as $person) {
			$people[$person['Person']['id']] = $person['Person']['person_first_name'] . ' ' . $person['Person']['person_last_name'];
		}
		unset($pp);

		$bet = $this->BetDetail->Bet->find('first', array('recursive' => -1, 'conditions' => array('id' => $bet_id)));
		$this->loadModel('Club');
		$home = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['home'])));
		$away = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['away'])));
		$clubToBet = array(
			key($home) => $home[key($home)],
			key($away) => $away[key($away)],
		);
		unset($bet, $home, $away);

		$this->set(compact('clubToBet', 'people'));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add_ou($bet_id) {
		$this->set('options', $this->ou_options());
		if ($this->request->is('post')) {
			$this->BetDetail->create();
			$this->request->data['BetDetail']['bet_id'] = $bet_id;
			if ($this->BetDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The bet detail has been saved'));
				$this->redirect(array('controller' => 'bets', 'action' => 'view', $bet_id));
			} else {
				$this->Session->setFlash(__('The bet detail could not be saved. Please, try again.'));
			}
		}

		$pp = $this->BetDetail->Person->find('all', array('recursive' => -1, 'order' => 'person_first_name asc'));
		$people = array();
		foreach ($pp as $person) {
			$people[$person['Person']['id']] = $person['Person']['person_first_name'] . ' ' . $person['Person']['person_last_name'];
		}
		unset($pp);

		$bet = $this->BetDetail->Bet->find('first', array('recursive' => -1, 'conditions' => array('id' => $bet_id)));
		$this->loadModel('Club');
		$home = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['home'])));
		$away = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['away'])));
		$clubToBet = array(
			key($home) => $home[key($home)],
			key($away) => $away[key($away)],
		);
		unset($bet, $home, $away);

		$this->set(compact('clubToBet', 'people'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->BetDetail->id = $id;
		$betDetail = $this->BetDetail->read(null, $id);
		if (!$this->BetDetail->exists()) {
			throw new NotFoundException(__('Invalid bet detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BetDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The bet detail has been saved'));
				$this->redirect(array('controller' => 'bets', 'action' => 'view', $betDetail['BetDetail']['bet_id']));
			} else {
				$this->Session->setFlash(__('The bet detail could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $betDetail;
		}

		$pp = $this->BetDetail->Person->find('all', array('recursive' => -1, 'order' => 'person_first_name asc'));
		$people = array();
		foreach ($pp as $person) {
			$people[$person['Person']['id']] = $person['Person']['person_first_name'] . ' ' . $person['Person']['person_last_name'];
		}
		unset($pp);

		$bet = $this->BetDetail->Bet->find('first', array('recursive' => -1, 'conditions' => array('id' => $betDetail['BetDetail']['bet_id'])));
		$this->loadModel('Club');
		$home = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['home'])));
		$away = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['away'])));
		$clubToBet = array(
			key($home) => $home[key($home)],
			key($away) => $away[key($away)],
		);
		unset($bet, $home, $away);

		$this->set(compact('clubToBet', 'people'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit_ou($id = null) {
		$this->set('options', $this->ou_options());
		$this->BetDetail->id = $id;
		$betDetail = $this->BetDetail->read(null, $id);
		if (!$this->BetDetail->exists()) {
			throw new NotFoundException(__('Invalid bet detail'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BetDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The bet detail has been saved'));
				$this->redirect(array('controller' => 'bets', 'action' => 'view', $betDetail['BetDetail']['bet_id']));
			} else {
				$this->Session->setFlash(__('The bet detail could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $betDetail;
		}

		$pp = $this->BetDetail->Person->find('all', array('recursive' => -1, 'order' => 'person_first_name asc'));
		$people = array();
		foreach ($pp as $person) {
			$people[$person['Person']['id']] = $person['Person']['person_first_name'] . ' ' . $person['Person']['person_last_name'];
		}
		unset($pp);

		$bet = $this->BetDetail->Bet->find('first', array('recursive' => -1, 'conditions' => array('id' => $betDetail['BetDetail']['bet_id'])));
		$this->loadModel('Club');
		$home = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['home'])));
		$away = $this->Club->find('list', array('fields' => array('id', 'club_name'), 'conditions' => array('id' => $bet['Bet']['away'])));
		$clubToBet = array(
			key($home) => $home[key($home)],
			key($away) => $away[key($away)],
		);
		unset($bet, $home, $away);

		$this->set(compact('clubToBet', 'people'));
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
		$this->BetDetail->id = $id;
		if (!$this->BetDetail->exists()) {
			throw new NotFoundException(__('Invalid bet detail'));
		}
		$betDetail = $this->BetDetail->read();
		if ($this->BetDetail->delete()) {
			$this->Session->setFlash(__('Bet detail deleted'));
			$this->redirect(array('controller' => 'bets', 'action' => 'view', $betDetail['Bet']['id']));
		}
		$this->Session->setFlash(__('Bet detail was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
