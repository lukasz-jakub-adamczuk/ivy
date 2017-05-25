<?php

class LobbyController extends CrudController {

	// public function addAction() {
	// 	$this->setTemplateName('lobby-info');
	// 	// $this->_actionForward('')
	// 	$this->setViewName('LobbyInfo');
	// }

	public function approveAction() {
		$iId = $_POST['id_object'];

		$sDaoName = $_POST['object'];

		// if ($iId) {
			$oEntity = Dao::entity($sDaoName, $iId, 'id_'.$sDaoName);
		
			$oEntity->setFields($_POST['dataset']);


		// }

		if ($oEntity->update()) {
			$sEditUrl = BASE_URL.'/'.$this->_ctrlName.'/'.$iId;
			$aMsg['text'] = 'Wpis <strong>'.$sTitle.'</strong> został zmieniony. <a href="'.$sEditUrl.'">Edytuj</a> ponownie.';
			$aMsg['type'] = 'info';

			// $this->addHistoryLog('update', $this->_ctrlName, $iId);

			// $aStreamItem = $this->prepareStreamItem($iId, $_POST);
			// $this->addToStream($aStreamItem);
			
			$this->actionForward('index', $this->_ctrlName, true);
		} else {
			$aMsg['text'] = 'Wystąpił nieoczekiwany wyjątek.';
			$aMsg['type'] = 'error';
			$this->actionForward('info', $this->_ctrlName);
		}
		$this->_renderer->assign('aMsgs', array($aMsg));
	}

	public function updateAction() {
		$iId = $_POST['id'];
		
		$oEntity = Dao::entity($this->_ctrlName, $iId, 'id_'.$this->_ctrlName);
		
		$oEntity->setFields($_POST['dataset']);

		if (isset($_POST['dataset']['title'])) {
			$oEntity->setField('slug', $this->slugify($_POST['dataset']['title']));
		}

		// no creation date
		// TODO or creation date invalid
		if (!isset($_POST['dataset']['creation_date'])) {
			// $oEntity->setField('creation_date', date('Y-m-d H:i:s'));
		}

		if (isset($_POST['dataset']['modification_date'])) {
			if ($_POST['dataset']['modification_date'] == '') {
				$oEntity->setField('modification_date', date('Y-m-d H:i:s'));
			}
		}

		// old title for message
		$sTitle = isset($_POST['dataset']['title']) ? $_POST['dataset']['title'] : '';

		// echo $sSqlCacheFile = TMP_DIR . '/sql/collection/'.$this->_ctrlName.'-'.$this->_sActionName.'';
		
		if ($oEntity->update()) {
			$sEditUrl = BASE_URL.'/'.$this->_ctrlName.'/'.$iId;
			$aMsg['text'] = 'Wpis <strong>'.$sTitle.'</strong> został zmieniony. <a href="'.$sEditUrl.'">Edytuj</a> ponownie.';
			$aMsg['type'] = 'info';

			$this->addHistoryLog('update', $this->_ctrlName, $iId);

			$aStreamItem = $this->prepareStreamItem($iId, $_POST);
			$this->addToStream($aStreamItem);
			
			$this->actionForward('index', $this->_ctrlName, true);
		} else {
			$aMsg['text'] = 'Wystąpił nieoczekiwany wyjątek.';
			$aMsg['type'] = 'error';
			$this->actionForward('info', $this->_ctrlName);
		}
		$this->_renderer->assign('aMsgs', array($aMsg));
	}
}