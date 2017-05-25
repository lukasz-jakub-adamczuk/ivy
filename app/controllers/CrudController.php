<?php
require_once APP_DIR.'/helpers/ChangeLog.php';
require_once APP_DIR.'/helpers/Utilities.php';

class CrudController extends FrontController {
	
	public function indexAction() {
		// lock handling
		if (isset($_SESSION['user'])) {
			if (isset($_SESSION['user']['lock'])) {
				if (Lock::exists($_SESSION['user']['lock']['name'], (int)$_SESSION['user']['lock']['id'])) {
					Lock::release($_SESSION['user']['lock']['name'], (int)$_SESSION['user']['lock']['id']);
				}
			}
		}

		// decide what to do with action
		if (isset($_POST['action'])) {
			$sAction = key($_POST['action']).'Action';

			// if (isset($_POST['ids'])) {
				$this->$sAction();
			// }
		}
	}
	
	public function infoAction() {
		// lock handling
		if (isset($_SESSION['user'])) {
			if (Lock::exists($this->_ctrlName, (int)$_GET['id'])) {
				$sLock = Lock::get($this->_ctrlName, (int)$_GET['id']);
				$aLockParts = explode(':', $sLock);
				if ($aLockParts[0] != $_SESSION['user']['id']) {
					$this->_renderer->assign('aLock', array('id' => $aLockParts[0], 'name' => $aLockParts[1]));
				}
			} else {
				Lock::set($this->_ctrlName, (int)$_GET['id'], $_SESSION['user']);
				$_SESSION['user']['lock'] = array('name' => $this->_ctrlName, 'id' => $_GET['id']);
				// Session::set('user.locks', array())
			}
		}
		// $_SESSION['user']['lock'] = array('name' => $this->_ctrlName, 'id' => $_GET['id']);
	}
	
	public function addAction() {
		if ($this->_renderer->templateExists($this->_ctrlName.'-info.tpl')) {
			$this->setTemplateName($this->_ctrlName.'-info');
		} else {
			$this->setTemplateName('all-info');
		}
		$this->setViewName(str_replace(' ', '', ucwords(str_replace('-', ' ', $this->_ctrlName.'-info'))));
	}
	
	public function insertAction() {
		$mId = 0;

		$aPost = $this->preInsert();

		$oEntity = Dao::entity($this->_ctrlName, $mId);

		// print_r($aPost['dataset']);
		
		$oEntity->setFields($aPost['dataset']);

		$aPossibleNameKeys = array('title', 'name');
		foreach ($aPossibleNameKeys as $key) {
			if (isset($aPost['dataset'][$key])) {
				$sName = $aPost['dataset'][$key];
				break;
			}
		}
		// print_r($aPost['dataset']);

		// slug by used name if empty or changed name
		if (isset($sName) && isset($aPost['dataset']['slug']) && (empty($aPost['dataset']['slug']) || $aPost['dataset']['slug'] != Utilities::slugify($sName))) {
			$oEntity->setField('slug', Utilities::slugify($sName));
		}

		// no creation date
		// TODO or creation date invalid
		if (isset($aPost['dataset']['creation_date']) && $aPost['dataset']['creation_date'] == '') {
			echo 'creation date is set here';
			$oEntity->setField('creation_date', date('Y-m-d H:i:s'));
		}
		// if mod_date comes somehow
		if (empty($aPost['dataset']['modification_date'])) {
			$oEntity->unsetField('modification_date');
		}
		
		if ($mId = $oEntity->insert(true)) {
			$this->postInsert($mId);
			// clear cache
			$sSqlCacheFile = TMP_DIR . '/sql/collection/'.$this->_ctrlName.'-'.$this->_sActionName.'';

			$this->raiseInfo('Wpis '.(isset($sName) ? '<strong>'.$sName.'</strong>' : '').' został utworzony.');

			ChangeLog::add('create', $this->_ctrlName, $mId);

			// $aStreamItem = $this->prepareStreamItem($mId, $aPost);
			// $this->addToStream($aStreamItem);

			$this->actionForward('index', $this->_ctrlName, true);
		} else {
			$this->raiseError('Wystąpił nieoczekiwany wyjątek.');
			$this->actionForward('info', $this->_ctrlName);
		}
	}
	
