<?php
require_once AYA_DIR.'/Management/InfoView.php';

class StoryCategoryInfoView extends InfoView {

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Kategoria (publicystyka)');

		// authors
		$oAuthors = Dao::collection('user');
		
		$this->_renderer->assign('aAuthors', $oAuthors->getAuthors());
	}
}