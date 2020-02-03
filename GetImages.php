<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/31/2020
 * Time: 8:57 PM
 */

class GetImages
{
    public $api;
    public $devServerURL;
    public $path;
    public $code;
    public $fullpath;
    public $method;
    public $returnJSON;

    public $token;
    public $imageURL;
    public $imageSmallURL;
    public $imageLargeURL;

    function __construct()
    {
        $this->api = "4103-906cd5f5ebddd4dab583e9a5ec0e414d/";
        $this->devServerURL = "https://connect.fiztrade.com/";
        $this->path = "FizServices/";
    }

    public function ByCode($code){
        $this->fullpath = "https://connect.fiztrade.com/FizServices/GetCoinImages/4103-906cd5f5ebddd4dab583e9a5ec0e414d/Gold";
        $this->method = "GetCoinImages";
        $this->code = $code;
        $c = curl_init("https://connect.fiztrade.com/FizServices/GetCoinImages/4103-906cd5f5ebddd4dab583e9a5ec0e414d/".$this->code);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
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

    /**
     * @return mixed
     */
    public function getImageLargeURL()
    {
        return $this->imageLargeURL;
    }

    /**
     * @param mixed $imageLargeURL
     */
    public function setImageLargeURL($imageLargeURL)
    {
        $this->imageLargeURL = $imageLargeURL;
    }
}