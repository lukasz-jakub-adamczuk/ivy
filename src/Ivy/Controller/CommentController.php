<?php

namespace Ivy\Controller;

use Aya\Management\CrudController;

class CommentController extends CrudController {

    public function indexAction() {
        $this->setTemplateName('comments-list');
    }

    public function acceptAction() {
        $this->_changeStatusField('visible', 1);
    }
}