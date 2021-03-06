<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\IndexView;

class PostmanMarkView extends IndexView {

    private $_sections;

    protected function _getSections() {
        return PostmanNotification::getFeedsSections();
    }

    protected function _getMassActions() {
        return MassActions::getActions(array('mark'));
    }

    protected function _getRelatedActions() {
        // return RelatedActions::getActions(array('refresh'));
        return array(
            'refresh' => array(
                'name' => 'refresh',
                'href' => 'postman/index/'.$_GET['path'],
                'icon' => 'refresh',
                'title' => 'Odśwież'
            )
        );
    }

    protected function _getFilters() {
        $aFilters = array(
            'search' => array(
                'label' => 'Wyszukiwarka',
                'type' => 'text',
                'default' => '',
                'selected' => 'null'
            )
        );
        return $aFilters;
    }

    public function fill() {  
    }

    public function afterFill() {
        $this->_renderer->assign('header', 'Listonosz');

        if (isset($_GET['path'])) {
            $this->_renderer->assign('sPath', $_GET['path']);

            $sFeedFile = ROOT_DIR . '/../postman/feeds/'.$_GET['path'].'.json';
            
            $aFeedStats = array();
            if (file_exists($sFeedFile)) {
                $sFeedStatsFile = CACHE_DIR . '/feeds/'.$_GET['path'].'.json';
                $sFeedLocksFile = CACHE_DIR . '/feeds/locks/'.$_GET['path'].'.json';
                
                if (file_exists($sFeedStatsFile)) {
                    $aFeedStats = unserialize(file_get_contents($sFeedStatsFile));
                }
                if (file_exists($sFeedLocksFile)) {
                    $aFeedLocks = unserialize(file_get_contents($sFeedLocksFile));
                }
                // print_r($aFeedStats);

                // items from feed
                $sContent = file_get_contents($sFeedFile);

                $aItems = json_decode($sContent, true);

                $aElements = array();
                foreach ($aItems as $item) {
                    $aTmp = $item;
                    // reference problem
                    $sHash = md5(trim(strip_tags($item['title'])));
                    if (!isset($aFeedStats[$sHash])) {
                        $aTmp['unread'] = true;
                    }
                    $aTmp['lock'] = false;
                    if (isset($aFeedLocks[$sHash])) {
                        $aTmp['lock'] = true;
                    }
                    $aTmp['hash'] = $sHash;
                    
                    
                    $aElements[] = $aTmp;
                }

                $this->_renderer->assign('list', $aElements);
            }
        }
    }
}
