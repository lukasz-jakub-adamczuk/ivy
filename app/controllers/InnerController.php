<?php
// require_once APP_DIR.'/helpers/ImageFragment.php';
// require_once APP_DIR.'/helpers/StreamManager.php';

class InnerController extends FrontController {

	public function getTemplateAction() {
		$this->_sContentType = 'template';

		$templateName = isset($_GET['name']) ? $_GET['name'] : null;

		$sFileName = TPL_DIR.THEME_DIR.DS.$templateName.'.tpl';

		if (file_exists($sFileName)) {
			$this->setTemplateName($templateName);
		}
	}

	
}