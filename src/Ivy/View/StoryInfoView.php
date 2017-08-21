<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\InfoView;

class StoryInfoView extends InfoView {

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Artykuł (publicystyka)');

        $mId = isset($_GET['id']) ? $_GET['id'] : 0;

        // authors
        $oAuthors = Dao::collection('user');
        $this->_renderer->assign('aAuthors', $oAuthors->getAuthors());

        // categories
        $oCategories = Dao::collection('story-category');
        $this->_renderer->assign('aCategories', $oCategories->getCategories());

        // templates
        // $oTemplates = Dao::collection('article-template');
        // $this->_renderer->assign('aTemplates', $oTemplates->getTemplates());
        
        if ($mId) {
            // changelogs
            $oChangeLogs = Dao::collection('change-log');
            $this->_renderer->assign('aChangeLogs', $oChangeLogs->getChangeLogs('story', $mId));

            // logo image
            $oLogoImage = Dao::entity('object-fragment');
            $this->_renderer->assign('aLogoImage', $oLogoImage->getImageFragment('story', $mId, 1));

            // cover image
            $oCoverImage = Dao::entity('object-fragment');
            $this->_renderer->assign('aCoverImage', $oCoverImage->getImageFragment('story', $mId, 2));
        }
    }
}