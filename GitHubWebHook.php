<?php

require_once "./Payload.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GitHubWebHook
 * 
 * 
 * @author roger_calderini (Time Core - Nucleo Digital - Grupo RBS)
 */
class GitHubWebHook {

    /**
     * GitHub's IP mask
     *
     * Get it from https://api.github.com/meta
     */
    const GITHUB_IP_BASE = '192.168.57.5';
    //const GITHUB_IP_BITS = 22;
    //const GITHUB_IP_MASK = -1024;

    private $_eventType;
    private $_payload;
    private $_rawPayload;

    /**
     * Validates and processes current request
     *
     */
    public function processRequest() {

        $this->validateHeaders();

        $this->_eventType = filter_input(INPUT_SERVER, 'HTTP_X_GITHUB_EVENT', FILTER_SANITIZE_STRING);

        $this->loadRawPayload();

        $this->_payload = new Payload($this->_rawPayload);

        return true;
    }

    private function validateHeaders() {
        if (!array_key_exists('HTTP_X_GITHUB_EVENT', $_SERVER)) {
            throw new Exception('Missing X-GitHub-Event header.');
        }

        if (!array_key_exists('REQUEST_METHOD', $_SERVER) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Invalid request method.');
        }

        if (!array_key_exists('CONTENT_TYPE', $_SERVER)) {
            throw new Exception('Missing content type.');
        }
    }

    private function loadRawPayload() {
        $ContentType = $_SERVER['CONTENT_TYPE'];

        if ($ContentType === 'application/x-www-form-urlencoded') {
            if (!array_key_exists('payload', $_POST)) {
                throw new Exception('Missing payload.');
            }

            $this->_rawPayload = filter_input(INPUT_POST, 'payload');
        } else if ($ContentType === 'application/json') {
            $this->_rawPayload = file_get_contents('php://input');
        } else {
            throw new Exception('Unknown content type.');
        }
    }

    /**
     * Optional function to check if request came from GitHub's IP range.
     *
     * @return bool
     */
    public function validateIPAddress() {
        if (!array_key_exists('REMOTE_ADDR', $_SERVER)) {
            throw new Exception('Missing remote address.');
        }

        return (ip2long($_SERVER['REMOTE_ADDR']) == ip2long(self::GITHUB_IP_BASE));
    }

    /**
     * Optional function to check if HMAC hex digest of the payload matches GitHub's.
     *
     * @return bool
     */
    public function validateHubSignature($SecretKey) {
        if (!array_key_exists('HTTP_X_HUB_SIGNATURE', $_SERVER)) {
            throw new Exception('Missing X-Hub-Signature header. Did you configure secret token in hook settings?');
        }

        return 'sha1=' . hash_hmac('sha1', $this->_rawPayload, $SecretKey, false) === $_SERVER['HTTP_X_HUB_SIGNATURE'];
    }

    /**
     * Returns event type
     * See https://developer.github.com/webhooks/#events
     *
     * @return string
     */
    public function getEventType() {
        return $this->_eventType;
    }

    /**
     * Returns decoded payload
     *
     * @return Payload
     */
    public function getPayload() {
        return $this->_payload;
    }

    /**
     * Returns full name of the repository
     *
     * @return string
     */
    public function getFullRepositoryName() {
        if ($this->_eventType === 'ping') {
            if (!isset($this->_payload->hook->url)) {
                throw new Exception('Unable to get hook url from ping event payload');
            }

            if (preg_match('/\/repos\/([^\/]*)\/([^\/]*)\/hooks/', $this->_payload->hook->url, $Matches) === 1) {
                return sprintf('%s/%s', $Matches[1], $Matches[2]);
            }
        }

        if (isset($this->_payload->repository->full_name)) {
            return $this->_payload->repository->full_name;
        }

        return sprintf('%s/%s', $this->_payload->repository->owner->name, $this->_payload->repository->name);
    }

}
