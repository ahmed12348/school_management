<?php

class helpers
{

     Public static function IDGenerator($model,$trow,$length,$prefix){
        $data=$model::orderBy('id','desc')->first();
     if(!$data){
      $og_length=$length;
      $last_number='';

     }else{
         $code=substr($data->$trow);
     }

    }


}



