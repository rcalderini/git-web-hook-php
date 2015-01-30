<?php
/**
 * index.php
 *
 * @author roger_calderini
 */
error_reporting(0);
Header('Content-Type: text/plain; charset=utf-8');

require_once "./GitHubWebHook.php";
require_once "./WebHook.php";

try {
    $gitHubWebHook = new GitHubWebHook( );
    $gitHubWebHook->processRequest();

    /*if (!$gitHubWebHook->validateIPAddress()) {
        header("HTTP/1.1 401 Unauthorized");
        exit();
    }*/

    if (!$gitHubWebHook->validateHubSignature('passw0rd')) {
        header("HTTP/1.1 401 Unauthorized");
        exit();
    }

    echo 'Received ' . $gitHubWebHook->getEventType() . ' in repository ' . $gitHubWebHook->getFullRepositoryName() . PHP_EOL;

    /*
     * Verifica a necessidade de executar pull ou clone
     */
    $webHook = new WebHook(
            $gitHubWebHook->getPayload()->getRepositoryName(), 
            $gitHubWebHook->getPayload()->getRepositoryCloneUrl(),
            "/home/roger_calderini/workspace",
            $gitHubWebHook->getPayload()->getBranch()
            );
    
    $output = $webHook->gitExec();

    echo $output;
    
    header("HTTP/1.1 202 Accepted");
    exit();
} catch (Exception $e) {
    echo 'Exception: ' . $e->getMessage() . PHP_EOL;

    header('HTTP/1.1 500 Internal Server Error');
    exit();
}
