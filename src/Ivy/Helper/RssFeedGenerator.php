<?php

namespace Ivy\Helper;

class RssFeedGenerator {

    private static $_sFeed;

    // public static function create($sType, $sLimit = 20) {
    public static function create($aNews) {
        // last news
        $aRecentNews = current($aNews);

        $aRss = array();

        // config
        $aRss['title'] = 'Squarezone - Aktualności';
        $aRss['description'] = 'Squarezone - polska strona o Square Enix oraz jRPG.';
        $aRss['link'] = 'http://squarezone.pl';
        $aRss['lastbuilddate'] = $aRecentNews['pubdate'];
        $aRss['generator'] = 'generator';

        $aRss['image'] = array();
        $aRss['image']['url'] = SITE_URL . '/favicon.png';
        $aRss['image']['title'] = 'title';
        $aRss['image']['link'] = SITE_URL;
        $aRss['image']['description'] = 'get from meta...';

        $sItems = '';

        foreach ($aNews as $item) {
            $sItems .= '<item>
            <title>'.$item['title'].'</title>
            <link>'.$item['link'].'</link>
            <description>'.$item['description'].'</description>
            <pubDate>'.$item['pubdate'].'</pubDate>
        </item>';
        }

        self::$_sFeed = '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>'.$aRss['title'].'</title>
        <description>'.$aRss['description'].'</description>
        <link>'.$aRss['link'].'</link>
        <lastBuildDate>'.$aRss['lastbuilddate'].'</lastBuildDate>
        <generator>'.$aRss['generator'].'</generator>
        <image>
            <url>'.$aRss['image']['url'].'</url>
            <title>squarezone.pl logo</title>
            <link>'.$aRss['image']['link'].'</link>
            <description>'.$aRss['image']['description'].'</description>
        </image>'
        .$sItems
        .'
    </channel>
</rss>';
    }

    public static function save($sFile) {
        file_put_contents($sFile, self::$_sFeed);
    }

    // priave methods
    private static function _handleFileTransfer($sTransfer) {
        
    }
}