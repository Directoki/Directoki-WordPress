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
        'd_base_url'=>trim($directokiModelLink->getDirectokiURL()),
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
        $link->setDirectokiURL($data['d_base_url']);
        $link->setDirectokiProject($data['d_project']);
        $link->setDirectokiDirectory($data['d_directory']);
        $link->setWordPressPostType($data['wp_post_type']);
        $out[] = $link;
    }
    return $out;
}

function Directoki_db_getLink($id) {
    global $wpdb;
    $data = $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."directoki_link WHERE id=%d", $id)
        ,ARRAY_A);
    $link = new DirectokiModelLink();
    $link->setId($data['id']);
    $link->setTitle($data['title']);
    $link->setDirectokiURL($data['d_base_url']);
    $link->setDirectokiProject($data['d_project']);
    $link->setDirectokiDirectory($data['d_directory']);
    $link->setWordPressPostType($data['wp_post_type']);
    return $link;
}

function Directoki_db_save_record_link(DirectokiModelLink $directokiModelLink, $recordId, $postId) {
    global $wpdb;
    $wpdb->insert($wpdb->prefix."directoki_record",array(
        'post_id'=>$postId,
        'record_id'=>$recordId,
        'link_id'=>$directokiModelLink->getId(),
    ));
}


function Directoki_db_get_record_link(DirectokiModelLink $directokiModelLink, $recordId) {
    global $wpdb;
    $data = $wpdb->get_row(
        $wpdb->prepare("SELECT post_id FROM ".$wpdb->prefix."directoki_record WHERE link_id=%d AND record_id=%s",
            $directokiModelLink->getId(), $recordId)
        ,ARRAY_A);
    if (is_array($data)) {
        return $data['post_id'];
    } else {
        return null;
    }
}

