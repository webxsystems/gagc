<?php
/**
 * Created by PhpStorm.
 * User: webxsys
 * Date: 2/5/20
 * Time: 12:53 AM
 */

class fiztradeGetProducts
{
    public $type;
    public $api;
    public $returnJSON;
    public $devServerURL;
    public $path;
    public $method;
    public $url;
    public $c;
    public $fullpath;
    public $name;
    public $metalType;
    public $code;
    public $description;
    public $weight;
    public $category;
    public $fineness;
    public $price;


    public function ByMetalType($type){
        $this->fullpath = "https://connect.fiztrade.com/FizServices/GetProductsByMetalV2/4103-906cd5f5ebddd4dab583e9a5ec0e414d/Gold";
        $this->method = "GetProductsByMetalV2";
        $this->type = $type;
        $this->url = $this->devServerURL.$this->path.$this->api.$this->type;
        $c = curl_init("https://connect.fiztrade.com/FizServices/GetProductsByMetalV2/4103-906cd5f5ebddd4dab583e9a5ec0e414d/Gold");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
    }

    public function buildRecsssord($goldProduct){
        self::setName($goldProduct->name);
        self::setCode($goldProduct->code);
        self::setCategory($goldProduct->category);
        self::setDescription($goldProduct->description);
        self::setFineness($goldProduct->fineness);
        self::setMetalType($goldProduct->metalType);
        self::setWeight($goldProduct->weight);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getMetalType()
    {
        return $this->metalType;
    }
    /**
 * @param mixed $metalType
 */
    public function setMetalType($metalType)
    {
        $this->metalType = $metalType;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getFineness()
    {
        return $this->fineness;
    }

    /**
     * @param mixed $fineness
     */
    public function setFineness($fineness)
    {
        $this->fineness = $fineness;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}