<?php

namespace Ivy\View;

use Aya\Core\View;

class FileManagerInfoView extends View {

    public function fill() {
        // get list of files
        $sBasePath = WEB_DIR;
        $sBackgroundsPath = 'assets,backgrounds';

        $sPath = isset($_GET['path']) ? $_GET['path'] : '';

        $bShowCreateFragmentOption = substr($sPath, 0, strlen($sBackgroundsPath)) == $sBackgroundsPath ? true : false;
        $this->_renderer->assign('showCreateFragmentsOption', $bShowCreateFragmentOption);

        $aPath = explode(',', $sPath);

        $aFields = array();
        $aFields['name'] = end($aPath);
        
        $this->_renderer->assign('aFields', $aFields);

        $this->_renderer->assign('sPath', $sPath);
    }

    public function afterFill() {
    
    }
}