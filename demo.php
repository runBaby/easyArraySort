<?php
header("Content-type:text/html;charset=utf-8");
/**
 * Created by PhpStorm.
 * User: runBaby
 * Date: 2018/7/6
 * Time: 18:30
 */
include_once 'easyArraySort.php';

$arr = array(
    '3308'=>array(
        'nickname'=>'白百2',
        'age'=>'42'
    ),
    '3310'=>array(
        'nickname'=>'张三4',
        'age'=>'30'
    ),
    '3406'=>array(
        'nickname'=>'王五3',
        'age'=>'30'
    ),
    '3306'=>array(
        'nickname'=>'安迪1',
        'age'=>'26'
    ),
);

$data['data'] = $arr;
$data['key_name'] = 'nickname';
$obj = new my_array_sort($data);

$res = $obj->do_array();

print_r($res);die;
