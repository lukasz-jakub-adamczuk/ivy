<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\IndexView;

use Ivy\Helper\MassActions;

class StoryCategoryIndexView extends IndexView {

    protected function _getSections() {
        $aSections = array(
            'article-category' => array(
                'name' => 'Gry',
            ),
            'story-category' => array(
                'name' => 'Publicystyka',
            )
        );
        return $aSections;
    }

    protected function _getMassActions() {
        return MassActions::getStandardActions();
    }

    // extentending regular collection result
    public function postProcessDataset($aRows) {
        $storyCollection = Dao::collection('story');
        
        $aArticlesCounts = $storyCollection->getStoriesCategories();
        
        $aVerifiedArticlesCounts = $storyCollection->getStoriesCategoriesVerified();

        foreach ($aRows as $rk => $row) {
            if (isset($aArticlesCounts[$rk])) {
                $aRows[$rk]['articles'] = $aArticlesCounts[$rk]['total'];
            }
            if (isset($aVerifiedArticlesCounts[$rk]) && isset($aVerifiedArticlesCounts[$rk]['good'])) {
                $aRows[$rk]['good'] = round($aVerifiedArticlesCounts[$rk]['good'] / $aArticlesCounts[$rk]['total'] * 100);
            } else {
                $aRows[$rk]['good'] = 0;
            }

        }
        return $aRows;
    }

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Kategorie');
    }
}