<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\IndexView;

class CupPlayerIndexView extends IndexView {

    protected function _getSearchFields() {
        return array('name', 'slug');
    }

    public function defaultOrdering() {
        // $this->_oCollection->navDefault('sort', 'creation-date');
        // $this->_oCollection->navDefault('order', 'desc');

        // $this->_oCollection->navDefault('sort', 'id-cup-player');

        // $this->_oCollection->navDefault('sort', '`group` ASC, points ASC');
        $this->_oCollection->navSet('sort', '`id_cup` ASC, `group` ASC, points ASC');
        // $this->_oCollection->navSet('order', 'asc');
    }

    // public function defaultOrdering() {
        // $this->_oCollection->navDefault('sort', 'creation-date');
        // $this->_oCollection->navDefault('order', 'desc');

        // $this->_oCollection->navSet('sort', 'id-cup-player');
    // }

    protected function _getFilters() {
        $aFilters = array(
            'search' => array(
                'label' => 'Wyszukiwarka',
                'type' => 'text',
                'default' => '',
                'selected' => 'null'
            ),
            'id_cup' => array(
                'label' => 'Turniej',
                'type' => 'select',
                'options' => array('null' => '---'),
                'default' => '',
                'selected' => 'null'
            )
        );
        return $aFilters;
    }

    public function beforeFill() {
        $this->_iCollectionSize = 32;

        // $this->_oCollection->navSet('sort', 'points');
        // $this->_oCollection->navSet('order', 'asc');
    }

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Mistrzostwa (zawodnicy)');

        // tournament
        $oCups = Dao::collection('cup');
        $oCups->orderby('name');
        $oCups->load(-1);

        $aFilterValues = array();
        $aFilterValues['id_cup'] = $oCups->getColumn();

        $this->_renderer->assign('aFilterValues', $aFilterValues);
    }
}
