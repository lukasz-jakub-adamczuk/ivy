<?php

namespace Ivy\Controller;

use Aya\Helper\ChangeLog;

class NewsImageController extends FrontController {

    // $this->setTemplateName('image-fragment');

    public function infoAction() {
        $sPath = isset($_GET['path']) ? $_GET['path'] : '';

        $this->_renderer->assign('sPath', $sPath);
    }

    public function postRemove($sName) {
        $sFile = WEB_DIR . $sName;
        // TODO same situation like on ArticleImageController
        if (file_exists($sFile)) {
            unlink($sFile);

            ChangeLog::add('unlink', $this->_ctrlName, $sName);
        }
    }
}