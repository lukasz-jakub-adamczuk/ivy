<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Core\Folder;
use Aya\Management\InfoView;

class ArticleCategoryInfoView extends InfoView {

    public function postProcessDataset($aFields) {
        // gallery
        $sCompletePath = SITE_DIR . '/pub/assets/games/'.$aFields['abbr'].'/imgs';
        $aAllContent = Folder::getContent($sCompletePath, true);

        $this->_renderer->assign('iGalleryImagesTotal', count($aAllContent['files']));

        return $aFields;
    }

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Kategoria (gra)');

        // authors
        $oAuthors = Dao::collection('user');
        $this->_renderer->assign('aAuthors', $oAuthors->getAuthors());
    }
}