	public function updateAction() {
		// lock handling
		if (isset($_GET['id'])) {
			if (Lock::exists($this->_ctrlName, (int)$_GET['id'])) {
				$sLock = Lock::get($this->_ctrlName, (int)$_GET['id']);
				$aLockParts = explode(':', $sLock);
				if ($aLockParts[0] != $_SESSION['user']['id']) {
					$this->_renderer->assign('aLock', array('id' => $aLockParts[0], 'name' => $aLockParts[1]));
				}
			} else {
				Lock::set($this->_ctrlName, (int)$_GET['id'], $_SESSION['user']);
			}
		}

		$mButton = isset($_POST['button']) ? $_POST['button']: null;

		$mId = isset($_POST['id']) ? $_POST['id'] : 0;
		
		$oEntity = Dao::entity($this->_ctrlName, $mId, 'id_'.$this->_ctrlName);
		
		$oEntity->setFields($_POST['dataset']);

		$aPossibleNameKeys = array('title', 'name');
		foreach ($aPossibleNameKeys as $key) {
			if (isset($_POST['dataset'][$key])) {
				$sName = $_POST['dataset'][$key];
				break;
			}
		}

		// print_r($_POST['dataset']);

		// slug by used name if empty or changed name
		if (isset($_POST['dataset']['slug']) && (empty($_POST['dataset']['slug']) || $_POST['dataset']['slug'] != Utilities::slugify($sName))) {
			$oEntity->setField('slug', Utilities::slugify($sName));
		}

		if (isset($_POST['dataset']['modification_date'])) {
			if ($_POST['dataset']['modification_date'] == '') {
				$oEntity->setField('modification_date', date('Y-m-d H:i:s'));
			}
		}

		// depending on button pressed
		if ($mButton == 'publish') {
			$oEntity->setField('visible', 1);
		}
		// if ($mButton == 'unpublish') {
		// 	$oEntity->setField('visible', 0);
		// }
		if ($mButton == 'delete') {
			$oEntity->setField('deleted', 1);
		}
		if ($mButton == 'undelete') {
			$oEntity->setField('deleted', 0);
		}

		// $sConvertSqlFile = TMP_DIR.'/files.sql';
		// $sConvertSql = TMP_DIR.'/texts';
		$sConvertSql = TMP_DIR.'/casperjs';
		// if (!file_exists($sConvertSql)) {
		// 	mkdir($sConvertSql, 0777, true);
		// }

		// file_put_contents($sConvertSqlFile, $oEntity->getQuery().';'."\n\n");
		// echo $oEntity->getQuery();

		// normal select before update
		// file_put_contents($sConvertSql.'/'.$this->_ctrlName.'-'.$mId.'.sql', $oEntity->getQuery().';'."\n\n");

		
		if ($oEntity->update()) {
			// temporary
			if ($this->_ctrlName == 'article' || $this->_ctrlName == 'story') {
				file_put_contents($sConvertSql.'/'.$this->_ctrlName.'-'.$mId.'.sql', $oEntity->getQuery().';'."\n\n");
			}

			$sEditUrl = BASE_URL.'/'.$this->_ctrlName.'/'.$mId;
			if (isset($sName)) {
				$this->raiseInfo('Wpis '.(isset($sName) ? '<strong>'.$sName.'</strong>' : '').' został zmieniony. <a href="'.$sEditUrl.'">Edytuj</a> ponownie.');
			} else {
				$this->raiseInfo('Wpis został zmieniony. <a href="'.$sEditUrl.'">Edytuj</a> ponownie.');
			}

			ChangeLog::add('update', $this->_ctrlName, $mId);

			$this->postUpdate($mId);
			
			$this->actionForward('index', $this->_ctrlName, true);
		} else {
			$this->raiseError('Wystąpił nieoczekiwany wyjątek.');
			$this->actionForward('info', $this->_ctrlName);
		}
	}

	public function deleteAction() {
		if (isset($_GET['id'])) {
			$aIds = array($_GET['id']);
		}
		if (isset($_POST['ids'])) {
			$aIds = $_POST['ids'];
		}

		if (isset($aIds)) {
			$aNames = array();
			foreach ($aIds as $id) {
				$oEntity = Dao::entity($this->_ctrlName, $id, 'id_'.$this->_ctrlName);

				$aPossibleNameKeys = array('title', 'name');
				foreach ($aPossibleNameKeys as $key) {
					if ($oEntity->hasField($key)) {
						$sName = $oEntity->getField($key);
					} else {
						$sName = $id;
					}
				}

				$oEntity->setField('deleted', '1');
				
				if ($oEntity->update()) {
					ChangeLog::add('delete', $this->_ctrlName, $id);
					$aNames[] = $sName;
				}
			}

			// msg
			if (count($aNames) == 1) {
				$this->raiseInfo('Wpis <strong>'.$aNames[0].'</strong> został usunięty.');
			} elseif (count($aNames) > 1) {
				$this->raiseInfo('Wpisy <strong>'.implode(', ', $aNames).'</strong> zostały usunięte.');
			} else {
				$this->raiseError('Wystąpił nieoczekiwany wyjątek.');
			}

			// prevent endless loop
			if (!isset($_POST['ids'])) {
				$this->actionForward('index', $this->_ctrlName, true);
			}
		}
	}

