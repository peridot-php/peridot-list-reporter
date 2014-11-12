Peridot List Reporter
=====================

[![Build Status](https://travis-ci.org/peridot-php/peridot-list-reporter.png)](https://travis-ci.org/peridot-php/peridot-list-reporter) [![HHVM Status](http://hhvm.h4cc.de/badge/peridot-php/peridot-list-reporter.svg)](http://hhvm.h4cc.de/package/peridot-php/peridot-list-reporter)

A simple dot matrix reporter for the Peridot testing framework.

![Peridot list reporter](https://raw.github.com/peridot-php/peridot-list-reporter/master/output.png "Peridot list reporter in action")

##Usage

We recommend installing the reporter to your project via composer:

```
$ composer require --dev peridot-php/peridot-list-reporter:~1.0
```

You can register the reporter via your [peridot.php](http://peridot-php.github.io/#plugins) file.

```php
<?php
use Peridot\Reporter\ListReporter\ListReporterPlugin;

return function(EventEmitterInterface $emitter) {
    $list = new ListReporterPlugin($emitter);
};
```

##Running reporter tests

You can run the reporter specs and also preview the reporter in action like so:

```
$ vendor/bin/peridot specs/ -r list
```
