<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\IndexView;

use Ivy\Helper\MassActions;

class FragmentIndexView extends IndexView {

    // protected function _getSections() {
    //     $aSections = array(
    //         'fragment' => array(
    //             'name' => 'Fragmenty',
    //         )
    //     );
    //     return $aSections;
    // }

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
            'id_fragment_type' => array(
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

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Fragmenty');

        // categories
        $oCategories = Dao::collection('fragment-type');
        $oCategories->orderby('name');
        $oCategories->load(-1);

        // authors
        $oAuthors = Dao::collection('user');
        $oAuthors->orderby('name');
        $oAuthors->load(-1);

        $aFilterValues = array();
        $aFilterValues['id_fragment_type'] = $oCategories->getColumn();
        $aFilterValues['id_author'] = $oAuthors->getColumn();
        $this->_renderer->assign('aFilterValues', $aFilterValues);
    }
}