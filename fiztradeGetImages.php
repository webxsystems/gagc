<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/31/2020
 * Time: 8:57 PM
 */

class fiztradeGetImages
{
    public $api;
    public $devServerURL;
    public $path;
    public $code;
    public $fullpath;
    public $url;
    public $method;
    public $returnJSON;
    public $params = array();
    public $token;
    public $imageURL;
    public $imageObverseURL;
    public $imageReverseURL;
    public $imageSmallURL;

    function __construct($params){
        $this->params = implode("/", $params);
    }

    public function ByCode($code){
        //$this->fullpath = "https://connect.fiztrade.com/FizServices/GetCoinImages/4103-906cd5f5ebddd4dab583e9a5ec0e414d/Gold";
        //$this->method = "GetCoinImages";
        $this->code = "/".$code;
        $this->url = $this->params.$this->code;
        $c = curl_init($this->url);
 //       $c = curl_init("https://connect.fiztrade.com/FizServices/GetCoinImages/4103-906cd5f5ebddd4dab583e9a5ec0e414d/".$this->code);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
    }

    public function buildRecord($goldImage){
        self::setCode($goldImage->code);
        self::setImageURL($goldImage->imageURL);
        self::setImageSmallURL($goldImage->imageSmallURL);
      //  self::setImageObverseURL($goldImage->imageLargeObverseURL);
      //  self::setImageReverseURL($goldImage->imageLargeReverseURL);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /**
     * @param mixed $imageURL
     */
    public function setImageURL($imageURL)
    {
        $this->imageURL = $imageURL;
    }

    /**
     * @return mixed
     */
    public function getImageObverseURL()
    {
        return $this->imageObverseURL;
    }

    /**
     * @param mixed $imageObverseURL
     */
    public function setImageObverseURL($imageObverseURL)
    {
        $this->imageObverseURL = $imageObverseURL;
    }

    /**
     * @return mixed
     */
    public function getImageReverseURL()
    {
        return $this->imageReverseURL;
    }

    /**
     * @param mixed $imageReverseURL
     */
    public function setImageReverseURL($imageReverseURL)
    {
        $this->imageReverseURL = $imageReverseURL;
    }

    /**
     * @return mixed
     */
    public function getImageSmallURL()
    {
        return $this->imageSmallURL;
    }

    /**
     * @param mixed $imageSmallURL
     */
    public function setImageSmallURL($imageSmallURL)
    {
        $this->imageSmallURL = $imageSmallURL;
    }



}