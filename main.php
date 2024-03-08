<?php
require_once('vendor/autoload.php');

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

$driver = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::chrome());
$driver->get('https://kempsey.greenlightopm.com/search-register?deptName=Development');

$driver->wait(20)->until(
    WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('table.table-striped tbody tr'))
);

$rows = $driver->findElements(WebDriverBy::cssSelector('table.table-striped tbody tr'));

foreach ($rows as $row) {
    $columns = $row->findElements(WebDriverBy::tagName('td'));
    echo "Application #: " . $columns[0]->findElement(WebDriverBy::cssSelector('a.blueLink'))->getText() . "\n";
    echo "Created : " . $columns[1]->getText() . "\n\n";
    echo "Description : " . $columns[2]->getText() . "\n\n";
    echo "Properties : " . $columns[3]->getText() . "\n\n";
    echo "Status : " . $columns[4]->getText() . "\n\n\n";
}

$driver->quit();

