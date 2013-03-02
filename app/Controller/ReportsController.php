<?php

App::uses('AppController', 'Controller');

/**
 * Bets Controller
 *
 * @property Bet $Bet
 */
class ReportsController extends AppController {

	public $paginate = array('limit' => '999');

	public function setSearchOptions() {
		return array(
			'home' => __('Klub 1'),
			'away' => __('Klub 2'),
			'handicap1' => __('Pur 1'),
			'handicap2' => __('Pur 2'),
			'loss1' => __('K 1'),
			'loss2' => __('K 2'),
		);
	}

	/* INDEX */

	public function index() {
		
	}

	/* PLAYER */

	public function bets() {
		$this->set('options', $this->setSearchOptions());
		$this->loadModel('BetDetail');
		$model = 'BetDetail';
		if (isset($this->params->data[$model]['fdate']) && isset($this->params->data[$model]['tdate'])) {
			$temp = $this->params->data[$model]['fdate'];
			$fdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$temp = $this->params->data[$model]['tdate'];
			$tdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$params = array('fdate' => $fdate, 'tdate' => $tdate);

//			$data = $this->BetDetail->find('all', array('conditions' => array(
//				'Bet.created_date >=' => $fdate,
//				'Bet.created_date <=' => $tdate,
//					)));
//					
			$data = $this->paginate($model, array(
				'Bet.created_date >=' => $fdate,
				'Bet.created_date <=' => $tdate,
					));
		} else if (isset($this->params->query['fdate'])) {
			$params = $this->params->query;
			$data = $this->paginate($model, array(
				'Bet.created_date >=' => $params['fdate'],
				'Bet.created_date <=' => $params['tdate'],
					));
		} else {
			#$data = $this->BetDetail->find('all', array('conditions' => array('Bet.created_date' => date('Y-m-d'))));
			$data = $this->paginate('BetDetail', array('Bet.created_date >=' => date('Y-m-d')));
			$params = "";
		}

		$this->loadModel('Club');
		foreach ($data as $idx => $dt) {
			$data[$idx]['Home'] = $this->Club->find('first', array('conditions' => array('Club.id' => $dt['Bet']['home'])));
		}
		
		$this->set('betDetails', $data);
		$this->set('params', $params);
	}

	/* GAMES */

	public function games() {
		$this->set('options', $this->setSearchOptions());
		$this->loadModel('Bet');
		$this->Bet->recursive = 0;
		$this->paginate = array('order' => 'Bet.created_date desc', 'conditions' => array('clear' => '1'));

		# if there's search
		$model = 'Bet';
		if (isset($this->params->data[$model]['fdate']) && isset($this->params->data[$model]['tdate'])) {
			$temp = $this->params->data[$model]['fdate'];
			$fdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$temp = $this->params->data[$model]['tdate'];
			$tdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$params = array('fdate' => $fdate, 'tdate' => $tdate);
			$data = $this->paginate($model, array(
				'Bet.created_date >=' => $fdate,
				'Bet.created_date <=' => $tdate,
					));
		} else if (isset($this->params->query['fdate'])) {
			$params = $this->params->query;
			$data = $this->paginate($model, array(
				'Bet.created_date >=' => $params['fdate'],
				'Bet.created_date <=' => $params['tdate'],
					));
		} else {
			$data = $this->paginate('Bet', array('Bet.created_date >=' => date('Y-m-d')));
			$params = "";
		}

		$this->set('bets', $data);
		$this->set('params', $params);
	}

	/* FAVOURITE CLUB */

	public function club() {
		$this->set('options', $this->setSearchOptions());
		$this->loadModel('Bet');
		$this->Bet->recursive = 1;
		$this->loadModel('Club');
		$clubs = $this->Club->find('list', array('order' => 'club_name asc', 'fields' => array('id', 'club_name')));

		# if there's search
		$model = 'Bet';
		if (isset($this->data[$model]['fdate']) && ($this->data[$model]['tdate'] !== "")) {
			$temp = $this->data[$model]['fdate'];
			$fdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$temp = $this->data[$model]['tdate'];
			$tdate = $temp['year'] . '-' . $temp['month'] . '-' . $temp['day'];
			$bets = $this->Bet->find('all', array(
				'conditions' => array('Bet.created_date >=' => $fdate . '00:00:00', 'Bet.created_date <=' => $tdate . '00:00:00', 'clear' => '1')
					));
		} else {
			$bets = $this->Bet->find('all', array(
				'conditions' => array('Bet.created_date LIKE' => date('Y-m-d') . '%', 'clear' => '1')
					));
		}

		foreach ($clubs as $idx => $club) {
			$clubs[$idx] = array('name' => $club, 'win' => 0, 'loss' => 0);
		}

		$twin = $tloss = 0;
		foreach ($bets as $idx => $bet) {
			if ($bet['BetDetail'] !== false) {
				foreach ($bet['BetDetail'] as $betDetail) {
					if ((strpos($betDetail['status'], 'Menang') !== false) AND !empty($betDetail['club_to_bet'])) {
						$clubs[$betDetail['club_to_bet']]['win'] += $betDetail['amount_of_bet'];
					} elseif ((strpos($betDetail['status'], 'Kalah') !== false) AND !empty($betDetail['club_to_bet'])) {
						$clubs[$betDetail['club_to_bet']]['loss'] += $betDetail['amount_of_bet'];
					}
				}
			}
		}
		$this->set('clubs', $clubs);
	}

}
