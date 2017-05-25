<?php
// require_once APP_DIR.'/helpers/ImageFragment.php';
// require_once APP_DIR.'/helpers/StreamManager.php';

class MainController extends FrontController {

	public function getTemplateAction() {
		$this->_contentType = 'template';

		echo 'template';

		$templateName = isset($_GET['name']) ? $_GET['name'] : null;

		if ($templateName) {
			echo $templateName;
		}
		// trying to fetch and display template
		// $this->getTemplateAction();
		// echo 'action';
	}

	
}