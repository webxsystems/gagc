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
    public $returnJSON;
    public $token;
    public $priceTier1;
    public $priceTier2;
    public $priceTier3;
    public $priceTier4;


    function __construct()
    {
        $this->api = "4103-906cd5f5ebddd4dab583e9a5ec0e414d/";
        $this->token = "6b6cee771b9c96bae6687cda210a3592";
        $this->devServerURL = "https://connect.fiztrade.com/";
        $this->path = "FizServices/";
    }

    public function ByCode($code){
        $this->fullpath = "https://connect.fiztrade.com/FizServices/fiztradeGetPrices/4103-906cd5f5ebddd4dab583e9a5ec0e414d/Gold";
        $this->method = "fiztradeGetPrices";
        $this->code = $code;
        $c = curl_init("https://connect.fiztrade.com/FizServices/fiztradeGetPrices/4103-906cd5f5ebddd4dab583e9a5ec0e414d/".$this->code);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
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