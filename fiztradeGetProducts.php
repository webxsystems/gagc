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
    public $params = array();
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



    function __construct($params){
        $this->params = implode("/", $params);
    }

    public function ByMetalType($type){
        $this->type = "/".$type;
        $this->url = $this->params.$this->type;
        $c = curl_init($this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
    }

    public function buildRecord($goldProduct){
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