<?php
	class map extends ArrayObject{
 
    // 获取 arrayobject 因子
    public function __construct(array $array = array()){
        foreach ($array as &$value){
            is_array($value) && $value = new self($value);
        }
        parent::__construct($array);
    }
 
    // 取值
    public function __get($index){
        return $this->offsetGet($index);
    }
 
    // 赋值
    public function __set($index, $value){
     is_array($value) && $value = new self($value);
        $this->offsetSet($index, $value);
    }
 
    // 是否存在
    public function __isset($index){
        return $this->offsetExists($index);
    }
 
    // 删除
    public function __unset($index){
        $this->offsetUnset($index);
    }
 
    // 转换为数组类型
    public function toArray(){
        $array = $this->getArrayCopy();
        foreach ($array as &$value){
            ($value instanceof self) && $value = $value->toArray();
        }
        return $array;
    }
  
    // 打印成字符
    public function __toString(){
        return var_export($this->toArray(), true);
    }
    
    // 根据索引赋值
    public function put($index,$value){
     is_array($value) && $value = new self($value);
        $this->offsetSet($index, $value);
    }
    
    // 根据索引取值
    public function get($index){
     return $this->offsetGet($index);
    }
 
}


?>