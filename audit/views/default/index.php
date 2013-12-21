<?php
/**
 * @var $this DefaultController
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-audit-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-audit-module/master/LICENSE
 *
 * @package yii-audit-module
 */

$this->pageTitle = false;
?>

<div class="jumbotron">
    <?php
    echo CHtml::tag('h1', array(), Yii::t('audit', 'Welcome to the Yii Audit Module!'));
    echo CHtml::tag('p', array(), Yii::t('audit', 'You may use the following tools to help audit your Yii application.'));

    $items = array();
    foreach (array_keys($this->module->controllerMap) as $controllerName)
        $items[] = array(
            'label' => Yii::t('audit', ucfirst($controllerName)),
            'url' => array($controllerName . '/index'),
            'linkOptions' => array('class' => 'btn btn-lg btn-primary'),
        );
    $this->widget('zii.widgets.CMenu', array(
        'items' => $items,
        'htmlOptions' => array('class' => 'list-inline'),
    ));
    ?>
</div>
