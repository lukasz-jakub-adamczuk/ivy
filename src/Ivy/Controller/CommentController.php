<?php

namespace Ivy\Controller;

use Ivy\Helper\CommentManager;

class CommentController extends FrontController {

    public function beforeAction() {
        parent::beforeAction();

        $this->_renderer->assign('counters', CommentManager::getCommentsCounters());
    }

    public function indexAction() {
        $this->setTemplateName('comments-list');
    }

    public function acceptAction() {
        $this->_changeStatusField('visible', 1);
    }
}