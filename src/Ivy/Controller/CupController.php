<?php

namespace Ivy\Controller;

class CupController extends FrontController {

    public function afterInsert($mId) {
        $aPost = $this->preInsert();

        // print_r($aPost['tournament']);

        $oDb = Db::getInstance();

        // generate players
        if (isset($aPost['tournament']['creation_date']) && isset($aPost['tournament']['groups']) && isset($aPost['tournament']['players'])) {
            // 'add tournament players' initial sql
            $sql = 'INSERT INTO cup_player(`id_cup`, `name`, `slug`, `group`) VALUES';
            // letters for groups
            $aLetters = range('A', 'Z');

            $aValues = array();

            $iGroups = (int)$aPost['tournament']['groups'];
            $iPlayers = (int)$aPost['tournament']['players'];

            $iSingleGroupPlayers = $iPlayers / $iGroups; // players in one group

            $group = 0;
            // checking does single group integer
            if (($iSingleGroupPlayers * $iGroups) == $iPlayers) {
                for ($i = 0; $i < $iPlayers; $i++) {
                    if ($i > 0 && ($i % $iSingleGroupPlayers) == 0) {
                        $group++;
                    }
                    $aValues[] = '('.$mId.', "Player'.($i+1).'", "player'.($i+1).'", "'.$aLetters[$group].'")';
                }

            }

            // 'add tournament players' final sql
            $sql .= implode(',', $aValues);

            if ($oDb->execute($sql) !== false) {

                // 'add tournament matches' initial sql

                // getting players
                $aPlayers = $oDb->getArray('SELECT id_cup_player FROM cup_player WHERE id_cup="'.$mId.'" ');

                // echo 'players';
                // print_r($aPlayers);

                // echo '$iPlayers:'.$iPlayers;
                // echo '$iGroups:'.$iGroups;

                // group matches
                $iOneGroupMatches = ($iSingleGroupPlayers * ($iSingleGroupPlayers - 1)) / 2;
                $iAllGroupMatches = $iOneGroupMatches * $iGroups;

                // echo '$iOneGroupMatches: '.$iOneGroupMatches;
                // echo '$iAllGroupMatches: '.$iAllGroupMatches;

                // 'add group matches' initial sql
                $sql = 'INSERT INTO cup_battle(`id_cup_battle`, `id_cup`, `player1`, `player2`) VALUES';

                // for 8 groups with 32 players
                $aMatchesDefinitions = array(
                    array('0-1', '2-3'),
                    array('0-2', '3-1'),
                    array('3-0', '1-2')
                );
                
                $iRounds = $iOneGroupMatches / ($iSingleGroupPlayers / 2);
                $oDate = date_create($aPost['tournament']['creation_date']);

                // echo $iRounds;

                // echo '$iOneGroupMatches:  '.$iOneGroupMatches;
                // echo '$iSingleGroupPlayers'.$iSingleGroupPlayers;

                $aMatches = array();
                // temporary fix
                $aUpdates = array();

                // group matches
                for ($i = 0; $i < $iRounds; $i++) {
                    for ($j = 0; $j < $iGroups; $j++) {
                        for ($k = 0; $k < ($iSingleGroupPlayers / 2); $k++) {
                            // date
                            $sDate = date_format($oDate, 'Y-m-d');

                            // players
                            $aMatchParts = explode('-', $aMatchesDefinitions[$i][$k]);
                            $iPlayer1 = ($j * $iSingleGroupPlayers) + $aMatchParts[0];
                            $iPlayer2 = ($j * $iSingleGroupPlayers) + $aMatchParts[1];
                            
                            // match
                            $aMatches[] = '("'.$sDate.'", "'.$mId.'", "'.$aPlayers[$iPlayer1]['id_cup_player'].'", "'.$aPlayers[$iPlayer2]['id_cup_player'].'")';

                            $aUpdates[] = 'UPDATE cup_battle SET player1="'.$aPlayers[$iPlayer1]['id_cup_player'].'", player2="'.$aPlayers[$iPlayer2]['id_cup_player'].'" WHERE id_cup_battle="'.$sDate.'"'; 

                            date_modify($oDate, '+1 day');
                        }
                    }
                }
                // 'add tournament matches' final sql
                $sql .= implode(',', $aMatches);
                // 
                // echo implode('; ', $aUpdates);

                // print_r($aMatches);

                if ($oDb->execute($sql) == false) {
                    $this->raiseError('Błąd podczas dodawania meczów grupowych.');
                }

                $aMatches = array();

                // 'add tournament matches' initial sql
                $sql = 'INSERT INTO cup_battle(`id_cup_battle`, `id_cup`) VALUES';
                
                for ($i = 0; $i < 16; $i++) {
                    // date
                    $sDate = date_format($oDate, 'Y-m-d');

                    $aMatches[] = '("'.$sDate.'", "'.$mId.'")';

                    date_modify($oDate, '+1 day');
                }
                // 'add tournament matches' final sql
                $sql .= implode(',', $aMatches);

                if ($oDb->execute($sql) == false) {
                    $this->raiseError('Błąd podczas dodawania meczów pucharowych.');
                }

                $this->raiseInfo('Zawodnicy i mecze turnieju zostały stworzone.');
                // Message::raiseInfo('all fine');

            } else {
                $this->raiseError('Błąd podczas dodawania zawodników turnieju.');
            }
        }
    }
}