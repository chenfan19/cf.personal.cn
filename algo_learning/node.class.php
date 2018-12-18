<?php

//基础链表类
class Node{
    public $content;
    public $next;

    public function __construct($content=null, $next=null){
        $next = $next instanceof self ? $next : null;
        $this->content = $content;
        $this->next = $next;
    }
}