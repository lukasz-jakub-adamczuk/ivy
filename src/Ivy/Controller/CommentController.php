<?php

namespace Ivy\Controller;

class CommentController extends FrontController {

    public function indexAction() {
        $this->setTemplateName('comments-list');
    }

    public function acceptAction() {
        $this->_changeStatusField('visible', 1);
    }
}