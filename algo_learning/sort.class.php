<?php

class sort {
    private $arr = array();

    public function __construct($arr){
        $this->arr = $arr;
    }

    //打印数组元素
    public function __toString(){
        return implode(',', $this->arr);
    }

    //交换数组元素
    private function exch(&$arr, $p, $q){
        $temp = $arr[$p];
        $arr[$p] = $arr[$q];
        $arr[$q] = $temp;
    }

    //冒泡排序
    public function doBubbleSort(){
        $length = count($this->arr);
        for($i=0; $i<$length-1; $i++){
            for($j=0; $j<$length-$i-1; $j++){
                if($this->arr[$j] > $this->arr[$j+1]){
                    $this->exch($this->arr, $j, $j+1);
                }
            }
        }
        return $this->arr;
    }

    //选择排序
    public function doChangeSort(){
        $length = count($this->arr);
        for($i=0; $i<$length; $i++){
            for($j=$i+1; $j<$length; $j++){
                if($this->arr[$j] < $this->arr[$i]){
                    $this->exch($this->arr, $j, $i);
                }
            }
        }
        return $this->arr;
    }

    //插入排序
    public function doInsertSort(){
        $length = count($this->arr);
        for($i=0; $i<$length; $i++){
            for($j=$i-1; $j>=0; $j--){
                if($this->arr[$j] > $this->arr[$j+1]){
                    $this->exch($this->arr, $j, $j+1);
                }else{
                    break;
                }
            }
        }
        return $this->arr;
    }

    //归并排序(自顶向下)
    public function doMergeSortFromTop(){
        $length = count($this->arr);
        $this->mergeSortFromTop(0, $length-1);
        return $this->arr;
    }

    //归并排序(自顶向下)递归
    private function mergeSortFromTop($left, $right){
        if($left >= $right){
            return;
        }

        $middle = $left + floor(($right-$left)/2);
        $this->mergeSortFromTop($left, $middle);
        $this->mergeSortFromTop($middle+1, $right);

        $i = $left;
        $j = $middle+1;
        $tempArr = array();
        while($i<=$middle || $j<=$right){
            if($j > $right){
                $tempArr[] = $this->arr[$i++];
                continue;
            }
            if($i > $middle){
                $tempArr[] = $this->arr[$j++];
                continue;
            }
            if($this->arr[$i] <= $this->arr[$j]){
                $tempArr[] = $this->arr[$i++];
                continue;
            }else{
                $tempArr[] = $this->arr[$j++];
                continue;
            }
        }
        for($i=$left; $i<=$right; $i++){
            $this->arr[$i] = $tempArr[$i-$left];
        }
    }

    //归并排序(自底向上)
    public function doMergeSortFromBottom(){
        $length = count($this->arr);
        
        $size = 1;
        while($size < $length){
            for($left=0; $left<$length; $left+=2*$size){
                $middle = $left + $size - 1;
                $right = min($middle+$size, $length-1);
                $i = $left;
                $j = $middle+1;
                $tempArr = array();
                while($i<=$middle || $j<=$right){
                    if($j > $right){
                        $tempArr[] = $this->arr[$i++];
                        continue;
                    }
                    if($i > $middle){
                        $tempArr[] = $this->arr[$j++];
                        continue;
                    }
                    if($this->arr[$i] <= $this->arr[$j]){
                        $tempArr[] = $this->arr[$i++];
                        continue;
                    }else{
                        $tempArr[] = $this->arr[$j++];
                        continue;
                    }
                }
                for($i=$left; $i<=$right; $i++){
                    $this->arr[$i] = $tempArr[$i-$left];
                }
            }
            $size *= 2;
        }

        return $this->arr;
    }

    //快速排序
    public function doQuickSort(){
        $length = count($this->arr);
        $this->quickSort(0, $length-1);
        return $this->arr;
    }

    //快速排序递归
    public function quickSort($left, $right){
        if($left >= $right){
            return;
        }

        $i = $left + 1;
        $j = $right;
        while($i <= $j){
            if($this->arr[$i] > $this->arr[$left] && $this->arr[$j] < $this->arr[$left]){
                $this->exch($this->arr, $i++, $j--);
                continue;
            }
            if($this->arr[$i] > $this->arr[$left]){
                $j--;
                continue;
            }
            if($this->arr[$j] < $this->arr[$left]){
                $i++;
                continue;
            }
            $i++;
            $j--;
        }
        $this->exch($this->arr, $left, $j);

        $this->quickSort($left, $j-1);
        $this->quickSort($j+1, $right);
    }

    //堆排序
    public function doHeapSort(){
        //构造二叉堆
        $this->arr[] = $this->arr[0];
        $this->arr[0] = 0;
        $length = count($this->arr);
        //从最右的非叶子节点开始向左遍历，每一个节点都进行一次下沉
        for($i=floor(($length-1)/2); $i>=1; $i--){
            $this->heapSink($i, $length-1);
        }
        //开始排序，将堆顶节点和数组最右交换，将其剔除出堆，然后新的堆顶节点下沉复原二叉堆
        for($i=$length-1; $i>=2; $i--){
            $this->exch($this->arr, 1, $i);
            $this->heapSink(1, $i-1);
        }
        for($i=0; $i<$length-1; $i++){
            $this->arr[$i] = $this->arr[$i+1];
        }
        unset($this->arr[$length-1]);
        return $this->arr;
    }

    //二叉堆节点递归下沉
    private function heapSink($key, $right){
        if($key*2 > $right){
            return;
        }
        if($key*2 == $right){
            $nextKey = 2*$key;
        }else if($this->arr[$key*2] > $this->arr[$key*2+1]){
            $nextKey = $key*2;
        }else{
            $nextKey = $key*2+1;
        }
        if($this->arr[$key] > $this->arr[$nextKey]){
            return ;
        }
        $this->exch($this->arr, $key, $nextKey);
        $this->heapSink($nextKey, $right);
    }
}