<?php
require_once APP_DIR.'/helpers/ChangeLog.php';

class FragmentController extends CrudController {

	public function postInsert($mId) {
		// game-info
		if ($_POST['dataset']['id_fragment_type'] == 3) {
			print_r($_POST['relations']);
		}
		// print_r($_POST['fragment']);
	}

	public function postUpdate($mId) {
		// game-info
		$aDataset = array();
		print_r($_POST['relations']);
		if ($_POST['dataset']['id_fragment_type'] == 3) {
			if (isset($_POST['fragment'])) {
				$aDataset['fragment'] = json_encode($_POST['fragment']);
			}
		}

		// 
		$aRelations = isset($_POST['relations']) ? $_POST['relations'] : null;

		if ($aRelations) {
			if (isset($aRelations['used'])) {

			}
			if (isset($aRelations['new'])) {
				
				foreach ($aRelations['new'] as $val) {
					// ...
					$oObjectFragmentEntity = Dao::entity('object-fragment', $val['id_object_fragment'], 'id_object_fragment');

					$oObjectFragmentEntity->setField('id_fragment', $mId);
					$oObjectFragmentEntity->setField('id_object', $val['id_object']);
					$oObjectFragmentEntity->setField('object', $val['object']);

					if ($oObjectFragmentEntity->insert(true)) {

					}
				}


			}
		}

		if (count($aDataset)) {
			$oEntity = Dao::entity($this->_ctrlName, $mId, 'id_'.$this->_ctrlName);
		
			$oEntity->setFields($aDataset);

			if ($oEntity->update()) {
		// 		ChangeLog::add('post-update', $this->_ctrlName, $mId);

		// 		// $this->actionForward('index', $this->_ctrlName, true);
			}
		}

	}

	public function logoImageAction() {
		$this->_imageFragment(1);
	}

	public function coverImageAction() {
		$this->_imageFragment(2);
	}

	public function systemAction() {
		$this->setTemplateName('fragments/game-info-system');
	}

	// private methods

	private function _imageFragment($iFragmentType) {
		$sPath = isset($_GET['path']) ? $_GET['path'] : '';

		$this->setTemplateName('image-fragment');

		$oFragmentCollection = Dao::collection('fragment');
		$oFragmentCollection->where('fragment.id_fragment_type', $iFragmentType);
		$oFragmentCollection->load(-1);

		$aImages = $oFragmentCollection->getRows();

		// print_r($aImages);

		$aSelectedImages = array();
		$sNeedle = str_replace(',', '/', $sPath);
		foreach ($aImages as $image) {
			if (strpos($image['fragment'], $sNeedle) !== false) {
				$aSelectedImages[] = $image;
			}
		}

		$this->_renderer->assign('sPath', $sPath);
		$this->_renderer->assign('aImages', $aImages);
		$this->_renderer->assign('aSelectedImages', $aSelectedImages);

		// get list of files
		// $sBasePath = SITE_DIR . '/pub';

		
	}
}