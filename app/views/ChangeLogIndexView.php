<?php
require_once AYA_DIR.'/Management/IndexView.php';

class ChangeLogIndexView extends IndexView {

	protected function _getMassActions() {
		return false;
	}

	protected function _getRelatedActions() {
		return false;
	}

	protected function _getFilters() {
		$aFilters = array(
			'search' => array(
				'label' => 'Wyszukiwarka',
				'type' => 'text',
				'default' => '',
				'selected' => 'null'
			),
			'id_category' => array(
				'label' => 'Kategoria',
				'type' => 'select',
				'options' => array('null' => '---'),
				'default' => '',
				'selected' => 'null'
			),
			'id_author' => array(
				'label' => 'Autor',
				'type' => 'select',
				'options' => array('null' => '---'),
				'default' => '',
				'selected' => 'null'
			)
		);
		return $aFilters;
	}

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Historia zmian');

		// categories
		$oCategories = Dao::collection('article-category');
		$oCategories->orderby('name');
		$oCategories->load(-1);

		// authors
		$oAuthors = Dao::collection('user');
		// $oAuthors->leftJoin('user_permission', 'id_user')
		$oAuthors->orderby('name');
		$oAuthors->load(-1);

		$aFilterValues = array();
		$aFilterValues['id_article_category'] = $oCategories->getColumn();
		$aFilterValues['id_author'] = $oAuthors->getColumn();
		$this->_renderer->assign('aFilterValues', $aFilterValues);
	}
}
