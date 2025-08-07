<?php


namespace App\Filters;


class ItemFilter extends QueryFilter
{
    public function name($value){
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
                $this->builder->where('name', 'like', '%'.$search.'%');
            }
        }
    }

    public function phone($value){

        if($value){
            $phone = preg_replace('/^\+7/', '', $value);
            $phone = preg_replace("#[^0-9]#", "", $phone);
            $this->builder->where('phone', 'like', '%'.$phone.'%');
        }
    }

    public function user_id($value){
        if($value){
            $this->builder->where('id', $value);
        }
    }

    public function filters(){
        return $this->request->all();
    }
}
