<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\IndexView;

use Ivy\Helper\MassActions;

class CommentIndexView extends IndexView {

    protected function _getSections() {
        $aSections = array(
            'news-comment' => array(
                'name' => 'Aktualności',
                'icon' => 'icon-news'
            ),
            'article-comment' => array(
                'name' => 'Gry',
                'icon' => 'icon-game'
            ),
            'story-comment' => array(
                'name' => 'Publicystyka',
                'icon' => 'icon-article'
            ),
            'user-comment' => array(
                'name' => 'Użytkownicy',
                'icon' => 'icon-user'
            )
        );
        return $aSections;
    }

    protected function _getMassActions() {
        return MassActions::getActions(array('remove'));
    }

    /*protected function _getFilters() {
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
    }*/

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Komentarze');

        $this->_renderer->assign('sPrimaryKey', 'id_'.str_replace('-', '_', $_GET['ctrl']));

        $db = \Aya\Core\Db::getInstance();

        // counters
        $aCounters = array();
        $aCounters['news-comment']['value'] = $db->getOne('SELECT COUNT(id_news_comment) FROM news_comment WHERE visible=0');
        $aCounters['article-comment']['value'] = $db->getOne('SELECT COUNT(id_article_comment) FROM article_comment WHERE visible=0');
        $aCounters['story-comment']['value'] = $db->getOne('SELECT COUNT(id_story_comment) FROM story_comment WHERE visible=0');
        $aCounters['user-comment']['value'] = $db->getOne('SELECT COUNT(id_user_comment) FROM user_comment WHERE visible=0');

        $this->_renderer->assign('aCounters', $aCounters);

        // categories
        // $oCategories = Dao::collection('article-category');
        // $oCategories->orderby('name');
        // $oCategories->load(-1);

        // // authors
        // $oAuthors = Dao::collection('user');
        // $oAuthors->orderby('name');
        // $oAuthors->load(-1);

        // $aFilterValues = array();
        // $aFilterValues['id_article_category'] = $oCategories->getColumn();
        // $aFilterValues['id_author'] = $oAuthors->getColumn();
        // $this->_renderer->assign('aFilterValues', $aFilterValues);
    }

    protected function _handleDataset($aRows) {
        
        
        

        // list
        $this->_renderer->assign('aList', $aRows);
    }
}
