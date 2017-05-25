<?php
require_once AYA_DIR.'/Management/IndexView.php';

class CupIndexView extends IndexView {

	public function defaultOrdering() {
		$this->_oCollection->navDefault('sort', 'creation-date');
		$this->_oCollection->navDefault('order', 'desc');

		$this->_oCollection->navSet('sort', 'id_cup');
	}

	// protected function _getMassActions() {
	// 	return MassActions::getStandardActions();
	// }

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Mistrzostwa');
	}
}
