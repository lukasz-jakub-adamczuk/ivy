<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Mvc\InfoView;
// use Aya\Mvc\InfoView;
// require_once AYA_DIR.'/Core/Folder.php';

class NewsImageInfoView extends InfoView {

    public function fill() {

    }

    public function afterFill() {
        // authors
        // $oAuthors = Dao::collection('user');
        
        // $this->_renderer->assign('authors', $oAuthors->getAuthors());

        // categories
        // $oCategories = Dao::collection('article-category');
        // $oCategories->orderby('name');
        // $oCategories->load(-1);

        // $this->_renderer->assign('categories', $oCategories->getRows());



        // templates

        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        

        // temporary walkaround
        // $sBasePath = SITE_DIR . '/pub';
        // $sBasePath = WEB_DIR;
        
        $path = isset($_GET['path']) ? $_GET['path'] : '';

        // ???
        $url = '/' . str_replace(',', '/', $path);
        // echo $url;
        $this->_renderer->assign('url', $url);

        // $aPath = explode(',', $path);
        // foreach ($aPath as $pk => $path) {
        //     $tmp[] = $path;
        //     $aPathItems[] = array('url' => implode(',', $tmp), 'name' => $path);
        // }

        // images for news
        $images = Dao::collection('news-image');

        $images->where('id_news', $id);
        $images->load(-1);

        // echo 'test';

        // $aImages = $images->getRows();

        // $sContentPath = WEB_DIR . $url;

        // $aAllContent = Folder::getContent($sContentPath, false);
        // $aImages = $aAllContent['files'];

        // print_r($aImages);

        $this->_renderer->assign('aImages', $images->getRows());
    }
}