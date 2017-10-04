<?php

namespace Ivy\View;

use Ivy\Helper\RelatedActions;

class ArticleCategoryIndexView extends CategoryIndexView {

    protected function _getRelatedActions() {
        return RelatedActions::getActions(['refresh', 'order', 'add']);
    }
}