<?php
/**
 * Created by IntelliJ IDEA.
 * User: nick
 * Date: 22.04.16
 * Time: 12:40
 */

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