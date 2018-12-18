<?php
require_once 'node.class.php';

//使用链表实现队列,并实现迭代器接口
class queue implements Iterator {
    private $firstNode = null;
    private $endNode = null;
    private $length = 0;
    private $iteKey = 0;
    private $iteNode = null;

    public function publish($content){
        $newNode = new Node($content);
        if($this->length == 0){
            $this->firstNode = $this->endNode = $newNode;
        }else{
            $this->endNode->next = $newNode;
            $this->endNode = $newNode;
        }
        $this->length++;
    }

    public function delivery(){
        if($this->length <= 0){
            return null;
        }
        $content = $this->firstNode->content;
        $this->firstNode = $this->firstNode->next;
        if(--$this->length <= 0){
            $this->firstNode = $this->endNode = null;
        }
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
        $this->iteNode = $this->firstNode;
    }

    public function current(){
        return $this->iteNode->content;
    }

    public function key(){
        return $this->iteKey;
    }

    public function valid(){
        return $this->iteNode !== null;
    }

    public function next(){
        $this->iteKey ++;
        $this->iteNode = $this->iteNode->next;
    }
}