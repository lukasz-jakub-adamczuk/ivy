<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

class ArticleVerdictInfoView extends InfoView {

    public function postProccessDataset($aFields) {
        // if () {
        // $aFields['features'] = json_encode(unserialize($aFields['features']));
        // }
        return $aFields;
    }

    public function afterFill() {
        // authors
        $oAuthors = Dao::collection('user');
        
        $this->_renderer->assign('aAuthors', $oAuthors->getAuthors());

        // articles
        $oArticles = Dao::collection('article');
        // $oArticles->orderby('article.name');
        // $oArticles->search('article.title', 'Recenzja');
        // $oArticles->load(-1);

        // $this->_renderer->assign('aArticles', $oArticles->getRows());
        $this->_renderer->assign('aArticles', $oArticles->getArticlesByTitle('Recenzja'));

        // verdict signs
        $aVerdictSigns = array('NULL' => 'Pełna ocena', 'plus' => 'Plus', 'minus' => 'Minus');
        $this->_renderer->assign('aVerdictSigns', $aVerdictSigns);        
    }
}