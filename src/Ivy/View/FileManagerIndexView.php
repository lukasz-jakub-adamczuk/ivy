<?php

namespace Ivy\View;

use Aya\Core\View;
use Aya\Core\Folder;

class FileManagerIndexView extends View {

    public function fill() {
        // basePath could be different due rights
        $basePath = WEB_DIR . '';
        
        $tmpPath = isset($_GET['path']) ? $_GET['path'] : 'assets';

        $parts = explode(',', $tmpPath);
        foreach ($parts as $pk => $path) {
            $tmp[] = $path;
            $pathItems[] = array('url' => implode(',', $tmp), 'name' => $path);
        }

        $contentPath = $basePath . '/' . str_replace(',', '/', $tmpPath);
        if (file_exists($contentPath)) {
            $allContent = Folder::getContent($contentPath, true, ['.DS_Store']);

            // filter and sort
            foreach ($allContent as $tk => $type) {
                $realTmpPath = '/' . str_replace(',', '/', $tmpPath);
                foreach ($type as &$item) {
                    $item['path'] = $realTmpPath . '/' . $item['name'];
                    if (substr($item['name'], 0, 6) !== '__rm__') {
                        $content[$tk][] = $item;
                    }
                }
            }

            // up dir path
            if (count($tmp) > 1) {
                array_pop($tmp);
                $upDirPath = '/' . implode(',', $tmp);
            } else {
                $upDirPath = '';
            }

            // counts
            $counters = array();
            $counters['dirs'] = count($content['dirs']) > 1 ? count($content['dirs']) - 1 : 0;
            $counters['files'] = isset($content['files']) ? count($content['files']) : 0;

            $this->_renderer->assign('tmpPath', $tmpPath);
            $this->_renderer->assign('upDirPath', $upDirPath);
            $this->_renderer->assign('pathItems', $pathItems);

            $this->_renderer->assign('counters', $counters);

            $this->_renderer->assign('dirs', $content['dirs']);
            // print_r($content['files']);
            if (isset($content['files'])) {
                $this->_renderer->assign('files', $content['files']);
            }
        } else {
            $this->raiseError('...Szukany katalog nie istnieje.');
        }
    }

    public function afterFill() {}
}