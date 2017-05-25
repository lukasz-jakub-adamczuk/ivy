<?php
require_once AYA_DIR.'/Management/IndexView.php';

class NewsImageIndexView extends IndexView {

	protected function _getMassActions() {
		return MassActions::getStandardActions();
	}

	protected function _getFilters_() {
		$aFilters = array(
			'search' => array(
				'label' => 'Wyszukiwarka',
				'type' => 'text',
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

	public function defaultOrdering() {
		$this->_oCollection->navDefault('sort', 'id-news-image');
		$this->_oCollection->navDefault('order', 'desc');
	}

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Aktualności');
	}
}