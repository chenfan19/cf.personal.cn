<?php
require_once 'stack.class.php';

//个位数算数表达式双栈求值法
function double_stack_exp_calc($exp){
    $expArr = str_split($exp);
    $numStack = new stack();
    $opeStack = new stack();
    foreach ($expArr as $v) {
        if(is_numeric($v)){
            $numStack->push($v);
        }else if(in_array($v, array('+','-','*','/'))){
            $opeStack->push($v);
        }else if($v == ')'){
            $ope = $opeStack->pop();
            if($ope == '+'){
                $numStack->push($numStack->pop() + $numStack->pop());
            }else if($ope == '-'){
                $numStack->push(-$numStack->pop() + $numStack->pop());
            }else if($ope == '*'){
                $numStack->push($numStack->pop() * $numStack->pop());
            }else if($ope == '/'){
                $numStack->push(1 / $numStack->pop() * $numStack->pop());
            }
        }
    }
    return $numStack->pop();
}

$exp = '((6*(4+2))/((9-3)*9))';
echo double_stack_exp_calc($exp);
echo "\n";
eval('echo '.$exp.';');