	public function removeAction() {
		if (isset($_GET['id'])) {
			$aIds = array($_GET['id']);
		}
		if (isset($_POST['ids'])) {
			$aIds = $_POST['ids'];
		}
		
		if (isset($aIds)) {
			$aNames = array();
			foreach ($aIds as $id) {
				$oEntity = Dao::entity($this->_ctrlName, $id, 'id_'.$this->_ctrlName);

				$aPossibleNameKeys = array('title', 'name');
				foreach ($aPossibleNameKeys as $key) {
					if ($oEntity->hasField($key)) {
						$sName = $oEntity->getField($key);
					} else {
						$sName = $id;
					}
				}
				$this->preRemove($sName);
				
				if ($oEntity->delete()) {
					ChangeLog::add('remove', $this->_ctrlName, $id);
					$aNames[] = $sName;

					$this->postRemove($sName);
				}
			}

			// msg
			if (count($aNames) == 1) {
				$this->raiseInfo('Wpis <strong>'.$aNames[0].'</strong> został usunięty.');
			} elseif (count($aNames) > 1) {
				$this->raiseInfo('Wpisy <strong>'.implode(', ', $aNames).'</strong> zostały usunięte.');
			} else {
				$this->raiseError('Wystąpił nieoczekiwany wyjątek.');
			}
			
			// prevent endless loop
			if (!isset($_POST['ids'])) {
				$this->actionForward('index', $this->_ctrlName, true);
			}
		}
	}

	// action hooks

	public function preInsert() {
		return $_POST;
	}

	public function postInsert($mId) {}

	public function preUpdate() {}

	public function postUpdate($mId) {}

	public function preRemove($sName) {}

	public function postRemove($sName) {}

	public function fetchTemplateAction() {
		$sPath = isset($_GET['path']) ? str_replace(',', '/', strip_tags($_GET['path'])) : null;

		if ($sPath) {
			$this->setContentType('template');

			$this->setTemplateName($sPath);
		}
	}

	// private methods

	protected function _changeStatusField($sField, $mValue) {
		$mId = $_GET['id'];
		
		$oEntity = Dao::entity($this->_ctrlName, $mId, 'id_'.$this->_ctrlName);
		
		$oEntity->setField($sField, $mValue);

		$sName = $mId;
		$aPossibleNameKeys = array('title', 'name');
		foreach ($aPossibleNameKeys as $key) {
			if (isset($_POST['dataset'][$key])) {
				$sName = $_POST['dataset'][$key];
				break;
			}
		}
		
		if ($oEntity->update()) {
			// $this->postUpdate($mId);

			$sEditUrl = BASE_URL.'/'.$this->_ctrlName.'/'.$mId;
			if (isset($sName)) {
				$this->raiseInfo('Wpis '.(isset($sName) ? '<strong>'.$sName.'</strong>' : '').' został zmieniony. <a href="'.$sEditUrl.'">Edytuj</a> ponownie.');
			} else {
				$this->raiseInfo('Wpis został zmieniony. <a href="'.$sEditUrl.'">Edytuj</a> ponownie.');
			}

			ChangeLog::add('change', $this->_ctrlName, $mId);

			$this->postUpdate($mId);
			
			$this->actionForward('index', $this->_ctrlName, true);
		} else {
			$this->raiseError('Wystąpił nieoczekiwany wyjątek.');
			$this->actionForward('info', $this->_ctrlName);
		}
	}

	protected function _clearStreamCache($sStreamType = null) {
		$sStreamFile = CACHE_DIR . '/stream';

		// verify by file_exists()
		if (file_exists($sStreamFile)) {
			unlink($sStreamFile);
		}

		if ($sStreamType) {
			if (file_exists($sStreamFile.'-'.$sStreamType)) {
				unlink($sStreamFile.'-'.$sStreamType);
			}
		}
	}

	// shortcuts

	public function raiseInfo($sMessage) {
		$aMsg = array();
		$aMsg['text'] = $sMessage;
		$aMsg['type'] = 'info';
		MessageList::add($aMsg);
	}

	public function raiseWarning($sMessage) {
		$aMsg = array();
		$aMsg['text'] = $sMessage;
		$aMsg['type'] = 'warning';
		MessageList::add($aMsg);
	}

	public function raiseError($sMessage) {
		$aMsg = array();
		$aMsg['text'] = $sMessage;
		$aMsg['type'] = 'alert';
		MessageList::add($aMsg);
	}
}