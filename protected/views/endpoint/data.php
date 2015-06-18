<?php
/* @var $this EndpointController */
/* @var $model Endpoint */

$this->breadcrumbs = array(
    'Events' => array('index'),
);

$this->menu = array(
    array('label' => 'Chart of Events', 'url' => array('chart')),
    array('label' => 'List All Events', 'url' => array('index')),
);

echo "<h1>Events Count by Name </h1>";

$eventsByName = Endpoint:: getGridEvents('name');
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => new CArrayDataProvider($eventsByName),
    'columns' => array('name', 'count'),
));

echo "<br/><br/><br/>";
echo "<h1>Events Count by DateTime </h1>";

$eventsByDatetime = Endpoint:: getGridEvents('datetime');
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => new CArrayDataProvider($eventsByDatetime),
    'columns' => array('datetime', 'count'),
));

