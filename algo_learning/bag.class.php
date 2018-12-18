<?php
require_once 'node.class.php';

//使用链表实现背包
class bag{
    private $firstNode = null;
    private $length = 0;

    public function add($content){
        $this->firstNode = new Node($content, $this->firstNode);
        $this->length++;
    }

    public function isEmpty(){
        return $this->length == 0;
    }

    public function size(){
        return $this->length;
    }
}