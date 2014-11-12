<?php
namespace Peridot\Reporter\ListReporter;

use Evenement\EventEmitterInterface;
use Peridot\Reporter\ReporterFactory;
use Symfony\Component\Console\Input\InputInterface;

/**
 * This plugin registers the ListReporter with Peridot
 * @package Peridot\Reporter\ListReporter
 */
class ListReporterPlugin
{
    /**
     * @var EventEmitterInterface
     */
    protected $emitter;

    /**
     * @param EventEmitterInterface $emitter
     */
    public function __construct(EventEmitterInterface $emitter)
    {
        $this->emitter = $emitter;
        $this->emitter->on('peridot.reporters', [$this, 'onPeridotReporters']);
    }

    /**
     * @param InputInterface $input
     * @param ReporterFactory $reporters
     */
    public function onPeridotReporters(InputInterface $input, ReporterFactory $reporters)
    {
        $reporters->register('list', 'list test results', 'Peridot\Reporter\ListReporter\ListReporter');
    }
} 
