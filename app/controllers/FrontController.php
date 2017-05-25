<?php
require_once AYA_DIR.'/Core/Controller.php';

class FrontController extends Controller {

	protected function _afterInit() {
		// auth or not ?
		if (AUTH_MODE) {
			// if (isset($_SESSION['user'])) {
			if (User::set()) {
				$this->actionForward('index', 'auth');
			} else {
				$this->actionForward('index', 'auth', true);
			}
		}
	}

	public function runBeforeMethod() {
		// navigation
		$this->_renderer->assign('aNavigation', NavigationManager::getNavigation());

		// Breadcrumbs::add('', 'squarezone.pl', 'icon-home');
		$aItem = array(
			'name' => 'ctrl',
			'url' => $this->getCtrlName(),
			'text' => $this->getCtrlName(),
		);
		Breadcrumbs::add($aItem);

		// $this->_renderer->assign('ctrl', $this->getCtrlName());
		// $this->_renderer->assign('act', $this->getActionName());

		PostmanNotification::analyzeFeeds();

		$this->_renderer->assign('aCounters', PostmanNotification::getFeedsCounters());
		$this->_renderer->assign('iTotal', PostmanNotification::getFeedsTotal());

		// comments
		CommentsNotifier::analyzeComments();

		$this->_renderer->assign('iAllComments', CommentsNotifier::getCommentsTotal());
	}
	
	// TODO should name init()
	public function runAfterMethod() {
		parent::runAfterMethod();

		if (isset($_SESSION['user'])) {
			$this->_renderer->assign('user', $_SESSION['user']);
		}

		$this->_renderer->assign('aBreadcrumbs', Breadcrumbs::get());
		
		// vars in templates
		$this->_renderer->assign('base', BASE_URL);
		if (defined('SITE_URL')) {
			$this->_renderer->assign('site', SITE_URL);
		}
	}
	
	public function indexAction() {}

	public function infoAction() {}

	// action to set special params in session
	public function setAction() {
		if (DEBUG_MODE) {
			if (isset($_GET['param']) && isset($_GET['value'])) {
				$_SESSION['_params_'][strip_tags($_GET['param'])] = strip_tags($_GET['value']);
			}
		}
	}

	// action to reset/remove special params in session
	public function resetAction() {
		if (DEBUG_MODE) {
			if (isset($_SESSION['_params_'][strip_tags($_GET['param'])])) {
				unset($_SESSION['_params_'][strip_tags($_GET['param'])]);
			}
		}
	}
}