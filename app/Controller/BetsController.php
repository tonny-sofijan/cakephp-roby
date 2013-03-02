<?php

App::uses('AppController', 'Controller');

/**
 * Bets Controller
 *
 * @property Bet $Bet
 */
class BetsController extends AppController {

	public $components = array('RequestHandler');
	public $helpers = array('Text');

	public function setSearchOptions() {
		return array(
			'Home.club_name' => __('Home'),
			'Away.club_name' => __('Away'),
			'handicap1' => __('Pur 1'),
			'handicap2' => __('Pur 2'),
			'loss1' => __('K 1'),
			'loss2' => __('K 2'),
		);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		if ($this->RequestHandler->isRss()) {
			$bets = $this->Bet->find('all', array('limit' => 3, 'order' => 'Bet.created_date DESC'));
			return $this->set(compact('bets'));
		}
		$this->set('options', $this->setSearchOptions());
		$this->Bet->recursive = 1;
		$this->paginate = array('order' => 'Bet.created_date asc');

		# if there's search
		$model = $this->modelClass;
		if (isset($this->params->query['q']) && ($this->params->query['c'] !== "")) {
			$data = $this->paginate($model, array(h($this->params->query['c']) . ' LIKE' => '%' . h($this->params->query['q']) . '%'));
		} else {
			$data = $this->paginate($model, array("clear='0'"));
		}

		$this->set('bets', $data);
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Bet->id = $id;
		$this->Bet->recursive = 2;
		if (!$this->Bet->exists()) {
			throw new NotFoundException(__('Invalid bet'));
		}
		$bet = $this->Bet->read(null, $id);

		$this->set(compact('bet'));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bet->create();
			$this->request->data['Bet']['clear'] = '0';
			$this->request->data['Bet']['created_date'] = date('Y-m-d H:i:s');
			if ($this->Bet->save($this->request->data)) {
				$this->Session->setFlash(__('The bet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bet could not be saved. Please, try again.'));
			}
		}

