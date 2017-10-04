<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

use Ivy\Helper\MassActions;
use Ivy\Helper\PostmanManager;

class PostmanRepostView extends InfoView {

    public function fill() {
        parent::fill();
        $this->_renderer->assign('sFormMainPartTemplate', 'forms/news-info-main.tpl');
        $this->_renderer->assign('sFormSubPartTemplate', 'forms/news-info-sub.tpl');
    }

    public function afterFill() {
        $this->_renderer->assign('header', 'Listonosz');
        
        if (isset($_GET['path'])) {
            $this->_renderer->assign('sPath', $_GET['path']);

            $sFeedFile = ROOT_DIR . '/../postman/feeds/'.$_GET['path'].'.json';


            // items from feed
            $sContent = file_get_contents($sFeedFile);
            
            $aItems = json_decode($sContent, true);

            $aElements = array();
            $fields = [];
            foreach ($aItems as $item) {
                $aTmp = $item;
                // reference problem
                $sHash = md5(trim(strip_tags($item['title'])));
                if ($_GET['hash'] == $sHash) {
                    $fields['title'] = trim(strip_tags($item['title']));
                }
            }

            // $this->_renderer->assign('aFields', $fields);

            
            
            // $aFeedStats = array();
            // if (file_exists($sFeedFile)) {
            //     $sFeedStatsFile = CACHE_DIR . '/feeds/'.$_GET['path'].'.json';
            //     $sFeedLocksFile = CACHE_DIR . '/feeds/locks/'.$_GET['path'].'.json';
                
            //     if (file_exists($sFeedStatsFile)) {
            //         $aFeedStats = unserialize(file_get_contents($sFeedStatsFile));
            //     }
            //     if (file_exists($sFeedLocksFile)) {
            //         $aFeedLocks = unserialize(file_get_contents($sFeedLocksFile));
            //     }

            //     // items from feed
            //     $sContent = file_get_contents($sFeedFile);

            //     $aItems = json_decode($sContent, true);

            //     $aElements = array();
            //     foreach ($aItems as $item) {
            //         $aTmp = $item;
            //         // reference problem
            //         $sHash = md5(trim(strip_tags($item['title'])));
            //         if (!isset($aFeedStats[$sHash])) {
            //             $aTmp['unread'] = true;
            //         }
            //         $aTmp['lock'] = false;
            //         if (isset($aFeedLocks[$sHash])) {
            //             $aTmp['lock'] = true;
            //         }
            //         $aTmp['hash'] = $sHash;
                    
            //         $aElements[] = $aTmp;
            //     }

            //     $this->_renderer->assign('list', $aElements);
            // }
        }
    }
}
