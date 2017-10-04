<?php

namespace Ivy\Traits;

trait ArticleSections {
    protected function _getSections() {
        $sections = [
            'article' => [
                'name' => '_Gry',
                'icon' => 'icon-game'
            ],
            'story' => [
                'name' => '_Publicystyka',
                'icon' => 'icon-article'
            ]
        ];
        return $sections;
    }
}