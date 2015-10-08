<?php

namespace TravelBlog;


/** @var Table[] $tables */
use Yaoi\Log;

$tables = array(
    Session::table(),
    Host::table(),
    Tag::table(),
    SessionTag::table(),
);

$log = new Log('stdout');

$remover = new Manager();
foreach ($tables as $table) {
    $remover->add($table->migration(), Migration::ROLLBACK);
}
$remover->run();
$remover->setLog($log);


$adder = new Manager();
$adder->setLog($log);
foreach ($tables as $table) {
    $adder->add($table->migration());
}

