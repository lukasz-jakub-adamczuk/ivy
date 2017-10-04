<?php

namespace Ivy\View;

trait ArticleSectionsTrait {
    protected function _getSections() {
        $sections = [
            'article' => [
                'name' => 'Gry',
                'icon' => 'icon-game'
            ],
            'story' => [
                'name' => 'Publicystyka',
                'icon' => 'icon-article'
            ]
        ];
        return $sections;
    }
}