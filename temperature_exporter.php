<?php
require_once 'MeasureTemperature.php';

$termometar = new MeasureTemperature();
$temperatureArray = $termometar->Measure();

//var_dump($temperatureArray);
foreach ($temperatureArray as $temperatureSensor)
{
    header("Content-Type: text/plain");
    header("Connection: close");
    $help = "#HELP";
    $typeGauge = "#TYPE gauge";
    echo $help . " Environment temperature" . PHP_EOL;
    echo $typeGauge . PHP_EOL;
    echo PrepareTemperaure($temperatureSensor);
}
function PrepareTemperaure(array $sensor)
{
    
    return "environment_temperature" . "{sensor=\"" . $sensor['sn'] . "\"} " . $sensor['temperature'] . PHP_EOL;
}
?>
