<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;

class CupPlayerInfoView extends InfoView {

    public function afterFill() {
        $this->_renderer->assign('header', 'Zawodnik');
        // unset($_SESSION['_nav_']);

        $mId = isset($_GET['id']) ? $_GET['id'] : 0;

        // authors
        // $oAuthors = Dao::collection('user');
        // $this->_renderer->assign('authors', $oAuthors->getAuthors());

        // // categories
        // $oCategories = Dao::collection('article-category');
        // $this->_renderer->assign('categories', $oCategories->getCategories());

        // // templates
        // $oTemplates = Dao::collection('article-template');
        // $this->_renderer->assign('templates', $oTemplates->getTemplates());

        if ($mId) {
            // preview
            $aPreviewer = array();
            // // $aPreviewer['url'] = SITE_URL . '/{#$ctrl#}/{$categories[$aFields.id_article_category].slug}/{$aFields.slug}';
            // $aPreviewer['url'] = SITE_URL . '/gry/category/slug';
            // $aPreviewer['pattern'] = SITE_URL . '/'.ValueMapper::getUrl('article').'/{category}/{slug}';
            // $aPreviewer['label'] = 'zobacz treść na stronie';
            // $this->_renderer->assign('aPreviewer', $aPreviewer);

            // // changelogs
            // $oChangeLogs = Dao::collection('change-log');
            // $this->_renderer->assign('aChangeLogs', $oChangeLogs->getChangeLogs('article', $mId));

            // // fragment image
            // $fragmentImage = array();

            // // logo image
            // $oLogoImage = Dao::entity('object-fragment');
            // $fragmentImage['logo'] = $oLogoImage->getImageFragment('article', $mId, 1);

            // // cover image
            // $oCoverImage = Dao::entity('object-fragment');
            // $fragmentImage['cover'] = $oCoverImage->getImageFragment('article', $mId, 2);

            // $this->_renderer->assign('fragmentImage', $fragmentImage);
        }
    }
}