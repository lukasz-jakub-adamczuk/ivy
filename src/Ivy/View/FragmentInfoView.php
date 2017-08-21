<?php

namespace Ivy\View;

use Aya\Core\Dao;
use Aya\Management\InfoView;

use Symfony\Component\Yaml\Yaml;

class FragmentInfoView extends InfoView {

    private $_mFragmentTypeId = 0;

    public function postProcessDataset($aFields) {
        if (isset($aFields['id_fragment_type'])) {
            $this->_mFragmentTypeId = $aFields['id_fragment_type'];
        };
        // echo 'a';

        if (isset($aFields['fragment'])) {

            // $filename = APP_DIR . '/langs/pl/tables/'.$_GET['ctrl'].'.yml';
            // if (file_exists($filename)) {
                $aFragment = Yaml::parse($aFields['fragment']);
            // }
                // $aFragment = json_decode($aFields['fragment'], true);

                // print_r($aFragment);

                $this->_renderer->assign('aFragment', $aFragment);
        }
        return $aFields;

        // <select id="form-fragment-type" name="dataset[id_fragment_type]">
        //     <option value="2" disabled="">Obraz (tło)</option>
        //     <option value="3" selected="selected">Informacje (gra)</option>
        //     <option value="1" disabled="">Obraz (logotyp)</option>
        //     <option value="4" disabled="">Informacje (album)</option>
        //     <option value="5" disabled="">Komunikat</option>
        // </select>
    }

    public function afterFill() {
        $iId = isset($_GET['id']) ? $_GET['id'] : 0;

        // authors
        $oAuthors = Dao::collection('user');
        $this->_renderer->assign('aAuthors', $oAuthors->getAuthors());

        // categories
        $oFragmentTypes = Dao::collection('FragmentType');
        // print_r($oFragmentTypes);

        $this->_renderer->assign('aFragmentTypes', $oFragmentTypes->getFragmentTypes());

        // dictionaries
        $sFilename = APP_DIR . '/langs/pl/dictionaries/fragment-info.yml';
        if (file_exists($sFilename)) {
            $aDictionaries = Yaml::parse(file_get_contents($sFilename));

            $aPlatforms = array();
            foreach ($aDictionaries['system'] as $ck => $console) {
                $aPlatforms[$console['group']][$ck] = $console; 
            }

            $this->_renderer->assign('aPlatforms', $aPlatforms);
        }
        $this->_renderer->assign('aDictionaries', $aDictionaries);

        // object and fragment relation
        $oObjectFragments = Dao::collection('object-fragment');
        $aRelations = $oObjectFragments->getFragmentRelations($iId);

        $this->_renderer->assign('aRelations', $aRelations);
        // print_r(current($aRelations));

        // articles
        $oArticles = Dao::collection('article');
        // logo-image, info-game
        if ($this->_mFragmentTypeId == 1 || $this->_mFragmentTypeId == 3) {
            $this->_renderer->assign('aArticles', $oArticles->getArticlesByTitle('Wstęp'));
        }
        // cover-image
        if ($this->_mFragmentTypeId == 2) {
            $this->_renderer->assign('aArticles', $oArticles->getArticlesByTitle('Wstep', true));
        }
        // music-game
        if ($this->_mFragmentTypeId == 4) {
            $this->_renderer->assign('aArticles', $oArticles->getArticlesByTitle('Soundtrack'));
        }
        // notice
        if ($this->_mFragmentTypeId == 5) {
            $this->_renderer->assign('aArticles', $oArticles->getArticles());
        }
        
        
    }
}