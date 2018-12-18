<?php

//对一个数组进行排序，然后二分查找，根据值找出对应的数组下标
function rank($arr, $findValue){
    sort($arr);
    $minKey = 0;
    $maxKey = count($arr) - 1;
    while($minKey <= $maxKey){
        $midKey = ceil(($minKey+$maxKey)/2);
        if($arr[$midKey] > $findValue){
            $maxKey = $midKey - 1;
        }else if($arr[$midKey] < $findValue){
            $minKey = $midKey + 1;
        }else{
            return $midKey;
        }
    }
    return false;
}

$arr = explode(',', $argv[1]);
$findValue = $argv[2];

var_dump($arr, $findValue, rank($arr, $findValue));