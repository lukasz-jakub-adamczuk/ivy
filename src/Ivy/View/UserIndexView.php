<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\IndexView;

use Ivy\Helper\MassActions;

class UserIndexView extends IndexView {

    protected function _getFilters() {
        $aFilters = array(
            'search' => array(
                'label' => 'Wyszukiwarka',
                'type' => 'text',
                'default' => '',
                'selected' => 'null'
            ),
            'id_user_group' => array(
                'label' => 'Grupa',
                'type' => 'select',
                'options' => array('null' => '---'),
                'default' => '',
                'selected' => 'null'
            )
        );
        return $aFilters;
    }

    protected function _getSearchFields() {
        return array('name');
    }

    public function defaultOrdering() {
        $this->_oCollection->navDefault('sort', 'name');
        $this->_oCollection->navDefault('order', 'asc');
    }

    // public function defaultGrouping() {
    //     $this->_oCollection->setGroupPart(' GROUP BY '.$this->_sDaoIndex.'.id_'.$this->_sDaoIndex);
    // }

    // public function defaultSearching($oIndexCollection) {
    //     $oIndexCollection->setSearchFields(array('name'));
    //     return $oIndexCollection;
    // }

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Użytkownicy');

        // user groups
        $oUserGroups = Dao::collection('user-group');
        $oUserGroups->orderby('name');
        $oUserGroups->load(-1);

        $aFilterValues = array();
        $aFilterValues['id_user_group'] = $oUserGroups->getColumn();
        $this->_renderer->assign('aFilterValues', $aFilterValues);
    }
}
