<?php

namespace Gifts\Logging;

class LogWriter
{

    /**
     * @var string
     */
    protected $logMessage = '';

    public function throwableLog(\Throwable $throwable)
    {
        $this->addLog(
            "CODE: {$throwable->getCode()} |FILE: {$throwable->getFile()} |LINE: {$throwable->getLine()} |MESSAGE: {$throwable->getMessage()} |TRACE: {$throwable->getTraceAsString()}"
        );
        $this->writeLogs();
    }

    public function addLog($logMessage)
    {
        $logTime = (new \DateTime())->format('Y-m-d H:i:s');
        $this->logMessage .= "[BEGIN - {$logTime}]\n{$logMessage}\n[{$logTime} - END]\n";
    }

    public function write($logMessage)
    {
        $this->addLog($logMessage);
        $this->writeLogs();
    }

    public function writeLogs()
    {
        error_log($this->logMessage, 3, __DIR__.'/../../var/log/app.error.log');
        $this->logMessage = '';
    }
}