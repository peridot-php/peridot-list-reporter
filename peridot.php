<?php
use Evenement\EventEmitterInterface;
use Peridot\Plugin\Watcher\WatcherPlugin;
use Peridot\Reporter\Dot\DotReporterPlugin;
use Peridot\Reporter\ListReporter\ListReporterPlugin;

return function(EventEmitterInterface $emitter) {
    $dot = new DotReporterPlugin($emitter);
    $watcher = new WatcherPlugin($emitter);
    $watcher->track(__DIR__ . '/src/');
    $list = new ListReporterPlugin($emitter);
};
