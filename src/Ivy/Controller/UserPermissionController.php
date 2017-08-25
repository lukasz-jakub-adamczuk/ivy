<?php

namespace Ivy\Controller;

use Aya\Core\Dao;

class UserPermissionController extends FrontController {

	public function infoAction() {
		// $this->setTemplateName('user-permission-')
		// $this->setViewName('user-permission-index');
		// categories
		
	}

	public function promoteAction() {
		print_r($_POST);

		// $iId = 0;
		if (isset($_POST['id'])) {
			echo 'ok';
			// user group
			$iId = (int)strip_tags($_POST['id']);

			$oEntity = Dao::entity('user', $iId);
			$oEntity->setField('id_user_group', $_POST['dataset']['id_user_group']);

			$sName = $oEntity->getField('name');

			// user permissions
			// 

			if ($oEntity->update()) {
				// clear cache
				$aMsg['text'] = 'Prawa użytkownika <strong>'.$sName.'</strong> zostały nadane.';
				$aMsg['type'] = 'info';
				$this->actionForward('index', 'user', true);
			} else {
				$aMsg['text'] = 'Wystąpił nieoczekiwany wyjątek.';
				$aMsg['type'] = 'error';
				$this->actionForward('info', $this->_ctrlName);
			}
			$this->_renderer->assign('aMsgs', array($aMsg));
		}
	}
}