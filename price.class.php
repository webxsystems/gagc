<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/28/2020
 * Time: 11:44 AM
 */

class Price
{
    private $params = array();
    private $c;
    private $code;
    private $data = array();

    function __construct($params){
        $this->params = implode("/", $params);
    }

    private function byCode($code){
        $this->url = $this->params."/".$this->code;
        $this->c = curl_init($this->url);
        curl_setopt($this->c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($this->c);
        curl_close($this->c);
        return $this->returnJSON;
    }

    public function getPrice($code){
        $this->url = "https://connect.fiztrade.com/FizServices/GetPrice/4103-906cd5f5ebddd4dab583e9a5ec0e414d/".$code."/none/";
        //$this->code = "/". $code;
        //$this->url = $this->params.$this->code;
        $c = curl_init($this->url);
        //$c = curl_init("https://connect.fiztrade.com/FizServices/GetPrice/4103-906cd5f5ebddd4dab583e9a5ec0e414d/10PAL/none/");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
    }

    private function addPrice($data){

        $apikey = $config['ApiKey'];
        $pass = $config['Password'];

        $url = "https://" . $apikey . ":" . $pass . "@greatamericangold.myshopify.com/admin/products/" . $product_id . ".json";


        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response[] = curl_exec($curl);
        if (curl_errno($curl)) {
            $response[] = "errno : " . $curl_errno($curl) . " : " . $curl_strerror($curl_errno($curl)) . "\n";
            //                echo json_encode($response);
        }
    }
}