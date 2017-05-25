<?php
require_once AYA_DIR.'/Management/InfoView.php';

class CupInfoView extends InfoView {

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Zawodnik');
		// unset($_SESSION['_nav_']);

		$mId = isset($_GET['id']) ? $_GET['id'] : 0;
	}
}