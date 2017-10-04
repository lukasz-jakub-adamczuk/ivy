<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\IndexView;

use Ivy\Helper\MassActions;

class TextIndexView extends IndexView {

    public $type;

    public function init() {
        $parts = explode('\\', get_class($this));
        $class = array_pop($parts);
        $this->type = strtolower(str_replace('IndexView', '', $class));

        parent::init();
    }

    protected function _getSections() {
        $sections = [
            'article' => [
                'name' => 'Gry',
                'icon' => 'icon-game'
            ],
            'story' => [
                'name' => 'Publicystyka',
                'icon' => 'icon-article'
            ]
        ];
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
            ),
            'id_'.$this->type.'_category' => array(
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
        $this->_renderer->assign('header', 'Artykuły');

        // categories
        $oCategories = Dao::collection(''.$this->type.'-category');
        $oCategories->orderby('name');
        $oCategories->load(-1);

        // authors
        $oAuthors = Dao::collection('user');
        $oAuthors->orderby('name');
        $oAuthors->load(-1);

        $aFilterValues = array();
        $aFilterValues['id_'.$this->type.'_category'] = $oCategories->getColumn();
        $aFilterValues['id_author'] = $oAuthors->getColumn();
        $this->_renderer->assign('aFilterValues', $aFilterValues);
    }
}
