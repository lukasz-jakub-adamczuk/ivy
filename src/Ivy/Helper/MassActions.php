<?php

namespace Ivy\Helper;

use Aya\Core\User;

class MassActions {

    private static $_aActions = array(
        'delete' => array(
            'name' => 'Usuń',
            'icon' => 'delete',
            'class' => 'btn btn-outline-secondary',
            'title' => 'Usuń'
        ),
        'remove' => array(
            'name' => 'USUŃ',
            'icon' => 'remove',
            'class' => 'btn btn-outline-danger',
            'title' => 'Usuń',
            'color' => 'red'
        ),
        'mark' => array(
            'name' => 'Oznacz',
            'icon' => 'done',
            'class' => 'btn btn-outline-secondary',
            'title' => 'Oznacz jako przeczytane'
        ),
    );

    static public function getStandardActions() {
        if (User::atLeast('moderator')) {
            return self::getActions(array('delete', 'remove'));
        }
        if (User::atLeast('editor')) {
            return self::getActions(array('delete'));
        }
    }

    static public function getActions($aConf) {
        $aActions = array();
        foreach ($aConf as $action => $ak) {
            $aActions[$ak] = self::$_aActions[$ak];
        }
        return $aActions;
    }
}