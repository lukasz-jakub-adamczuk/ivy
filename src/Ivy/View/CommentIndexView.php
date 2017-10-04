<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Helper\ValueMapper;
use Aya\Mvc\IndexView;

use Ivy\Helper\MassActions;

class CommentIndexView extends IndexView {

    protected function _getSections() {
        $sections = array(
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
            'gallery-comment' => array(
                'name' => 'Galerie',
                'icon' => 'icon-gallery'
            ),
            'user-comment' => array(
                'name' => 'Użytkownicy',
                'icon' => 'icon-user'
            )
        );
        return $sections;
    }

    protected function _getMassActions() {
        return MassActions::getActions(array('remove'));
    }

    public function afterFill() {
        $this->_renderer->assign('header', 'Komentarze');

        // TODO refactor getting controller
        $this->_renderer->assign('sPrimaryKey', 'id_'.str_replace('-', '_', $_GET['ctrl']));

        // TODO need controller in view
        // echo str_replace('-comment', '', $_GET['ctrl']);
        $ctrl = str_replace('-comment', '', $_GET['ctrl']);

        // $db = \Aya\Core\Db::getInstance();

        $aPreviewer = [
            'patterns' => [
                'news' => 'ctrl/newsdate/object_slug',
                'article' => 'ctrl/category_slug/object_slug',
                'story' => 'ctrl/category_slug/object_slug',
                'gallery' => 'ctrl/category_slug/object_slug',
                'user' => 'ctrl/slug'
            ],
            'ctrl' => $ctrl,
            'url' => ValueMapper::getUrl($ctrl)
        ];

        $this->_renderer->assign('preview', $aPreviewer);

        // counters
        // $aCounters = array();
        // $aCounters['news-comment']['value'] = $db->getOne('SELECT COUNT(id_news_comment) FROM news_comment WHERE visible=0');
        // $aCounters['article-comment']['value'] = $db->getOne('SELECT COUNT(id_article_comment) FROM article_comment WHERE visible=0');
        // $aCounters['story-comment']['value'] = $db->getOne('SELECT COUNT(id_story_comment) FROM story_comment WHERE visible=0');
        // $aCounters['gallery-comment']['value'] = $db->getOne('SELECT COUNT(id_gallery_comment) FROM gallery_comment WHERE visible=0');
        // $aCounters['user-comment']['value'] = $db->getOne('SELECT COUNT(id_user_comment) FROM user_comment WHERE visible=0');

        // // $this->_renderer->assign('counters', $aCounters);
        // echo 'aaa';
        // print_r($aCounters);
    }

    protected function _handleDataset($aRows) {
        // list
        $this->_renderer->assign('list', $aRows);
    }
}
