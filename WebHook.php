<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebHook
 *
 * @author roger_calderini (Time Core - Nucleo Digital - Grupo RBS)
 */
class WebHook {

    // Set Variables
    private $_local_root;
    private $_local_repo;
    private $_remote_repo;
    private $_branch;

    function __construct($local_repo, $remote_repo, $local_root = "/etc/puppet/environments/dev/modules", $branch = "master") {
        $this->_local_root = $local_root;
        $this->_local_repo = "$local_root/$local_repo";
        $this->_remote_repo = $remote_repo;
        $this->_branch = $branch;
    }

    /**
     * Executa o comando git Pull ou Clone
     * 
     * @return String A sa�da do comando executado.
     */
    public function gitExec() {
        $output = "";
        if (file_exists($this->_local_repo)) {

            // se o reposit�rio j� existe, faz pull das ultimas modifica��es.
            $output = shell_exec("cd {$this->_local_repo} && git pull");
        } else {

            // Se o reposit�rio n�o existe, faz clone do projeto
           $output = shell_exec("cd {$this->_local_root} && git clone {$this->_remote_repo}");
        }

        return $output;
    }
    
    /**
     * 
     * @return String
     */
    public function getLocal_root() {
        return $this->_local_root;
    }

    /**
     * 
     * @return String
     */
    public function getLocal_repo() {
        return $this->_local_repo;
    }

    /**
     * 
     * @return String
     */
    public function getRemote_repo() {
        return $this->_remote_repo;
    }

    /**
     * 
     * @return String
     */
    public function getBranch() {
        return $this->_branch;
    }

}
