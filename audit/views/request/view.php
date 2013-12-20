<?php
/**
 * @var $this AuditRequestController
 * @var $auditRequest AuditRequest
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-audit-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-audit-module/master/LICENSE
 *
 * @package yii-audit-module
 */

$this->pageTitle = Yii::t('audit', 'Request ID-:id', array(':id' => $auditRequest->id));

$attributes = array();
$attributes[] = array(
    'name' => 'id',
);
$attributes[] = array(
    'name' => 'link',
    'value' => CHtml::link($auditRequest->link, urldecode($auditRequest->link)),
    'type' => 'raw',
);
$attributes[] = array(
    'name' => 'referrer',
    'value' => CHtml::link($auditRequest->referrer, urldecode($auditRequest->referrer)),
    'type' => 'raw',
);
$attributes[] = array(
    'name' => 'redirect',
    'value' => CHtml::link($auditRequest->redirect, urldecode($auditRequest->redirect)),
    'type' => 'raw',
);
$attributes[] = array(
    'name' => 'user_id',
    'value' => $this->module->userViewLink($auditRequest->user_id),
    'type' => 'raw',
);
$attributes[] = array(
    'name' => 'ip',
);
$attributes[] = array(
    'name' => 'total_time',
);
//$attributes[] = array(
//    'name' => 'memory_usage',
//    'value' => number_format($auditRequest->memory_usage, 0),
//);
$attributes[] = array(
    'name' => 'memory_peak',
    'value' => number_format($auditRequest->memory_peak, 0),
);
$attributes[] = array(
    'name' => 'created',
    'value' => date('Y-m-d H:i:s', $auditRequest->created),
);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $auditRequest,
    'attributes' => $attributes,
));


echo '<h2>' . Yii::t('audit', 'Fields') . '</h2>';
$auditField = new AuditField('search');
if (isset($_GET['AuditField'])) {
    $auditField->attributes = $_GET['AuditField'];
}
$auditField->audit_request_id = $auditRequest->id;
$this->renderPartial('/field/_grid', array(
    'auditField' => $auditField,
));

echo '<h2>' . Yii::t('audit', 'Errors') . '</h2>';
$auditError = new AuditError('search');
if (isset($_GET['AuditError'])) {
    $auditError->attributes = $_GET['AuditError'];
}
$auditError->audit_request_id = $auditRequest->id;
$this->renderPartial('/error/_grid', array(
    'auditError' => $auditError,
));

echo '<h2>' . Yii::t('audit', 'Page Variables') . '</h2>';
$this->widget('zii.widgets.CDetailView', array(
    'data' => $auditRequest,
    'attributes' => array(
        array(
            'label' => '$_GET',
            'value' => '<pre>' . print_r($auditRequest->unpack('get'), true) . '</pre>',
            'type' => 'raw',
        ),
        array(
            'label' => '$_POST',
            'value' => '<pre>' . print_r($auditRequest->unpack('post'), true) . '</pre>',
            'type' => 'raw',
        ),
        array(
            'label' => '$_FILES',
            'value' => '<pre>' . print_r($auditRequest->unpack('files'), true) . '</pre>',
            'type' => 'raw',
        ),
    ),
));

$onClick = "$('#session_detail').toggle(); $(this).html($(this).html()=='[+]' ? '[-]' : '[+]');";
echo '<h2><small><a href="javascript:void(0)" onclick="' . $onClick . '">[+]</a></small> ' . Yii::t('audit', 'Session and Cookies') . '</h2>';
echo '<div id="session_detail" style="display: none;">';
$this->widget('zii.widgets.CDetailView', array(
    'data' => $auditRequest,
    'attributes' => array(
        array(
            'label' => '$_SESSION',
            'value' => '<pre>' . print_r($auditRequest->unpack('session'), true) . '</pre>',
            'type' => 'raw',
        ),
        array(
            'label' => '$_COOKIE',
            'value' => '<pre>' . print_r($auditRequest->unpack('cookie'), true) . '</pre>',
            'type' => 'raw',
        ),
    ),
));
echo '</div>';

$onClick = "$('#server_detail').toggle(); $(this).html($(this).html()=='[+]' ? '[-]' : '[+]');";
echo '<h2><small><a href="javascript:void(0)" onclick="' . $onClick . '">[+]</a></small> ' . Yii::t('audit', 'Server Data') . '</h2>';
echo '<div id="server_detail" style="display: none;">';
$this->widget('zii.widgets.CDetailView', array(
    'data' => $auditRequest,
    'attributes' => array(
        array(
            'label' => '$_SERVER',
            'value' => '<pre>' . print_r($auditRequest->unpack('server'), true) . '</pre>',
            'type' => 'raw',
        ),
    ),
));
echo '</div>';