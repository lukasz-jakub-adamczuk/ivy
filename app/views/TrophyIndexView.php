<?php
require_once AYA_DIR.'/Management/IndexView.php';

class TrophyIndexView extends IndexView {

	protected function _getFilters() {
		$aFilters = array(
			'search' => array(
				'label' => 'Wyszukiwarka',
				'type' => 'text',
				'default' => '',
				'selected' => 'null'
			),
			'visible' => array(
				'label' => 'Widoczny',
				'type' => 'select',
				'options' => array('null' => '---', 0 => 'Nie', '1' => 'Tak'),
				'default' => '',
				'selected' => 'null'
			),
			'special' => array(
				'label' => 'Wyróżniony',
				'type' => 'select',
				'options' => array('null' => '---', '0' => 'Nie', '1' => 'Tak'),
				'default' => '',
				'selected' => 'null'
			)
		);
		return $aFilters;
	}

	// public function fill() {
		
	// }

	// protected function _runBeforeFill() {
		
	// }
}
