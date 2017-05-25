<?php

class AuthController extends FrontController {

	public function indexAction() {
		if (!isset($_SESSION['user'])) {
			Debug::show('unauthorized', 'user', 'warning');
			$this->setTemplateName('auth');
			Debug::show($this->_templateName, 'indexAction() in ' . $this->getCtrlName() . ' ctrl');
		} else {
			Debug::show('authorized', 'user', 'info');
		}	
	}

	public function runBeforeMethod() {}

	// public function runAfterMethod() {}

	public function loginAction() {
		Debug::show('login');

		// initial error message
		// changed when success
		$aMsg['text'] = 'Nieprawidłowe dane logowania.';
		$aMsg['type'] = 'warning';

		$this->setTemplateName('auth');

		if (isset($_POST['auth'])) {
			$sUser = isset($_POST['auth']['user']) ? $_POST['auth']['user'] : '';
			$sPass = isset($_POST['auth']['pass']) ? $_POST['auth']['pass'] : '';
			if (!empty($sUser) && !empty($sPass)) {
				// temporary block
				if ($sUser == 'Ashley Riot' || $sUser == 'Tantalus' || $sUser == 'aysnel') {

				$sql = 'SELECT u.*, ug.slug group_slug, ug.name group_name, up.*
						FROM user u
						LEFT JOIN user_group ug ON(ug.id_user_group=u.id_user_group)
						LEFT JOIN user_permission up ON(up.id_user=u.id_user)
						WHERE u.name="'.addslashes($sUser).'" AND u.hash="'.sha1(addslashes(strtolower($sUser)).addslashes($sPass)).'"';
				$oEntity = Dao::entity('user');
				$oEntity->query($sql);

				$oEntity->load();

				$aUser = $oEntity->getFields();

				if ($aUser) {
					$_SESSION['user']['id'] = $aUser['id_user'];
					$_SESSION['user']['name'] = $aUser['name'];
					$_SESSION['user']['slug'] = $aUser['slug'];
					$_SESSION['user']['active'] = $aUser['active'];
					$_SESSION['user']['group'] = isset($aUser['group_slug']) ? $aUser['group_slug'] : '';
					$_SESSION['user']['perm'] = isset($aUser['sz_perm']) ? $aUser['sz_perm'] : '';
					$_SESSION['user']['avatar'] = $aUser['avatar'];
					// print_r($aUser);

					// set user container after login
					User::set($_SESSION['user']);

					// User::can()

					$this->actionForward('index', 'home', true);

					$aMsg['text'] = 'Logowanie zakończone sukcesem.';
					$aMsg['type'] = 'info';
				}
				} else {
					$aMsg['text'] = 'Nie możesz sie logować.';
					$aMsg['type'] = 'warning';
				}
			}
		}
		$this->_renderer->assign('aMsgs', array($aMsg));
	}

	public function logoutAction() {
		Debug::show('logoutAction()');

		if (isset($_SESSION['user'])) {
			// $this->_renderer->display('login.tpl');
			unset($_SESSION['user']);
			User::reset();
		}
			// die();
			$this->setTemplateName('auth');
			Debug::show($this->_templateName, 'logoutAction() in ' . $this->getCtrlName() . ' ctrl');
			$this->actionForward('logout', 'home', true);
		// }
	}
}