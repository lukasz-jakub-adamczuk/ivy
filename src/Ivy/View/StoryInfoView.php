<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

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
            // preview
            $aPreviewer = array();
            // $aPreviewer['url'] = SITE_URL . '/{#$ctrl#}/{$aCategories[$aFields.id_article_category].slug}/{$aFields.slug}';
            // $aPreviewer['url'] = SITE_URL . '/gry/category/slug';
            // TODO REFACTOR
            // need to make ctrl independent
            $aPreviewer['pattern'] = SITE_URL . '/ctrl/category/slug';
            $aPreviewer['url'] = [
                'ctrl' => 'gry',
                'category' => 'id_story_category',
                'slug' => 'slug'
            ];

            $aPreviewer['label'] = 'zobacz treść na stronie';
            $this->_renderer->assign('aPreviewer', $aPreviewer);
            
            // changelogs
            $oChangeLogs = Dao::collection('change-log');
            $this->_renderer->assign('aChangeLogs', $oChangeLogs->getChangeLogs('story', $mId));

            // fragment image
            $aFragmentImage = array();
            
            // logo image
            $oLogoImage = Dao::entity('object-fragment');
            $aFragmentImage['logo'] = $oLogoImage->getImageFragment('story', $mId, 1);

            // cover image
            $oCoverImage = Dao::entity('object-fragment');
            $aFragmentImage['cover'] = $oCoverImage->getImageFragment('story', $mId, 2);

            $this->_renderer->assign('aFragmentImage', $aFragmentImage);
        }
    }
}