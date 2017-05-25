<?php
require_once AYA_DIR.'/Management/InfoView.php';

class LobbyInfoView extends InfoView {

	public function afterFill() {
		// authors
		$oAuthors = Dao::collection('user');
		
		$this->_renderer->assign('aAuthors', $oAuthors->getAuthors());

		// categories
		$oCategories = Dao::collection('article-category');
		$oCategories->orderby('name');
		$oCategories->load(-1);

		$this->_renderer->assign('aCategories', $oCategories->getRows());

		// templates
	}
}