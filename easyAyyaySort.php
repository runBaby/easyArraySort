<?php
/**
 * Created by PhpStorm.
 * User: weizaojiao-wjp
 * Date: 2018/7/6
 * Time: 18:12
 */

class my_array_sort{

    public $array;
    public $key_name = 'nickname';
    public $old_type = 'utf-8';
    public $new_type = 'gbk';
    public $sort_order = SORT_ASC;
    public $sort_type = SORT_NUMERIC;

    public function __construct($arr)
    {
        if($arr['data']){
            $this->array = $arr['data'];
        }else{
           $this->error('data');
        }
        if($arr['key_name']){
            $this->key_name = $arr['key_name'];
        }else{
            $this->error('key_name');
        }
    }

    /**
     * @param $array      需要转化的二维数组
     * @param $key_name   二维数组待转还的字段
     * @param $old_type   目前的字符编码
     * @param $new_type   待转化的字符编码
     * @return mixed
     * Name: array_chane_code
     * User: wangjiapeng
     * Date: 2018/07/06
     * Explain:二维数组个别字段字符编码转换
     */
   static public function array_chane_code($array = array(),$key_name_value,$old_type_value,$new_type_value){
        array_walk($array, function(&$value) use ($key_name_value,$old_type_value,$new_type_value){
            $value[$key_name_value] = iconv($old_type_value, $new_type_value, $value[$key_name_value]);
        });

        return $array;
    }

    /**
     * @param $arrays           需排序的数组
     * @param $sort_key         需排序的字段
     * @param int $sort_order   字段排序 array_multisort()
     * @param int $sort_type    排序类型 array_multisort()
     * @return array|bool
     * Name: my_array_sort
     * User: wangjiapeng
     * Date:2018/07/06
     * Explain:二维数组排序
     */
    static public function my_array_sort($arrays = array(),$sort_key_value,$sort_order_value,$sort_type_value){
        if(is_array($arrays)){
            foreach ($arrays as $key=>$array){
                if(is_array($array)){
                    $key_arrays[] = $array[$sort_key_value];
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        array_multisort($key_arrays,$sort_order_value,$sort_type_value,$arrays);
        return $arrays;
    }

    /**
     * @return mixed
     * Name: do_array
     * User: wangjiapeng
     * Date: 2018/07/06
     * Explain:执行操作
     */
    public function do_array(){
        //对utf8数据转为gbk
        $new_arr = self::array_chane_code($this->array,$this->key_name,$this->old_type,$this->new_type);
        //对转过后的gbk数据，字段排序
        $new_arr = self::my_array_sort($new_arr,$this->key_name,$this->sort_order,$this->sort_type);
        //排序完成，对gbk数据转为utf8
        $result_arr = self::array_chane_code($new_arr,$this->key_name,$this->new_type,$this->old_type);

        return $result_arr;
    }

    /**
     * @param $key
     * Name: error
     * User: wangjiapeng
     * Date: 2018/07/06
     * Explain:错误提示
     */
    private function error($key){
        echo $key."参数错误";die;
    }

}