<?php
namespace Peridot\Reporter\ListReporter;

use Peridot\Core\TestInterface;
use Peridot\Reporter\AbstractBaseReporter;

class ListReporter extends AbstractBaseReporter
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function init()
    {
        $this->eventEmitter->on('test.passed', [$this, 'onTestPassed']);
        $this->eventEmitter->on('test.failed', [$this, 'onTestFailed']);
        $this->eventEmitter->on('test.pending', [$this, 'onTestPending']);
        $this->eventEmitter->on('runner.start', [$this, 'onRunnerStart']);
        $this->eventEmitter->on('runner.end', [$this, 'onRunnerEnd']);
    }

    /**
     * @param TestInterface $test
     */
    public function onTestPassed(TestInterface $test)
    {
        $this->output->writeln($this->getTitle('success', $test));
    }

    /**
     * @param TestInterface $test
     */
    public function onTestFailed(TestInterface $test)
    {
        $this->output->writeln($this->getTitle('error', $test));
    }

    /**
     * @param TestInterface $test
     */
    public function onTestPending(TestInterface $test)
    {
        $this->output->writeln($this->getTitle('pending', $test));
    }

    /**
     * @return void
     */
    public function onRunnerStart()
    {
        $this->output->writeln("");
    }

    /**
     * @return void
     */
    public function onRunnerEnd()
    {
        $this->output->writeln("");
        $this->footer();
    }

    /**
     * Build a title by navigating a test's tree
     *
     * @param string $color
     * @param TestInterface $test
     * @return string
     */
    protected function getTitle($color, TestInterface $test)
    {
        $description = "";
        $test->forEachNodeTopDown(function (TestInterface $node) use (&$description) {
            $description .= " " . $node->getDescription();
        });
        return $this->color($color, trim($description));
    }
}
