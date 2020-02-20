<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/9/2020
 * Time: 6:50 PM
 */

class shopifyPrice
{

    public $api;
    public $devServerURL;
    public $path;
    public $code;
    public $fullpath;
    public $method;
    public $url;
    public $returnJSON;
    public $token;
    public $isActiveSell;
    public $availability;
    public $priceTier1;
    public $priceTier2;
    public $priceTier3;
    public $priceTier4;

    function __construct($params){
        $this->params = implode("/", $params);
    }

    public function ByCode($code){
        $this->code = "/". $code;
        $this->url = $this->params.$this->code;
        $c = curl_init($this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
    }

    public function addPrice($url){
       //$url = "https://{$apikey}:".$password."@greatamericangold.myshopify.com/admin/products/".$product_id.".json";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($curl);
        if(curl_errno($curl)){
            echo "errno : ".$curl_errno($curl)." : ".$curl_strerror($curl_errno($curl))."\n";
            die();
        }
        curl_close($curl);

        $result = json_decode($result);
    }

    public function buildRecord($goldPrice){
        self::setAvailability($goldPrice->availability);
        self::setIsActiveSell($goldPrice->isActiveSell);
        self::setPriceTier1(number_format($goldPrice->{'tiers'}->{1}->{'ask'}), 2, '.','');
        self::setPriceTier2(number_format($goldPrice->{'tiers'}->{2}->{'ask'}), 2, '.','');
        self::setPriceTier3(number_format($goldPrice->{'tiers'}->{3}->{'ask'}), 2, '.','');
        self::setPriceTier4(number_format($goldPrice->{'tiers'}->{4}->{'ask'}), 2, '.','');
    }

    /**
     * @return mixed
     */
    public function getisActiveSell()
    {
        return $this->isActiveSell;
    }

    /**
     * @param mixed $isActiveSell
     */
    public function setIsActiveSell($isActiveSell)
    {
        $this->isActiveSell = $isActiveSell;
    }

    /**
     * @return mixed
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param mixed $availability
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }



    /**
     * @return mixed
     */
    public function getPriceTier1()
    {
        return $this->priceTier1;
    }

    /**
     * @param mixed $priceTier1
     */
    public function setPriceTier1($priceTier1)
    {
        $this->priceTier1 = $priceTier1;
    }

    /**
     * @return mixed
     */
    public function getPriceTier2()
    {
        return $this->priceTier2;
    }

    /**
     * @param mixed $priceTier2
     */
    public function setPriceTier2($priceTier2)
    {
        $this->priceTier2 = $priceTier2;
    }

    /**
     * @return mixed
     */
    public function getPriceTier3()
    {
        return $this->priceTier3;
    }

    /**
     * @param mixed $priceTier3
     */
    public function setPriceTier3($priceTier3)
    {
        $this->priceTier3 = $priceTier3;
    }

    /**
     * @return mixed
     */
    public function getPriceTier4()
    {
        return $this->priceTier4;
    }

    /**
     * @param mixed $priceTier4
     */
    public function setPriceTier4($priceTier4)
    {
        $this->priceTier4 = $priceTier4;
    }
}

