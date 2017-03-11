<?php


/**
 *
 * @link https://github.com/directoki Directoki Open Source Software
 * @license https://github.com/Directoki/Directoki-WordPress/blob/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2017, JMB Technology Limited, http://jmbtechnology.co.uk/
 */


function Directoki_db_newLink(DirectokiModelLink $directokiModelLink) {
    global $wpdb;
    $wpdb->insert($wpdb->prefix."directoki_link",array(
        'title'=>trim($directokiModelLink->getTitle()),
        'd_baseurl'=>trim($directokiModelLink->getDirectokiURL()),
        'd_project'=>trim($directokiModelLink->getDirectokiProject()),
        'd_directory'=>trim($directokiModelLink->getDirectokiDirectory()),
        'wp_post_type'=>trim($directokiModelLink->getWordPressPostType()),
    ));
    $directokiModelLink->setId($wpdb->insert_id);
    return $directokiModelLink;
}

function Directoki_db_getCurrentLinks() {
    global $wpdb;
    $out = array();

    foreach($wpdb->get_results(
        "SELECT * FROM ".$wpdb->prefix."directoki_link "
        ,ARRAY_A) as $data) {
        $link = new DirectokiModelLink();
        $link->setId($data['id']);
        $link->setTitle($data['title']);
        $link->setDirectokiURL($data['d_baseurl']);
        $link->setDirectokiProject($data['d_project']);
        $link->setDirectokiDirectory($data['d_directory']);
        $link->setWordPressPostType($data['wp_post_type']);
        $out[] = $link;
    }
    return $out;
}

