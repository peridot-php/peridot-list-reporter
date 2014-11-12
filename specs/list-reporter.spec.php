<?php
use Evenement\EventEmitter;
use Peridot\Configuration;
use Peridot\Core\Suite;
use Peridot\Core\Test;
use Symfony\Component\Console\Output\BufferedOutput;
use Peridot\Reporter\ListReporter\ListReporter;

describe('ListReporter', function() {
    beforeEach(function() {
        $this->configuration = new Configuration();
        $this->output = new BufferedOutput();
        $this->emitter = new EventEmitter();

        $this->reporter = new ListReporter($this->configuration, $this->output, $this->emitter);
    });

    context('when runner.start event is emitted', function() {
        it('should print a new line', function() {
            $this->emitter->emit('runner.start');
            $output = $this->output->fetch();
            assert(strpos($output, PHP_EOL) !== false, "should print new line when runner starts");
        });
    });

    context('when test.passed event is emitted', function() {
        it('should output the fully qualified test name', function() {
            $suite = new Suite("A rad thing", function() {});
            $childSuite = new Suite("when rad", function() {});
            $test = new Test("should be rad", function() {});

            $suite->addTest($childSuite);
            $childSuite->addTest($test);

            $this->emitter->emit('test.passed', [$test]);
            $output = $this->output->fetch();
            assert(strpos($output, "A rad thing when rad should be rad") !== false, "full suite name should be output for success");
        });
    });

    context('when test.failed event is emitted', function() {
        it('should output the fully qualified test name', function() {
            $suite = new Suite("A bad thing", function() {});
            $childSuite = new Suite("when not rad", function() {});
            $test = new Test("should not be rad", function() {});

            $suite->addTest($childSuite);
            $childSuite->addTest($test);

            $this->emitter->emit('test.failed', [$test, new \Exception("failure")]);
            $output = $this->output->fetch();
            assert(strpos($output, "A bad thing when not rad should not be rad") !== false, "full suite name should be output for failure");
        });
    });

    context('when test.pending event is emitted', function() {
        it('should output the fully qualified test name', function() {
            $suite = new Suite("A meh thing", function() {});
            $childSuite = new Suite("when not rad or bad", function() {});
            $test = new Test("should not be rad or bad");

            $suite->addTest($childSuite);
            $childSuite->addTest($test);

            $this->emitter->emit('test.pending', [$test]);
            $output = $this->output->fetch();
            assert(strpos($output, "A meh thing when not rad or bad should not be rad or bad") !== false, "full suite name should be output for pending");
        });
    });
});
