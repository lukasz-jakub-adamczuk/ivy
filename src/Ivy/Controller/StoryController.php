<?php

namespace Ivy\Controller;

use Ivy\Helper\ImageFragment;
use Ivy\Helper\StreamManager;

class StoryController extends FrontController {

    public function addAction() {
        parent::addAction();
        $this->setTemplateName('article-info');
    }

    public function afterInsert($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        // StreamManager::clearStreamCache('story');
    }

    public function afterUpdate($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('story', $mId);

        // StreamManager::clearStreamCache('story');
    }
}