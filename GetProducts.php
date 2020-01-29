<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/28/2020
 * Time: 3:21 AM
 */

class GetProducts
{
    private $type;
    private $api;
    private $returnJSON;
    private $devServerURL;
    private $path;
    private $method;
    private $url;
    private $c;
    private $fullpath;


    function __construct()
    {
        $this->api = "4103-906cd5f5ebddd4dab583e9a5ec0e414d/";
        $this->devServerURL = "https://stage-connect.fiztrade.com/";
        $this->path = "FizServices/";


    }

    public function ByMetalType($type){
        $this->fullpath = "https://connect.fiztrade.com/FizServices/GetProductsByMetalV2/4103-906cd5f5ebddd4dab583e9a5ec0e414d/Gold";
        $this->method = "GetProductsByMetalV2";
        $this->type = $type;
        $this->url = $this->devServerURL.$this->path.$this->api.$this->type;
        //$c = curl_init($this->url);
        $c = curl_init("https://connect.fiztrade.com/FizServices/GetProductsByMetalV2/4103-906cd5f5ebddd4dab583e9a5ec0e414d/Gold");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
    }
}