<?php
require_once 'node.class.php';

//使用链表实现栈,并实现迭代器接口
class stack implements Iterator{
    private $firstNode = null;
    private $length = 0;
    private $iteKey = 0;
    private $iteValue = null;

    public function push($content){
        $this->firstNode = new Node($content, $this->firstNode);
        $this->length++;
    }

    public function pop(){
        if($this->length <= 0){
            return null;
        }
        $content = $this->firstNode->content;
        $this->firstNode = $this->firstNode->next;
        $this->length--;
        return $content;
    }

    public function isEmpty(){
        return $this->length == 0;
    }

    public function size(){
        return $this->length;
    }

    public function rewind(){
        $this->iteKey = 0;
        $this->iteValue = $this->firstNode;
    }

    public function next(){
        $this->iteKey++;
        $this->iteValue = $this->iteValue->next;
    }

    public function key(){
        return $this->iteKey;
    }

    public function current(){
        return $this->iteValue->content;
    }

    public function valid(){
        return $this->iteValue !== NULL;
    }
}