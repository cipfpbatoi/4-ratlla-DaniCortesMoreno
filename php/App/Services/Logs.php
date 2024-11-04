<?php
namespace Joc4enRatlla\Services;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
/**
 * Summary of Logs
 * @author Dani
 * @package Joc4enRatlla\Services;
 */
class Logs
{
    private $log;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->log = new Logger("MiLogger");
        $this->log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . "/../logs/game.log", Level::Info));
        $this->log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . "/../logs/error.log", Level::Error));

    }

    /**
     * Summary of getLog
     * @return mixed
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }
}