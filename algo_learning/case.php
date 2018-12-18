<?php

//sortCase('doHeapSort', 100);exit;
sortTimeCase('doQuickSort');

//排序算法时间复杂度测试
function sortTimeCase($caseFunction){
    $inputLength = 100; //输入数组初始长度
    $caseChange = 2; //初始长度变化值
    $caseTime = 10; //变化次数

    $times = 1;
    while($times <= $caseTime){
        //当前数组长度进行五次排序，计算五次平均用时
        $allTime = 0;
        for($i=0; $i<5; $i++){
            $allTime += sortCase($caseFunction, $inputLength);
        }
        $allTime /= 5;
        echo "{$inputLength}长度数组排序结束，平均用时:{$allTime}ms\n";

        $inputLength *= $caseChange;
        $times++;
    }
}

//排序类用例
function sortCase($function, $n){
    require_once 'sort.class.php';

    //构造一个长度n的数组，里面塞满1000以内的自然数作为输入
    $arr = array();
    for($i=0; $i<$n; $i++){
        $arr[] = rand(0, 1000);
    }

    //进行排序并返回运行时间
    $startTime = microtime(true);

    //选择使用排序算法(根据参数中的方法名)
    $sc = new sort($arr);
    //echo "{$sc}\n";
    $output = $sc->$function();
    //echo "{$sc}\n";

    $usedTime = sprintf("%.6f", microtime(true) - $startTime) * 1000;

    return $usedTime;
}

//队列用例
function queueCase(){
    require_once 'queue.class.php';

    $a = new queue();

    $a->publish('a');
    $a->publish('b');
    $a->publish('c');
    $a->publish('d');
    $a->publish('e');

    foreach ($a as $k => $v) {
        echo "{$k} => {$v}\n";
    }

    echo "delivery is ".$a->delivery()."\n";
    echo "delivery is ".$a->delivery()."\n";
    echo "delivery is ".$a->delivery()."\n";

    foreach ($a as $k => $v) {
        echo "{$k} => {$v}\n";
    }
}

//栈用例
function stackCase(){
    require_once 'stack.class.php';

    $a = new stack();

    $a->push('a');
    $a->push('b');
    $a->push('c');
    $a->push('d');
    $a->push('e');

    foreach ($a as $k => $v) {
        echo "{$k} => {$v}\n";
    }

    echo "pop is ".$a->pop()."\n";
    echo "pop is ".$a->pop()."\n";
    echo "pop is ".$a->pop()."\n";

    foreach ($a as $k => $v) {
        echo "{$k} => {$v}\n";
    }
}