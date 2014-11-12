<?php
use Evenement\EventEmitter;
use Peridot\Configuration;
use Peridot\Reporter\ListReporter\ListReporterPlugin;
use Peridot\Reporter\ReporterFactory;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

describe('ListReporterPlugin', function() {
    beforeEach(function() {
        $this->emitter = new EventEmitter();
        $this->plugin = new ListReporterPlugin($this->emitter);
    });

    context('when peridot.reporters event is emitted', function() {
        beforeEach(function() {
            $config = new Configuration();
            $output = new BufferedOutput();
            $this->factory = new ReporterFactory($config, $output, $this->emitter);
        });

        it('should register the list reporter', function() {
            $input = new ArrayInput([]);
            $this->emitter->emit('peridot.reporters', [$input, $this->factory]);
            $reporters = $this->factory->getReporters();
            assert(array_key_exists('list', $reporters), 'list reporter should have been registered');
        });
    });
});
