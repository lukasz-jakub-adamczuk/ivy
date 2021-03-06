<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Core\View;

class StoryCategoryOrderView extends View {

    private $_iElementsCounter;

    public function fill() {
        $mId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($mId) {
            // articles
            $oArticles = Dao::collection('story');
            
            $aArticles = $oArticles->getArticlesByCategory($mId);
            $this->_renderer->assign('aElements', $aArticles);

            $this->_iElementsCounter = count($aArticles);

            $this->_renderer->assign('sCtrl', 'story');
        } else {
            // categories
            $oCategories = Dao::collection('story-category');
            
            $categories = $oCategories->getCategories();
            $this->_renderer->assign('aElements', $categories);

            $this->_iElementsCounter = count($categories);
        }

        $aOptions = range(1, $this->_iElementsCounter);
        $this->_renderer->assign('aOptions', $aOptions);
    }

    public function afterFill() {
        $mId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($mId) {
            $this->_renderer->assign('header', 'Kolejność artykułów (publicystyka)');
        } else {
            $this->_renderer->assign('header', 'Kolejność kategorii (publicystyka)');
        }
    }
}