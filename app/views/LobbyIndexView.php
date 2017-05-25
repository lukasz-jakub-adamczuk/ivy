<?php
require_once AYA_DIR.'/Management/IndexView.php';

class LobbyIndexView extends IndexView {

	protected function _getSections() {
		$aSections = array(
			'article' => array(
				'name' => 'Artykuły',
			),
			'story' => array(
				'name' => 'Publicystyka',
			)
		);
		return $aSections;
	}

	protected function _getMassActions() {
		return MassActions::getStandardActions();
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
		$this->_renderer->assign('sHeader', 'Poczekalnia');

		// categories
		$oCategories = Dao::collection('article_category');
		$oCategories->orderby('name');
		$oCategories->load(-1);

		// authors
		$oAuthors = Dao::collection('user');
		$oAuthors->orderby('name');
		$oAuthors->load(-1);

		$aFilterValues = array();
		$aFilterValues['id_article_category'] = $oCategories->getColumn();
		$aFilterValues['id_author'] = $oAuthors->getColumn();
		$aFilterValues['id_author'] = $oAuthors->getAuthors();
		$this->_renderer->assign('aFilterValues', $aFilterValues);
	}
}
