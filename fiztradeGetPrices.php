<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/31/2020
 * Time: 10:07 AM
 */

class fiztradeGetPrices
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

//
//    function __construct()
//    {
//        $this->api = "4103-906cd5f5ebddd4dab583e9a5ec0e414d/";
//        $this->token = "6b6cee771b9c96bae6687cda210a3592";
//        $this->devServerURL = "https://connect.fiztrade.com/";
//        $this->path = "FizServices/";
//    }

    function __construct($params){
        $this->params = implode("/", $params);
    }

    public function ByCode($code){
     //   $this->fullpath = "https://connect.fiztrade.com/FizServices/GetPrices/4103-906cd5f5ebddd4dab583e9a5ec0e414d/".$this->code;
     //   $this->method = "fiztradeGetPrices";
        $this->code = "/". $code;
        $this->url = $this->params.$this->code;
        $c = curl_init($this->url);
//        $c = curl_init("https://connect.fiztrade.com/FizServices/GetPrices/4103-906cd5f5ebddd4dab583e9a5ec0e414d/".$this->code);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
       // if(curl_error($c)){
       //     curl_close($c);
       //     echo "error : ".curl_strerror(curl_errno($c));
       $this->returnJSON = curl_exec($c);
       curl_close($c);
       return $this->returnJSON;
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