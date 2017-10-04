<?php

namespace Ivy\View;

use Aya\Mvc\InfoView;

class CupInfoView extends InfoView {

    public function afterFill() {
        $this->_renderer->assign('header', 'Zawodnik');
        // unset($_SESSION['_nav_']);

        $mId = isset($_GET['id']) ? $_GET['id'] : 0;
    }
}