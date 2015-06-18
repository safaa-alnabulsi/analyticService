<?php
/* @var $this EndpointController */
/* @var $model Endpoint */

$this->breadcrumbs = array(
    'Events' => array('index'),
    'Chart',
);

$this->menu = array(
    array('label' => 'List All Events', 'url' => array('index')),
    array('label' => 'Grid of Events', 'url' => array('data')),
);


echo "<h1>Events Count by DateTime </h1>";

$eventsByName = Endpoint:: getChartEvents('name');
$this->widget(
    'chartjs.widgets.ChBars',
    array(
        'width' => 700,
//        'height' => 300,
        'htmlOptions' => array(),
        'labels' => $eventsByName['eventsName'],
        'datasets' => array(
            array(
                "fillColor" => "navy",
                "strokeColor" => "rgba(220,220,220,1)",
                "data" => $eventsByName['eventsCounts']
            )
        ),
        'options' => Endpoint::getChartOptions($eventsByName)
    )
);


echo "<br/><br/><br/>";
echo "<h1>Events Count by DateTime </h1>";

$eventsByDatetime = Endpoint:: getChartEvents('datetime');
$this->widget(
    'chartjs.widgets.ChBars',
    array(
        'width' => 700,
//        'height' => 300,
        'htmlOptions' => array(),
        'labels' => $eventsByDatetime['eventsName'],
        'datasets' => array(
            array(
                "fillColor" => "navy",
                "strokeColor" => "rgba(220,220,220,1)",
                "data" => $eventsByDatetime['eventsCounts']
            )
        ),
        'options' => Endpoint::getChartOptions($eventsByDatetime)
    )
);