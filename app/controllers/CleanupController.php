<?php
// require_once AYA_DIR.'/ManageCrudController.php';

class CleanupController extends CrudController {

	public function indexAction() {
		$this->setTemplateName('all-list');
	}
}