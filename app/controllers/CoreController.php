<?php

namespace Ivy\Controller;

use Aya\Management\CrudController;

use Ivy\Helper\ImageFragment;
use Ivy\Helper\StreamManager;

class ArticleController extends CrudController {

    // public function addAction() {
    //     $this->setTemplateName('article-info');
    //     // $this->_actionForward('')
    //     $this->setViewName('ArticleInfo');
    // }

    public function postInsert($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        $this->_clearStreamCache('article');
    }

    public function postUpdate($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        $this->_clearStreamCache('article');
    }
}