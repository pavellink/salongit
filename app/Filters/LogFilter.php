<?php


namespace App\Filters;


class LogFilter extends QueryFilter
{
    public function find($value){
        if($value){
            $words = explode(' ', $value);
            foreach ($words as $key => $value) {
                if(is_numeric($value)){
                    $search = $value;
                }
                else{
                    $count =  mb_strlen($value, 'utf-8');

                    if($count <= 2){
                        $search = $value;
                    }

                    elseif($count >= 3 && $count <= 5){
                        $search = mb_substr($value, 0, -1);
                    }

                    elseif($count > 6 ){
                        $search = mb_substr($value, 0, -2);
                    }
                    else{
                        $search = $value;
                    }
                }
                $this->builder->where('descr', 'like', '%'.$search.'%');
            }
        }
    }

    public function user_id($value){
        if($value){
            $this->builder->where('user_id', $value);
        }
    }

    public function act_id($value){
        if($value){
            $this->builder->where('act_id', $value);
        }
    }

    public function filters(){
        return $this->request->all();
    }
}
