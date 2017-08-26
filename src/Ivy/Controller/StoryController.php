<?php

namespace Ivy\Controller;

use Ivy\Helper\ImageFragment;
use Ivy\Helper\StreamManager;

class StoryController extends FrontController {

    public function afterInsert($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        StreamManager::clearStreamCache('story');
    }

    public function afterUpdate($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        StreamManager::clearStreamCache('story');
    }
}