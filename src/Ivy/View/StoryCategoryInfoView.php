<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

class StoryCategoryInfoView extends InfoView {

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Kategoria (publicystyka)');

        // authors
        $oAuthors = Dao::collection('user');
        
        $this->_renderer->assign('aAuthors', $oAuthors->getAuthors());
    }
}