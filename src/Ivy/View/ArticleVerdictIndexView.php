<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\IndexView;

use Ivy\Helper\MassActions;

class ArticleVerdictIndexView extends IndexView {

    protected function _getSections() {
        $aSections = array(
            'article-verdict' => array(
                'name' => 'Werdykty',
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

        // authors
        $oAuthors = Dao::collection('user');
        // $oAuthors->orderby('name');
        // $oAuthors->load(-1);

        $aFilterValues = array();
        $aFilterValues['id_author'] = $oAuthors->getAuthors();
        $this->_renderer->assign('aFilterValues', $aFilterValues);
    }
}