<?php
/**
 * @var $this AuditLogController
 * @var $auditLog AuditLog
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-audit-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-audit-module/master/LICENSE
 *
 * @package yii-audit-module
 */

Yii::app()->user->setState('index.auditLog', Yii::app()->request->requestUri);
$this->pageTitle = Yii::t('audit', 'Logs');

echo '<div class="spacer">';
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => Yii::t('app', 'Search'),
    'htmlOptions' => array('class' => 'auditLog-grid-search'),
    'toggle' => true,
));
if (Yii::app()->user->getState('index.auditLog') != $this->createUrl('index')) {
    echo ' ';
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => Yii::t('app', 'Reset Filters'),
        'url' => array('index'),
    ));
}
echo '</div>';

// search
$this->renderPartial('_search', array(
    'auditLog' => $auditLog,
));

// grid
$this->renderPartial('_list', array(
    'auditLog' => $auditLog,
));