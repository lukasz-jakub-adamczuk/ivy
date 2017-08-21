<?php

namespace Ivy\View;

use Aya\Management\InfoView;

class CupInfoView extends InfoView {

    public function afterFill() {
        $this->_renderer->assign('sHeader', 'Zawodnik');
        // unset($_SESSION['_nav_']);

        $mId = isset($_GET['id']) ? $_GET['id'] : 0;
    }
}