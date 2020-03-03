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
    private $code;
    public $fullpath;
    public $method;
    public $url;
    private $returnJSON;
    private $token;
    public $isActiveSell;
    public $availability;
    public $priceTier1;
    public $priceTier2;
    public $convPrice;
    private $params = array();

    // https://connect.fiztrade.com/FizServices/GetPrice/4103-906cd5f5ebddd4dab583e9a5ec0e414d/10PAL/none

    // {"spread":1640.0,"location":"","code":"10PAL","isActiveSell":"Y","bid":25076.0,"availability":"1-5 Days","isActiveBuy":"Y","ask":26716.0}


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

    public function GetPrice($code){
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

    public function buildRecord($goldPrice){
        //self::setAvailability($goldPrice->availability);
        //self::setIsActiveSell($goldPrice->isActiveSell);

        self::setPriceTier1($goldPrice);
        self::setPriceTier2($goldPrice);
        self::setPriceTier3($goldPrice);
        self::setPriceTier4($goldPrice);
//        self::setPriceTier1(number_format($goldPrice->{'tiers'}->{1}->{'ask'}), 1, '.','');
//        self::setPriceTier2(number_format($goldPrice->{'tiers'}->{2}->{'ask'}), 2, '.','');
//        self::setPriceTier3(number_format($goldPrice->{'tiers'}->{3}->{'ask'}), 3, '.','');
//        self::setPriceTier4(number_format($goldPrice->{'tiers'}->{4}->{'ask'}), 4, '.','');
    }

    public function getPrices($code){
        $this->code = "/" . $code;
        $this->url = $this->params . $this->code;
        $c = curl_init($this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        if(curl_errno($c)){
            echo "errno : ". curl_errno($c)." : ".curl_strerror(curl_errno($c))."\n";
            return "error";
        }
        curl_close($c);
        return $this->returnJSON;
    }

    private function get_percentage($total, $percentage){
        if ($total > 0){
            $number = round($total * ($percentage / 100), 2 );
            return $total + $number;
        }else{
            return 0;
        }
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