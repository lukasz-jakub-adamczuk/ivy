<?php

namespace Ivy\Controller;

use Aya\Management\CrudController;

use Ivy\Helper\ImageFragment;
use Ivy\Helper\StreamManager;

class StoryController extends CrudController {

    // public function addAction() {
    //     $this->setTemplateName('article-info');
    //     // $this->_actionForward('')
    //     $this->setViewName('ArticleInfo');
    // }

    public function afterInsert($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        $this->_clearStreamCache('story');
    }

    public function afterUpdate($mId) {
        ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        ImageFragment::handleImageFragment($mId, 'cover', 2, $this->getCtrlName());

        StreamManager::handleItem('article', $mId);

        $this->_clearStreamCache('story');
    }

    /*private function _prepareStreamItem($mId, $aPost) {
        $aStreamItem = array(
            'id' => $mId,
            'ctrl' => $this->_ctrlName,
            'title' => $_POST['dataset']['title'],
            'slug' => $this->slugify($_POST['dataset']['title']),
            'category' => isset($_POST['hidden']['category']) ? $_POST['hidden']['category'] : '',
            'category_slug' => isset($_POST['hidden']['category']) ? $this->slugify($_POST['hidden']['category']) : '',
            'category_abbr' => isset($_POST['hidden']['abbr']) ? $this->slugify($_POST['hidden']['abbr']) : '',
            'creation_date' => date('Y-m-d H:i:s')
        );
        return $aStreamItem;
    }

    private function addToStream($aStreamItem) {
        $sFile = ROOT_DIR . '/../renaissance/app/cache/stream';
        if (file_exists($sFile)) {
            $aActivities = unserialize(file_get_contents($sFile));

            $aItems = array_reverse($aActivities);

            // if item exists in stream remove it, and place at the top
            $aReducedItems = array();
            foreach ($aItems as $ik => $item) {
                $sItemKey = (isset($item['ctrl']) ? $item['ctrl'] : 'news').'-'.(isset($item['id']) ? $item['id'] : $item['id_news']);
                if (!isset($aReducedItems[$sItemKey])) {
                    unset($item);
                }
            }

            $aReducedItems[] = $aStreamItem;

            $aActivities = array_reverse($aReducedItems);;

            // print_r($aActivities);

            file_put_contents($sFile, serialize($aActivities));
        }
        
    }
*/
}