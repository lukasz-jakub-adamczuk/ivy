<?php

namespace Ivy\Controller;

// use Aya\Core\Controller;
use Aya\Management\CrudController;
use Aya\Core\User;
use Aya\Helper\Breadcrumbs;

use Ivy\Helper\CommentManager;
use Ivy\Helper\NavigationManager;
use Ivy\Helper\PostmanManager;

class FrontController extends CrudController {

    public function indexAction() {}

    public function infoAction() {}

    public function beforeAction() {
        // navigation
        $this->_renderer->assign('aNavigation', NavigationManager::getNavigation());

        // Breadcrumbs::add('', 'squarezone.pl', 'icon-home');
        $aItem = array(
            'name' => 'ctrl',
            'url' => $this->getCtrlName(),
            'text' => $this->getCtrlName(),
        );
        Breadcrumbs::add($aItem);

        // $this->_renderer->assign('ctrl', $this->getCtrlName());
        // $this->_renderer->assign('act', $this->getActionName());

        PostmanManager::analyzeFeeds();

        $this->_renderer->assign('aCounters', PostmanManager::getFeedsCounters());
        $this->_renderer->assign('iTotal', PostmanManager::getFeedsTotal());

        // comments
        CommentManager::analyzeComments();

        $this->_renderer->assign('iAllComments', CommentManager::getCommentsTotal());
    }
    
    // TODO should name init()
    public function afterAction() {
        parent::afterAction();
    }
}