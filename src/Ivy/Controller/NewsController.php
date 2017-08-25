<?php

namespace Ivy\Controller;

use Aya\Core\Dao;
use Aya\Helper\ValueMapper;

use Ivy\Helper\RssFeedGenerator;

class NewsController extends FrontController {

    public function afterInsert($mId) {
        // ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        $this->_handleImages($mId);

        $this->_createRssFeed();

        $this->_clearStreamCache('news');
    }

    public function afterUpdate($mId) {
        // ImageFragment::handleImageFragment($mId, 'logo', 1, $this->getCtrlName());
        $this->_handleImages($mId);

        $this->_createRssFeed();

        $this->_clearStreamCache('news');
    }

    private function _handleImages($mId) {
        $aImgs =  isset($_POST['imgs']) ? $_POST['imgs'] : null;

        if ($aImgs) {
            // ...
            $aFirstImage = current($aImgs);
            $sNewsPath = dirname($aFirstImage[0]);
            // maybe need to rename news dir
            $sNewsDir = basename($sNewsPath);
            if ($sNewsDir == 'tmp-'.$_SESSION['user']['id']) {
                $sSrc = SITE_DIR . '' . $sNewsPath;
                $sDest = str_replace($sNewsDir, $mId, $sSrc);
                
                // rename news dir
                rename($sSrc, $sDest);
            }

            // add new images
            if (isset($aImgs['new'])) {
                $oNewsImageEntity = Dao::entity('news-image', 0, 'id_news_image');
                foreach ($aImgs['new'] as $img) {
                    $oNewsImageEntity->setField('id_news', $mId);
                    if ($sNewsDir == 'tmp-'.$_SESSION['user']['id']) {
                        $oNewsImageEntity->setField('name', str_replace($sNewsDir, $mId, $img));
                    } else {
                        $oNewsImageEntity->setField('name', $img);                        
                    }
                    $oNewsImageEntity->setField('mime', 'jpg');

                    if ($iId = $oNewsImageEntity->insert(true)) {
    
                    }
                }
            }
            // change used images
            if (isset($aImgs['used'])) {
                // maybe rearrange
            }

            // delete images
            // if (isset($aImgs['del'])) {
            // }
            
            // print_r($aImgs);
            

            
        }
    }

    private function _createRssFeed() {
        // echo 'create RSS Feed';

        // require_once ROOT_DIR . '/app/helpers/RssFeedGenerator.php';

        $oNewsCollection = Dao::collection('news');
        $aNews = $oNewsCollection->getNewsForRssFeed(10);

        // ksort($aActivities)
        foreach ($aNews as &$item) {
            // rss
            $item['title'] = stripslashes($item['title']);
            $item['link'] = SITE_URL . '/' . ValueMapper::getUrl('news').'/'.str_replace('-', '/', substr($item['creation_date'], 0, 10)).'/'.$item['slug'];
            $item['description'] = strip_tags(stripslashes($item['markup']));

            $objDateTime = new \DateTime($item['creation_date']);

            $item['pubdate'] = $objDateTime->format(\DateTime::RSS);
        }



        // RssFeedGenerator::create('news', 10);

        RssFeedGenerator::create($aNews);

        RssFeedGenerator::save(SITE_DIR . '/rss.xml');

    }
}