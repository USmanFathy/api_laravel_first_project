<?php

namespace App\Http\Controllers\Api;

trait ApiResposeTrait
{

    public function Apidata($data=null , $status=null , $message=null){
        return response([
            'data' =>$data,
            'status' => $status ,
            'message' =>$message
        ]);
    }
}
