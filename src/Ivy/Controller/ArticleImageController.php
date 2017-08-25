<?php

namespace Ivy\Controller;

use Aya\Helper\ChangeLog;

class ArticleImageController extends FrontController {

    // $this->setTemplateName('image-fragment');

    public function infoAction() {
        $sPath = isset($_GET['path']) ? $_GET['path'] : '';

        $this->_renderer->assign('sPath', $sPath);
    }

    public function removeAction() {
        
        $sFile = WEB_DIR . $sName;
        // TODO remove file on site too
        if (file_exists($sFile)) {
            unlink($sFile);
// TODO changelog won't accept unlink,
            ChangeLog::add('unlink', $this->_ctrlName, $sName);
        }
    }
}