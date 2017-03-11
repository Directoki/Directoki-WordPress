<?php


/**
 *
 * @link https://github.com/directoki Directoki Open Source Software
 * @license https://github.com/Directoki/Directoki-WordPress/blob/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2017, JMB Technology Limited, http://jmbtechnology.co.uk/
 */


function Directoki_admin_menu() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    require_once dirname(__FILE__).DIRECTORY_SEPARATOR."database.php";

    echo '<div class="wrap"><h2>Directoki</h2>';

    if (isset($_POST['action']) && $_POST['action'] == 'newlink') {

        Directoki_admin_process_new_link();

        print '<p>Done</p>';

        print Directoki_admin_returnToMenuHTML();

    } else {


    // ##################################################### Normal Page
        $links = Directoki_db_getCurrentLinks();

        if ($links) {
            /** @var DirectokiModelLink $link */
            foreach($links as $link) {
                print "<h3>Directoki Link: ".htmlspecialchars($link->getTitle())."</h3>";

                print "<div>Link: ". htmlspecialchars($link->getDirectokiURL()) . " / " . htmlspecialchars($link->getDirectokiProject()) . " / " .htmlspecialchars($link->getDirectokiDirectory()) . " <=> " . htmlspecialchars($link->getWordPressPostType())."</div>";



            }
        } else {
            echo '<p>No Links</p>';
        }


        print '<h3>New Link</h3>';
        print '<form action="" method="post"><input type="hidden" name="action" value="newlink">';
        print '<div><label>Title: <input type="text" name="title"></label></div>';
        print '<div>New Directoki URL: <input type="text" name="d_url"></div>';
        print '<div>New Directoki Project: <input type="text" name="d_project"></div>';
        print '<div>New Directoki Directory: <input type="text" name="d_directory"></div>';
        print '<div>Post Type: <select name="wp_posttype">';
        foreach(get_post_types() as $postType) {
            print '<option value="'.$postType.'">'.$postType.'</option>'; // TODO ESCAPE
        }
        print '</select></div>';
        print '<input type="submit" value="Create">';
        print '</form>';

    }


    echo '</div>';
}

function Directoki_admin_process_new_link() {
    $link = new DirectokiModelLink();
    $link->setTitle($_POST['title']);
    $link->setDirectokiURL($_POST['d_url']);
    $link->setDirectokiProject($_POST['d_project']);
    $link->setDirectokiDirectory($_POST['d_directory']);
    // TODO check type in get_post_types
    $link->setWordPressPostType($_POST['wp_posttype']);
    return Directoki_db_newLink($link);
}

function Directoki_admin_returnToMenuHTML() {
    $url = admin_url('options-general.php?page=directoki-admin-menu');
    return '<p><a href="'.$url.'">Back to Direcotki settings</a></p>';
}
