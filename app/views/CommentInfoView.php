<?php
require_once AYA_DIR.'/Management/InfoView.php';

class CommentInfoView extends InfoView {

	public function afterFill() {
		$this->_renderer->assign('sHeader', 'Komentarz');

		$this->_renderer->assign('sFormMainPartTemplate', 'forms/comment-info-main.tpl');
		$this->_renderer->assign('sFormSubPartTemplate', 'forms/comment-info-sub.tpl');

		$this->_renderer->assign('sCommentType', 'id_'.str_replace('-', '_', $_GET['ctrl']));

		// authors
		$oAuthors = Dao::collection('user');
		$this->_renderer->assign('aAuthors', $oAuthors->getAuthors());
	}
}