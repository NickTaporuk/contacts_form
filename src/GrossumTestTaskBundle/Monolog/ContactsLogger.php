<?php

namespace GrossumTestTaskBundle\Monolog;

/**
 * Class ContactsLogger
 * @package GrossumTestTaskBundle\Monolog
 */
class ContactsLogger {
    /**
     * @var
     */
    public $logger;

    /**
     * @param $logger
     */
    public function __construct($logger)
    {
        $this->logger = $logger;
    }
}
