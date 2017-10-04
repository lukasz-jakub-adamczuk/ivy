<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

class NewsInfoView extends InfoView {

    public function beforeFill() {
        $this->_renderer->assign('header', 'Aktualność');

        $mId = isset($_GET['id']) ? $_GET['id'] : 0;

        // authors
        $oAuthors = Dao::collection('user');
        $this->_renderer->assign('authors', $oAuthors->getAuthors());

        if ($mId) {
            // changelogs
            $oChangeLogs = Dao::collection('change-log');
            $this->_renderer->assign('aChangeLogs', $oChangeLogs->getChangeLogs('news', $mId));

            // images
            $oNewsImages = Dao::collection('news-image');
            $aImages = $oNewsImages->getNewsImagesById($mId);

            if ($aImages) {
                $this->_renderer->assign('aImages', $oNewsImages->getNewsImagesById($mId));
                $this->_renderer->assign('iGalleryImagesTotal', count($aImages));
            }
        }
    }
}