<?php

class CommentController extends CrudController {

	public function indexAction() {
		$this->setTemplateName('comments-list');
	}

	public function acceptAction() {
		$this->_changeStatusField('visible', 1);
	}
}