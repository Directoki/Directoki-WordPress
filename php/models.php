<?php

/**
 *
 * @link https://github.com/directoki Directoki Open Source Software
 * @license https://github.com/Directoki/Directoki-WordPress/blob/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2017, JMB Technology Limited, http://jmbtechnology.co.uk/
 */

class DirectokiModelLink {

    protected $id;
    protected $title;
    protected $directokiURL;
    protected $directokiProject;
    protected $directokiDirectory;
    protected $wordPressPostType;

    /**
     * @return mixed
     */
    public function getDirectokiDirectory() {
        return $this->directokiDirectory;
    }

    /**
     * @param mixed $directokiDirectory
     */
    public function setDirectokiDirectory( $directokiDirectory ) {
        $this->directokiDirectory = $directokiDirectory;
    }

    /**
     * @return mixed
     */
    public function getDirectokiProject() {
        return $this->directokiProject;
    }

    /**
     * @param mixed $directokiProject
     */
    public function setDirectokiProject( $directokiProject ) {
        $this->directokiProject = $directokiProject;
    }

    /**
     * @return mixed
     */
    public function getDirectokiURL() {
        return $this->directokiURL;
    }

    /**
     * @param mixed $directokiURL
     */
    public function setDirectokiURL( $directokiURL ) {
        $this->directokiURL = $directokiURL;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId( $id ) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle( $title ) {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getWordPressPostType() {
        return $this->wordPressPostType;
    }

    /**
     * @param mixed $wordPressPostType
     */
    public function setWordPressPostType( $wordPressPostType ) {
        $this->wordPressPostType = $wordPressPostType;
    }


    public function getListRecordsURL() {
        return $this->directokiURL . '/api1/project/'.
               $this->directokiProject.'/directory/'.
               $this->directokiDirectory.'/records.json';
    }

    public function getRecordURL($recordID) {
        return $this->directokiURL . '/api1/project/'.
               $this->directokiProject.'/directory/'.
               $this->directokiDirectory.'/record/'.
               $recordID.'/index.json';
    }

}

class DirectokiField {

    protected $data;


    public function __construct( $data ) {
        $this->data = $data;
    }

    public function getTitle() {
        return $this->data->title;
    }

    public function getValue() {
        // TODO This must account for different types
        return $this->data->value->value;
    }
}

