<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php if (!Yii::app()->user->isGuest) { ?>
<p>For adding more event's please use the following form and you will get an image of success or failure

<p>
    <b><?php
    $link = Yii::app()->getBaseUrl(true) . '/endpoint/input?eventName=bar&eventValue=foo';
    echo CHtml::link($link, $link); ?></b>
</p>
</p>

<p>Click <b><?php echo CHtml::link(' here ', array('/endpoint/chart')); ?></b> for more information about the service
    analytics</p>
<?php } else {
    echo "Please " . CHtml::link('Login',
            array('user/login')) . " in to see information about the service analytics";
} ?>