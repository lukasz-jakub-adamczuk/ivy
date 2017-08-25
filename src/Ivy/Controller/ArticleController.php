<?php

namespace Ivy\Controller;

use Ivy\Helper\ImageFragment;
use Ivy\Helper\StreamManager;

class ArticleController extends FrontController {

    // public function addAction() {
    //     $this->setTemplateName('article-info');
    //     // $this->_actionForward('')
    //     $this->setViewName('ArticleInfo');
    // }

    public function afterInsert($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        StreamManager::clearStreamCache('article');
    }

    public function afterUpdate($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        StreamManager::clearStreamCache('article');
    }
}