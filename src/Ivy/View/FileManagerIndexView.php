<?php

namespace Ivy\View;

use Aya\Core\View;
use Aya\Core\Folder;

class FileManagerIndexView extends View {

    public function fill() {
        // basePath could be different due rights
        echo $sBasePath = SITE_DIR . '/assets';
        
        $sPath = isset($_GET['path']) ? $_GET['path'] : '';

        $aPath = explode(',', $sPath);
        foreach ($aPath as $pk => $path) {
            $tmp[] = $path;
            $aPathItems[] = array('url' => implode(',', $tmp), 'name' => $path);
        }

        $sContentPath = $sBasePath . '/' . str_replace(',', '/', $sPath);
        if (file_exists($sContentPath)) {
            $aAllContent = Folder::getContent($sContentPath, true);

            // print_r($aAllContent);

            // filter and sort
            foreach ($aAllContent as $tk => $type) {
                foreach ($type as $item) {
                    if (substr($item['name'], 0, 6) !== '__rm__') {
                        $aContent[$tk][] = $item;
                    }
                }
            }

            // up dir path
            if (count($tmp) > 1) {
                array_pop($tmp);
                $sUpDirPath = '/' . implode(',', $tmp);
            } else {
                $sUpDirPath = '';
            }
            // echo $sUpDirPath;

            // counts
            $aCounts = array();
            $aCounts['dirs'] = count($aContent['dirs']) > 1 ? count($aContent['dirs']) - 1 : 0;
            $aCounts['files'] = isset($aContent['files']) ? count($aContent['files']) : 0;

            $this->_renderer->assign('sPath', $sPath);
            $this->_renderer->assign('sUpDirPath', $sUpDirPath);
            $this->_renderer->assign('aPathItems', $aPathItems);

            $this->_renderer->assign('aCounts', $aCounts);

            $this->_renderer->assign('aDirs', $aContent['dirs']);
            // print_r($aContent['files']);
            if (isset($aContent['files'])) {
                $this->_renderer->assign('aFiles', $aContent['files']);
            }
        } else {
            $this->raiseError('...Szukany katalog nie istnieje.');
        }
    }

    public function afterFill() {}
}