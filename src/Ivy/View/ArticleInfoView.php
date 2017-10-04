<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;
use Aya\Helper\ValueMapper;

class ArticleInfoView extends InfoView {

    public function afterFill() {
        $this->_renderer->assign('header', 'Artykuł (gra)');
        // unset($_SESSION['_nav_']);

        $mId = isset($_GET['id']) ? $_GET['id'] : 0;

        // authors
        $authors = Dao::collection('user');
        $this->_renderer->assign('authors', $authors->getAuthors());

        // categories
        $categories = Dao::collection('article-category');
        $this->_renderer->assign('categories', $categories->getCategories());

        // templates
        $templates = Dao::collection('article-template');
        $this->_renderer->assign('templates', $templates->getTemplates());

        if ($mId) {
            // preview
            $aPreviewer = array();
            // $aPreviewer['url'] = SITE_URL . '/{#$ctrl#}/{$categories[$aFields.id_article_category].slug}/{$aFields.slug}';
            // $aPreviewer['url'] = SITE_URL . '/gry/category/slug';
            // TODO REFACTOR
            // need to make ctrl independent
            $aPreviewer['pattern'] = SITE_URL . '/ctrl/category/slug';
            $aPreviewer['url'] = [
                'ctrl' => 'gry',
                'category' => 'id_article_category',
                'slug' => 'slug'
            ];

            $aPreviewer['label'] = 'zobacz treść na stronie';
            $this->_renderer->assign('aPreviewer', $aPreviewer);

            // changelogs
            $oChangeLogs = Dao::collection('change-log');
            $this->_renderer->assign('aChangeLogs', $oChangeLogs->getChangeLogs('article', $mId));

            // fragment image
            $fragmentImage = array();

            // logo image
            $logoImage = Dao::entity('object-fragment');
            $fragmentImage['logo'] = $logoImage->getImageFragment('article', $mId, 1);

            // cover image
            $coverImage = Dao::entity('object-fragment');
            $fragmentImage['cover'] = $coverImage->getImageFragment('article', $mId, 2);

            $this->_renderer->assign('fragmentImage', $fragmentImage);
        }
    }
}