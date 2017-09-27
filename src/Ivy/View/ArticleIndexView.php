<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\IndexView;

use Ivy\Helper\MassActions;

class ArticleIndexView extends IndexView {

    protected function _getSections() {
        $aSections = array(
            'article' => array(
                'name' => 'Gry',
                'icon' => 'icon-game'
            ),
            'story' => array(
                'name' => 'Publicystyka',
                'icon' => 'icon-article'
            )
        );
        return $aSections;
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
            ),
            'id_article_category' => array(
                'label' => 'Kategoria',
                'type' => 'select',
                'options' => array('null' => '---'),
                'default' => '',
                'selected' => 'null'
            ),
            'id_author' => array(
                'label' => 'Autor',
                'type' => 'select',
                'options' => array('null' => '---'),
                'default' => '',
                'selected' => 'null'
            )
        );
        return $aFilters;
    }

    public function beforeFill() {
        $this->_iCollectionSize = 50;
    }

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Artykuły');

        // categories
        $oCategories = Dao::collection('article-category');
        $oCategories->orderby('name');
        $oCategories->load(-1);

        // authors
        $oAuthors = Dao::collection('user');
        $oAuthors->orderby('name');
        $oAuthors->load(-1);

        $aFilterValues = array();
        $aFilterValues['id_article_category'] = $oCategories->getColumn();
        $aFilterValues['id_author'] = $oAuthors->getColumn();
        $this->_renderer->assign('aFilterValues', $aFilterValues);
    }
}
