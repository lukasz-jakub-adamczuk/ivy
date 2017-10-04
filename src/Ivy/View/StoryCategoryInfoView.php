<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

class StoryCategoryInfoView extends InfoView {

    public function fill() {
        parent::fill();
        $this->_renderer->assign('sFormMainPartTemplate', 'forms/article-category-info-main.tpl');
        $this->_renderer->assign('sFormSubPartTemplate', 'forms/article-category-info-sub.tpl');
    }

    public function afterFill() {
        $this->_renderer->assign('header', 'Kategoria (publicystyka)');

        // authors
        $oAuthors = Dao::collection('user');
        
        $this->_renderer->assign('authors', $oAuthors->getAuthors());
    }
}