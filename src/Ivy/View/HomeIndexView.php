<?php

namespace Ivy\View;

use Aya\Management\IndexView;

use Symfony\Component\Yaml\Yaml;

class HomeIndexView extends IndexView {

    public function fill() {
        // home descriptions
        $aDescriptions = array();
        $aDescriptions['news'] = 'Krótkie wpisy na temat bieżących wydarzeń, planowanych premier, plotek o grach, publikacji nowych treści na stronie. Jednym słowem wszystko, dotyczące Square Enix, co zainteresuje naszych odbiorców.';
        $aDescriptions['article'] = 'Artykuły ściśle związane z grami, głównie recenzje, opisy, ale także dokładniejsze i szczegółowe analizy dotyczące kwestii technicznych.';
        $aDescriptions['story'] = 'Teksty luźno związane z grami, jak opowiadania, osobiste przemyślenia i analizy konkretnych zjawisk. Wszystko w granicach rozsądku.';
        $aDescriptions['verdict'] = 'Oceny recenzentów i redaktorów dotyczące recenzji gier, ale także ścieżek dzwiękowych i różnych produktów, które zostały opisane.';
        $aDescriptions['fragment'] = 'Krótkie treści różnego typu używane w artykułach. Fragmenty pozwalają na dodawanie komunikatów, obrazów, list informacyjnych i wielu innych elementów.';
        $aDescriptions['comment'] = 'Opinie czytelników na temat dostępnych treści, w tym aktualności, gier, artykułów, galerii, a także samych użytkowników.';
        $aDescriptions['lobby'] = 'Treści wysłane przez użytkowników. Propozycje poprawek do wprowadzenia w artykułach o grach i publicystyce.';
        $aDescriptions['file-manager'] = 'Menadżer plików, które są wykorzystywane na stronie. Dostęp do katalogów publicznych, z możliwością dodawania, eycji i usuwania plików.';
        $aDescriptions['user'] = 'Informacje o użytkownikach serwisu, ich aktywności i zdobytych trofeach.';
        $aDescriptions['cup'] = 'Informacje o turniejach, zawodnikach i pojedynkach.';
        $this->_renderer->assign('aDescriptions', $aDescriptions);

        // $sYamlParserPath = ROOT_DIR . '/../XhtmlTable/Aya/Yaml/AyaYamlLoader.php';
        // echo $sYamlParserPath;
        // require_once $sYamlParserPath;

        $sConfFile = APP_DIR . '/conf/home.yml';
        $aHomeBoxes = Yaml::parse(file_get_contents($sConfFile));

        // print_r($aHomeBoxes);
        $this->_renderer->assign('aHomeBoxes', $aHomeBoxes['boxes']);
        
    }
}