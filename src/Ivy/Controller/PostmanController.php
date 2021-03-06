<?php

namespace Ivy\Controller;

use Ivy\Helper\PostmanManager;

class PostmanController extends FrontController {

    public function beforeAction() {
        parent::beforeAction();

        $this->_renderer->assign('counters', PostmanManager::getFeedsCounters());
    }

    public function indexAction() {
        parent::indexAction();

        $this->setTemplateName('all-feed');

        echo 'index';
    }

    public function repostAction() {
        if (isset($_GET['hash'])) {
            $aIds = array($_GET['hash']);
        }

        if (isset($_GET['path'])) {
            $sPath = $_GET['path'];
        }
        if (isset($_POST['path'])) {
            $sPath = $_POST['path'];
        }

        // if ($aIds && $sPath) {
        //     $sFeedFile = CACHE_DIR . '/feeds/'.$sPath.'.json';
        //     if (!file_exists($sFeedFile)) {
        //         $aFeed = array();
        //         $sFeedDir = dirname($sFeedFile);
        //         if (!file_exists($sFeedDir)) {
        //             mkdir($sFeedDir, 0777, true);
        //         }
        //     } else {
        //         $aFeed = unserialize(file_get_contents($sFeedFile));
        //     }
        //     foreach ($aIds as $id) {
        //         $aFeed[$id] = true;
        //     }

        //     file_put_contents($sFeedFile, serialize($aFeed));

        //     $_GET['path'] = $sPath;
        // }

        // prevent endless loop
        // if (!isset($_POST['ids'])) {
        //     $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
        // }

        // echo 'have to set values to form';
        $this->setTemplateName('all-info');
        // $aFields = [];

        // echo 'REPOST';

        // $this->actionForward('add', 'news', true);

        header('Location: '.BASE_URL.'/news/add', true, 303);


        // PostmanManager::analyzeFeeds();

        // $this->_renderer->assign('counters', PostmanManager::getFeedsCounters());
    }

    public function markAction() {
        if (isset($_GET['hash'])) {
            $aIds = array($_GET['hash']);
        }
        if (isset($_POST['ids'])) {
            $aIds = $_POST['ids'];
        }

        if (isset($_GET['path'])) {
            $sPath = $_GET['path'];
        }
        if (isset($_POST['path'])) {
            $sPath = $_POST['path'];
        }

        if ($aIds && $sPath) {
            $sFeedFile = CACHE_DIR . '/feeds/'.$sPath.'.json';
            if (!file_exists($sFeedFile)) {
                $aFeed = array();
                $sFeedDir = dirname($sFeedFile);
                if (!file_exists($sFeedDir)) {
                    mkdir($sFeedDir, 0777, true);
                }
            } else {
                $aFeed = unserialize(file_get_contents($sFeedFile));
            }
            foreach ($aIds as $id) {
                $aFeed[$id] = true;
            }

            file_put_contents($sFeedFile, serialize($aFeed));

            $_GET['path'] = $sPath;
        }

        echo 'mark action';

        // prevent endless loop
        if (!isset($_POST['ids'])) {
            $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
        }

        PostmanManager::analyzeFeeds();

        $this->_renderer->assign('counters', PostmanManager::getFeedsCounters());
    }

    public function lockAction() {
        if (isset($_GET['hash'])) {
            $aIds = array($_GET['hash']);
        }
        // if (isset($_POST['ids'])) {
        //     $aIds = $_POST['ids'];
        // }

        if (isset($_GET['path'])) {
            $sPath = $_GET['path'];
        }
        if (isset($_POST['path'])) {
            $sPath = $_POST['path'];
        }

        if ($aIds && $sPath) {
            $sFeedFile = CACHE_DIR . '/feeds/locks/'.$sPath.'.json';
            if (!file_exists($sFeedFile)) {
                $aFeed = array();
                $sFeedDir = dirname($sFeedFile);
                if (!file_exists($sFeedDir)) {
                    mkdir($sFeedDir, 0777, true);
                }
            } else {
                $aFeed = unserialize(file_get_contents($sFeedFile));
            }
            foreach ($aIds as $id) {
                $aFeed[$id] = true;
            }

            file_put_contents($sFeedFile, serialize($aFeed));

            $_GET['path'] = $sPath;
        }

        // prevent endless loop
        if (!isset($_POST['ids'])) {
            $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
        }
    }

    public function unlockAction() {
        if (isset($_GET['hash'])) {
            $aIds = array($_GET['hash']);
        }
        // if (isset($_POST['ids'])) {
        //     $aIds = $_POST['ids'];
        // }

        if (isset($_GET['path'])) {
            $sPath = $_GET['path'];
        }
        if (isset($_POST['path'])) {
            $sPath = $_POST['path'];
        }

        if ($aIds && $sPath) {
            $sFeedFile = CACHE_DIR . '/feeds/locks/'.$sPath.'.json';
            if (file_exists($sFeedFile)) {
                $aFeed = unserialize(file_get_contents($sFeedFile));
            }
            foreach ($aIds as $id) {
                if (isset($aFeed[$id])) {
                    unset($aFeed[$id]);
                }
            }

            file_put_contents($sFeedFile, serialize($aFeed));

            $_GET['path'] = $sPath;
        }

        // prevent endless loop
        if (!isset($_POST['ids'])) {
            $this->actionForward('index', $this->_ctrlName, true, array('get:path' => $sPath));
        }
    }
}