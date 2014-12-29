<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payload
 * 
 * 
 * @author roger_calderini (Time Core - Nucleo Digital - Grupo RBS)
 */
class Payload {

    private $_payload;

    /**
     * Construct
     * 
     * @param json $rawPlayload
     */
    public function __construct($rawPlayload) {
        $this->_payload = json_decode($rawPlayload);

        if ($this->_payload === null) {
            throw new Exception('Failed to decode JSON: ' .
            function_exists('json_last_error_msg') ? json_last_error_msg() : json_last_error());
        }

        // Ping event only has 'hook' info
        if (!isset($this->_payload->repository) && $this->_eventType !== 'ping') {
            throw new Exception('Missing repository information.');
        }
    }
    
    /**
     * Get Payload
     * 
     * @return String
     */
    public function getPayload() {
        return $this->_payload;
    }

    /**
     * Get Repository Name 
     * 
     * "repository": {"name": "test"} 
     *
     * @return String
     */
    public function getRepositoryName() {
        return $this->_payload->repository->name;
    }

    /**
     * Get Full Name repository 
     * 
     * "repository": {"full_name": "rcalderini/test"}       
     *
     * @return String
     */
    public function getRepositoryFullName() {
        $this->_payload->repository->full_name;
    }

    /**
     * Get Url git 
     * 
     * "repository": {"git_url": "git://github.com/rcalderini/test.git"}       
     *
     * @return String
     */
    public function getRepositoryGitUrl() {
        $this->_payload->repository->git_url;
    }

    /**
     * Get Url SSH  
     * 
     * "repository": {"ssh_url": "git@github.com:rcalderini/test.git"}       
     *
     * @return String
     */
    public function getRepositorySshUrl() {
        $this->_payload->repository->ssh_url;
    }

    /**
     * Get Url Clone 
     * 
     * "repository": {"clone_url": "https://github.com/rcalderini/test.git"}       
     *
     * @return String
     */
    public function getRepositoryCloneUrl() {
        $this->_payload->repository->clone_url;
    }

}
