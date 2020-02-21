<?php

namespace Drupal\greet\Logger;

use Drupal\Core\Logger\RfcLoggerTrait;
use Psr\Log\LoggerInterface;
use Drupal\Core\Logger\RfcLogLevel;
use Drupal\Core\Logger\LogMessageParserInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class MailLogger implements LoggerInterface {
    use RfcLoggerTrait;

    protected $parser;
    protected $configFactory;

    public function __construct(LogMessageParserInterface $parser, ConfigFactoryInterface $configFactory) {
        $this->parser = $parser;
        $this->configFactory = $configFactory;
    }


    public function log($level, $message, array $context = array()) {
        
        // if($level !== RfcLogLevel::ERROR) {
        //     return;
        // }

        $to = $this->configFactory->get('system.site')->get('mail');

        // print_r($to); exit();

        // $account = $context['uid'];
    }
}