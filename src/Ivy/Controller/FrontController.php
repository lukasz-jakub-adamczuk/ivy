<?php

namespace Ivy\Controller;

use Aya\Core\User;
use Aya\Helper\Breadcrumbs;
use Aya\Mvc\CrudController;

use Ivy\Helper\CommentManager;
use Ivy\Helper\NavigationManager;
use Ivy\Helper\PostmanManager;

class FrontController extends CrudController {

    public function indexAction() {
        // to support lock handling
        parent::indexAction();
    }

    public function infoAction() {
        // to support lock handling
        parent::infoAction();
    }

    public function beforeAction() {
        parent::beforeAction();
        // navigation
        $this->_renderer->assign('aNavigation', NavigationManager::getNavigation());

        // Breadcrumbs::add('', 'squarezone.pl', 'icon-home');
        $aItem = array(
            'name' => 'ctrl',
            'url' => $this->getCtrlName(),
            'text' => $this->getCtrlName(),
        );
        Breadcrumbs::add($aItem);

        // postman
        PostmanManager::analyzeFeeds();        
        $this->_renderer->assign('postman', PostmanManager::info());

        // comments
        CommentManager::analyzeComments();
        $this->_renderer->assign('allAwaitingComments', CommentManager::getCommentsTotal());
    }
    
    // TODO should name init()
    public function afterAction() {
        parent::afterAction();
    }
}