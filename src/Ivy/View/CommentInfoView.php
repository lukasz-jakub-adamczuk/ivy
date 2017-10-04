<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

class CommentInfoView extends InfoView {

    public function afterFill() {
        $this->_renderer->assign('header', 'Komentarz');

        $this->_renderer->assign('sFormMainPartTemplate', 'forms/comment-info-main.tpl');
        $this->_renderer->assign('sFormSubPartTemplate', 'forms/comment-info-sub.tpl');

        $this->_renderer->assign('sCommentType', 'id_'.str_replace('-', '_', $_GET['ctrl']));

        // authors
        $oAuthors = Dao::collection('user');
        $this->_renderer->assign('authors', $oAuthors->getAuthors());
    }
}