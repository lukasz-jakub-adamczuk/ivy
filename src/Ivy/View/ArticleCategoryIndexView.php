<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\IndexView;

use Ivy\Helper\MassActions;
use Ivy\Helper\RelatedActions;

class ArticleCategoryIndexView extends IndexView {

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

    protected function _getRelatedActions() {
        return RelatedActions::getActions(array('refresh', 'order', 'add'));
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

    protected function _getSearchFields() {
        return array('name');
    }

    // extentending regular collection result
    public function postProcessDataset($aRows) {
        $articleCollection = Dao::collection('article');
        
        $aArticlesCounts = $articleCollection->getArticlesCategories();
        
        $aVerifiedArticlesCounts = $articleCollection->getArticlesCategoriesVerified();

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

    public function beforeFill() {
        $this->_iCollectionSize = 50;
    }

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Kategorie');
    }
}