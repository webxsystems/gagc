<?php


class Config{
    private  $data;

    public function __construct(){
        $json = file_get_contents(__DIR__.'/config.json');
        $this->data = json_decode($json, true);
     }

    public function get($key){
        if (!isset($this->data[$key])){
            // throw exception
        }
        return $this->data[$key];
    }

}