		$this->loadModel('Club');
		$clubs = $this->Club->find('list', array('fields' => array('id', 'club_name')));
		$this->set(compact('clubs'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Bet->id = $id;
		if (!$this->Bet->exists()) {
			throw new NotFoundException(__('Invalid bet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Bet->save($this->request->data)) {
				$this->Session->setFlash(__('The bet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bet could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Bet->read(null, $id);
		}

		$this->loadModel('Club');
		$clubs = $this->Club->find('list', array('fields' => array('id', 'club_name')));
		$this->set(compact('clubs'));
	}

	/**
	 * clear_bet method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function clear($id = null) {
		$this->Bet->id = $id;
		if (!$this->Bet->exists()) {
			throw new NotFoundException(__('Invalid bet'));
		}
		$this->Bet->set(array('clear' => '1'));
		$this->Bet->save();
		$this->redirect(array('action' => 'index'));
	}

	public function unclear($id = null) {
		$this->Bet->id = $id;
		$this->Bet->set(array('clear' => '0'));
		$this->Bet->save();
		$this->redirect(array('controller' => 'reports', 'action' => 'games'));
	}

	public function settling($bet) {
		foreach ($bet['BetDetail'] as $idx => $betDetail) {
			$tax = 10;

			# win and loss:
			# if result is settled
			if ((isset($bet['Bet']['result1'])) AND (isset($bet['Bet']['result2']))) {
				# people that bet on home, if win:
				if ($bet['Bet']['home'] == $betDetail['club_to_bet']) {
					# result1 (goal1) + handicap1
					$tgol1 = $bet['Bet']['result1'] + $bet['Bet']['handicap1'];
					$tgol2 = $bet['Bet']['result2'] + $bet['Bet']['handicap2'];
					$result = $tgol1 - $tgol2;
					if ($result == 0) {
						# draw
						$bet['BetDetail'][$idx]['status'] = 'Seri';
						$bet['BetDetail'][$idx]['win_loss'] = 0;
					} elseif ($result > 0) {
						# win 1/2
						if ($result == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Menang 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['loss2'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + ((($bet['Bet']['loss2'] - $tax) / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['loss2'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# win full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Menang';

							# loss (K) factor
							if (isset($bet['Bet']['loss2']) && ($bet['Bet']['loss2'] > 5)) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + ((($bet['Bet']['loss2'] - $tax) / 100) * $betDetail['amount_of_bet']);
							} else { // if (!isset($bet['Bet']['loss2'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
							}
						}
					} else {
						# loss 1/2
						if (abs($result) == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Kalah 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['loss1'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + (($bet['Bet']['loss1'] / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['loss1'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# loss full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Kalah';

							# loss (K) factor
							if (isset($bet['Bet']['loss1'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + (($bet['Bet']['loss1'] / 100) * $betDetail['amount_of_bet']);
							} elseif (!isset($bet['Bet']['loss1'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
							}
						}
					} # endif betting on Home club
				} elseif ($bet['Bet']['away'] == $betDetail['club_to_bet']) { # betting on Away club
					# result2 (goal2) + handicap2
					$tgol1 = $bet['Bet']['result1'] + $bet['Bet']['handicap1'];
					$tgol2 = $bet['Bet']['result2'] + $bet['Bet']['handicap2'];
					$result = $tgol2 - $tgol1;
					if ($result == 0) {
						# draw
						$bet['BetDetail'][$idx]['status'] = 'Seri';
						$bet['BetDetail'][$idx]['win_loss'] = 0;
					} elseif ($result > 0) {
						# win 1/2
						if ($result == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Menang 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['loss1'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + ((($bet['Bet']['loss1'] - $tax) / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['loss1'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# win full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Menang';

							# loss (K) factor
							if (isset($bet['Bet']['loss1']) && ($bet['Bet']['loss2'] > 5)) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + ((($bet['Bet']['loss1'] - $tax) / 100) * $betDetail['amount_of_bet']);
							} else { //if (!isset($bet['Bet']['loss1'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
							}
						}
					} else {
						# loss 1/2
						if (abs($result) == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Kalah 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['loss2'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + (($bet['Bet']['loss2'] / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['loss2'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# loss full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Kalah';

							# loss (K) factor
							if (isset($bet['Bet']['loss2'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + (($bet['Bet']['loss2'] / 100) * $betDetail['amount_of_bet']);
							} elseif (!isset($bet['Bet']['loss2'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
							}
						}
					} # endif betting on away club
				} elseif ($betDetail['ou_bet'] == '0') { # betting under
					$tgol = $bet['Bet']['result1'] + $bet['Bet']['result2'];
					$result = $tgol - $bet['Bet']['over_under'];
					if ($result == 0) {
						# draw
						$bet['BetDetail'][$idx]['status'] = 'Seri';
						$bet['BetDetail'][$idx]['win_loss'] = 0;
					} elseif ($result < 0) {
						# win 1/2
						if (abs($result) == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Menang 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['ou_over_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + ((($bet['Bet']['ou_over_loss'] - $tax) / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['ou_over_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# win full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Menang';

							# loss (K) factor
//							if (isset($bet['Bet']['ou_over_loss'])) {
//								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + ((($bet['Bet']['ou_over_loss'] - $tax) / 100) * $betDetail['amount_of_bet']);
//							} elseif (!isset($bet['Bet']['ou_over_loss'])) {
//								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
//							}
							$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
						}
					} else {
						# loss 1/2
						if ($result == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Kalah 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['ou_under_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + (($bet['Bet']['ou_under_loss'] / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['ou_under_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# loss full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Kalah';

							# loss (K) factor
							if (isset($bet['Bet']['ou_under_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + (($bet['Bet']['ou_under_loss'] / 100) * $betDetail['amount_of_bet']);
							} elseif (!isset($bet['Bet']['ou_under_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
							}
						}
					}
					# end betting on under
				} elseif ($betDetail['ou_bet'] == '1') { # betting over
					$tgol = $bet['Bet']['result1'] + $bet['Bet']['result2'];
					$result = $tgol - $bet['Bet']['over_under'];
					if ($result == 0) {
						# draw
						$bet['BetDetail'][$idx]['status'] = 'Seri';
						$bet['BetDetail'][$idx]['win_loss'] = 0;
					} elseif ($result > 0) {
						# win 1/2
						if ($result == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Menang 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['ou_under_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + ((($bet['Bet']['ou_under_loss'] - $tax) / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['ou_under_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# win full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Menang';

							# loss (K) factor
//							if (isset($bet['Bet']['ou_under_loss'])) {
//								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + ((($bet['Bet']['ou_under_loss'] - $tax) / 100) * $betDetail['amount_of_bet']);
//							} elseif (!isset($bet['Bet']['ou_under_loss'])) {
//								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
//							}
							$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
						}
					} else {
						# loss 1/2
						if (abs($result) == 0.25) {
							$bet['BetDetail'][$idx]['status'] = 'Kalah 1/2';

							# loss (K) factor
							if (isset($bet['Bet']['ou_over_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = (0.5 * $betDetail['amount_of_bet']) + (($bet['Bet']['ou_over_loss'] / 100) * (0.5 * $betDetail['amount_of_bet']));
							} elseif (!isset($bet['Bet']['ou_over_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = 0.5 * $betDetail['amount_of_bet'];
							}
							# loss full
						} else {
							$bet['BetDetail'][$idx]['status'] = 'Kalah';

							# loss (K) factor
							if (isset($bet['Bet']['ou_over_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'] + (($bet['Bet']['ou_over_loss'] / 100) * $betDetail['amount_of_bet']);
							} elseif (!isset($bet['Bet']['ou_over_loss'])) {
								$bet['BetDetail'][$idx]['win_loss'] = $betDetail['amount_of_bet'];
							}
						}
					}
					# end betting on over/under
				}
			}
		}
		return $bet;
	}

	/**
	 * goal method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function goal($id = null) {
		$this->Bet->id = $id;
		if (!$this->Bet->exists()) {
			throw new NotFoundException(__('Invalid bet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Bet->save($this->request->data)) {
				# update our player win-loss data
				$bet = $this->Bet->read(null, $id);
				# settling
				$bet = $this->settling($bet);

				#pr($bet['BetDetail']);exit();
				$this->Bet->BetDetail->saveAll($bet['BetDetail']);

				$this->Session->setFlash(__('The bet has been saved'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The bet could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Bet->read(null, $id);
		}

		$this->loadModel('Club');
		$clubs = $this->Club->find('list', array('fields' => array('id', 'club_name')));
		$this->set(compact('clubs'));
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
		$this->Bet->id = $id;
		if (!$this->Bet->exists()) {
			throw new NotFoundException(__('Invalid bet'));
		}
		if ($this->Bet->delete()) {
			$this->Bet->BetDetail->delete();
			$this->Session->setFlash(__('Bet deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Bet was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
