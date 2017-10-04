<?php

namespace Ivy\Helper;

class RelatedActions {

    private static $_aActions = array(
        'refresh' => array(
            'name' => 'Odśwież',
            'href' => '{$ctrl}',
            'icon' => 'refresh',
            'class' => 'btn btn-outline-secondary',
            'title' => 'Odśwież'
        ),
        'order' => array(
            'name' => 'Zmień kolejność',
            'href' => '{$ctrl}/order',
            'icon' => 'order',
            'class' => 'btn btn-outline-secondary',
            'title' => 'Zmień kolejność'
        ),
        'add' => array(
            'name' => 'Dodaj',
            'href' => '{$ctrl}/add',
            'icon' => 'add',
            'class' => 'btn btn-outline-primary',
            'title' => 'Dodaj',
        )
    );

    static public function getStandardActions() {
        return self::getActions(array('add'));
    }

    static public function getActions($aConf) {
        $aActions = array();
        foreach ($aConf as $action => $ak) {
            $aActions[$ak] = self::$_aActions[$ak];
        }
        return $aActions;
    }
}