<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\IndexView;

use Ivy\Helper\MassActions;
use Ivy\Helper\RelatedActions;

class CategoryIndexView extends IndexView {

    public $type;
    
    public function init() {
        $parts = explode('\\', get_class($this));
        $class = array_pop($parts);
        $this->type = strtolower(str_replace('CategoryIndexView', '', $class));

        parent::init();
    }

    protected function _getSections() {
        $sections = array(
            'article-category' => array(
                'name' => 'Gry',
            ),
            'story-category' => array(
                'name' => 'Publicystyka',
            )
        );
        return $sections;
    }

    protected function _getMassActions() {
        return MassActions::getStandardActions();
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
        $articleCollection = Dao::collection($this->type);
        
        $allArticles = $articleCollection->getArticleCategories();        
        $verifiedArticles = $articleCollection->getArticleCategoriesVerified();

        foreach ($aRows as $rk => $row) {
            if (isset($allArticles[$rk])) {
                $aRows[$rk]['articles'] = $allArticles[$rk]['total'];
            }
            if (isset($verifiedArticles[$rk]) && isset($verifiedArticles[$rk]['good'])) {
                $aRows[$rk]['good'] = round($verifiedArticles[$rk]['good'] / $allArticles[$rk]['total'] * 100);
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
        $this->_renderer->assign('header', 'Kategorie');
    }
}