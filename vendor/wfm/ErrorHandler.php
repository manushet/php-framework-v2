<?php

namespace WFM;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);

        set_error_handler([$this, 'errorHandler']);

        ob_start();

        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function exceptionHandler(\Throwable $e): void
    {      
        $errorMessage = $e->getMessage();
        $errorFile = $e->getFile();
        $errorLine = $e->getLine();
        $errorCode = $e->getCode();

        $this->logError($errorMessage, $errorFile, $errorLine);
        $this->displayError('Error number', $errorMessage, $errorFile, $errorLine, $errorCode);
    }

    protected function logError(string $message = '', string $file = '', string $line = '')
    {
        $error_record = "\r\n[" . date('Y-m-d H:i:s', time()) . "] Error: {$message} | File: {$file} | Line: {$line}";
        $error_record .= "\r\n*****************************************\r\n";

        file_put_contents(LOGS . '/errors.log', $error_record, FILE_APPEND);
    }

    protected function displayError(string $errno, string $errstr, string $errfile, int $errline, int $response = 500): void
    {       
        if ((int)$response === 0) {
            $response = 404;
        }

        http_response_code($response);

        if ($response === 404 && !DEBUG) {
            require_once WWW . '/errors/404.php';
            die();
        }
        else {
            if (DEBUG) {
                require_once WWW . '/errors/development.php';
            }
            else {
                require_once WWW . '/errors/production.php';
            }
        }
        die();
    }

    public function errorHandler(string $errno, string $errstr, string $errfile, int $errline): void
    {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    public function fatalErrorHandler(): void
    {
        $last_error = error_get_last();

        if (!empty($last_error) && $last_error['type'] && (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($last_error['message'], $last_error['file'], $last_error['line']);
            ob_end_clean();
            $this->displayError($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
        } else {
            ob_end_flush();
        }
    }
}