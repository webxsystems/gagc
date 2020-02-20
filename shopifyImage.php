<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/9/2020
 * Time: 2:37 PM
 */

class shopifyImage
{
    public $token;
    public $ch;
    public $image;
    public $result;
    public $productID;
    public $target;
    public $imageURL;
    public $returnJSON;

    function __construct($params){
        $this->params = implode("/", $params);
        //echo $this->params."\n\n";
    }

    public function addImage($shopifyConfig, $image){
        //$token = '62a23c57e44dfcafe8340d432ea37176';
        $this->token = $shopifyConfig['token'];
        $this->target = $shopifyConfig['url'].$shopifyConfig['path'];
        $ch = curl_init($this->target);

        //$ch = curl_init("https://greatamericangold.myshopify.com/admin/products/".$products['id']."/images.json");
        //$image = json_encode(array('image'=> array('src' => 'https://azrstgp1.blob.core.windows.net/goldimages/half_gram_igr_obv_250x250_jpg')));
        //echo "Image : ". $image."\n\n";
        $this->image = json_encode(array('image'=> array('src' => $image)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->image);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "X-Shopify-Access-Token: ".$this->token
        ));
        $result = curl_exec($ch);
        return $result;
    }



    public function ByCode($code){
        $this->code = "/".$code;
        $this->url = $this->params.$this->code;
        $c = curl_init($this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $this->returnJSON = curl_exec($c);
        curl_close($c);
        return $this->returnJSON;
    }

    public function buildRecord($goldImage){

        self::setImageURL($goldImage->imageURL);
       // echo "imageURL : ".$goldImage->imageURL."\n\n";
        //  self::setImageSmallURL($goldImage->imageSmallURL);
        //  self::setImageObverseURL($goldImage->imageLargeObverseURL);
        //  self::setImageReverseURL($goldImage->imageLargeReverseURL);
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