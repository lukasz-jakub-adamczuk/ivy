<?php
require_once APP_DIR.'/helpers/ChangeLog.php';

class NewsImageController extends CrudController {

	// $this->setTemplateName('image-fragment');

	public function infoAction() {
		$sPath = isset($_GET['path']) ? $_GET['path'] : '';

		$this->_renderer->assign('sPath', $sPath);
	}

	public function postRemove($sName) {
		$sFile = SITE_DIR . $sName;
		if (file_exists($sFile)) {
			unlink($sFile);

			ChangeLog::add('unlink', $this->_ctrlName, $sName);
		}
	}
}