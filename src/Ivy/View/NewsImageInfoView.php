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
        
        // $this->_renderer->assign('aAuthors', $oAuthors->getAuthors());

        // categories
        // $oCategories = Dao::collection('article-category');
        // $oCategories->orderby('name');
        // $oCategories->load(-1);

        // $this->_renderer->assign('aCategories', $oCategories->getRows());



        // templates

        $mId = isset($_GET['id']) ? $_GET['id'] : 0;

        

        // temporary walkaround
        // $sBasePath = SITE_DIR . '/pub';
        // $sBasePath = WEB_DIR;
        
        $sPath = isset($_GET['path']) ? $_GET['path'] : '';

        // ???
        $sUrl = '/' . str_replace(',', '/', $sPath);
        // echo $sUrl;
        $this->_renderer->assign('sUrl', $sUrl);

        // $aPath = explode(',', $sPath);
        // foreach ($aPath as $pk => $path) {
        //     $tmp[] = $path;
        //     $aPathItems[] = array('url' => implode(',', $tmp), 'name' => $path);
        // }

        // images for news
        $oImages = Dao::collection('news-image');

        $oImages->where('id_news', $mId);
        $oImages->load(-1);

        $aImages = $oImages->getRows();

        $sContentPath = WEB_DIR . $sUrl;

        // $aAllContent = Folder::getContent($sContentPath, false);
        // $aImages = $aAllContent['files'];

        // print_r($aImages);

        $this->_renderer->assign('aImages', $aImages);
    }
}