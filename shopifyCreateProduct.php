<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/29/2020
 * Time: 9:02 PM
 */

include('../vendor/phpclassic/php-shopify/lib/ShopifySDK.php');


class shopifyCreateProduct
{
    public $config;
    public $title;
    public $body_html;
    public $vendor;
    public $product_type;
    public $created_at;
    public $handle;
    public $updated_at;
    public $published_at;
    public $template_suffix;
    public $published_scope;
    public $tags;
    public $admin_graphql_api_id;
    public $variants = array();
    public $vTitle;
    public $vPrice;
    public $vSku;
    public $vPosition;
    public $vInventory_policy;
    public $vCompare_at_price;
    public $vFulfillment_service;
    public $vInventory_management;
    public $vOption1;
    public $vOption2;
    public $cOption3;
    public $vTaxable;
    public $vBarcode;
    public $vGrams;
    public $vImage_id;
    public $vWeight;
    public $vWeight_unit;
    public $vInventory_item_id;
    public $vInventory_quantity;
    public $vOld_inventory_quantity;
    public $vRequires_shipping;
    public $vAdmin_graphql_api_id;
    public $options = array();
    public $oProduct_id;
    public $oName;
    public $oPosition;
    public $oValues =  Array();
    public $images = Array();
    public $iProduct_id;
    public $iPosition;
    public $iAlt;
    public $iWidth;
    public $iHeight;
    public $iSrc;
    public $iVariant_ids = Array();
    public $iAdmin_graphql_api_id;

    public function __construct()
    {
        $this->config = array(
            'ShopUrl'          'greatamericangold',
            'ApiKey'           'f228e039662e793f769db44bac35bc73',
            'Password'         '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'
        );
       // PHPShopify\ShopifySDK::config($this->config);
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBodyHtml()
    {
        return $this->body_html;
    }

    /**
     * @param mixed $body_html
     */
    public function setBodyHtml($body_html)
    {
        $this->body_html = $body_html;
    }

    /**
     * @return mixed
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->product_type;
    }

    /**
     * @param mixed $product_type
     */
    public function setProductType($product_type)
    {
        $this->product_type = $product_type;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param mixed $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }

    /**
     * @param mixed $published_at
     */
    public function setPublishedAt($published_at)
    {
        $this->published_at = $published_at;
    }

    /**
     * @return mixed
     */
    public function getTemplateSuffix()
    {
        return $this->template_suffix;
    }

    /**
     * @param mixed $template_suffix
     */
    public function setTemplateSuffix($template_suffix)
    {
        $this->template_suffix = $template_suffix;
    }

    /**
     * @return mixed
     */
    public function getPublishedScope()
    {
        return $this->published_scope;
    }

    /**
     * @param mixed $published_scope
     */
    public function setPublishedScope($published_scope)
    {
        $this->published_scope = $published_scope;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getAdminGraphqlApiId()
    {
        return $this->admin_graphql_api_id;
    }

    /**
     * @param mixed $admin_graphql_api_id
     */
    public function setAdminGraphqlApiId($admin_graphql_api_id)
    {
        $this->admin_graphql_api_id = $admin_graphql_api_id;
    }

    /**
     * @return array
     */
    public function getVariants(): array
    {
        return $this->variants;
    }

    /**
     * @param array $variants
     */
    public function setVariants(array $variants)
    {
        $this->variants = $variants;
    }

    /**
     * @return mixed
     */
    public function getVTitle()
    {
        return $this->vTitle;
    }

    /**
     * @param mixed $vTitle
     */
    public function setVTitle($vTitle)
    {
        $this->vTitle = $vTitle;
    }

    /**
     * @return mixed
     */
    public function getVPrice()
    {
        return $this->vPrice;
    }

    /**
     * @param mixed $vPrice
     */
    public function setVPrice($vPrice)
    {
        $this->vPrice = $vPrice;
    }

    /**
     * @return mixed
     */
    public function getVSku()
    {
        return $this->vSku;
    }

    /**
     * @param mixed $vSku
     */
    public function setVSku($vSku)
    {
        $this->vSku = $vSku;
    }

    /**
     * @return mixed
     */
    public function getVPosition()
    {
        return $this->vPosition;
    }

    /**
     * @param mixed $vPosition
     */
    public function setVPosition($vPosition)
    {
        $this->vPosition = $vPosition;
    }

    /**
     * @return mixed
     */
    public function getVInventoryPolicy()
    {
        return $this->vInventory_policy;
    }

    /**
     * @param mixed $vInventory_policy
     */
    public function setVInventoryPolicy($vInventory_policy)
    {
        $this->vInventory_policy = $vInventory_policy;
    }

    /**
     * @return mixed
     */
    public function getVCompareAtPrice()
    {
        return $this->vCompare_at_price;
    }

    /**
     * @param mixed $vCompare_at_price
     */
    public function setVCompareAtPrice($vCompare_at_price)
    {
        $this->vCompare_at_price = $vCompare_at_price;
    }

    /**
     * @return mixed
     */
    public function getVFulfillmentService()
    {
        return $this->vFulfillment_service;
    }

    /**
     * @param mixed $vFulfillment_service
     */
    public function setVFulfillmentService($vFulfillment_service)
    {
        $this->vFulfillment_service = $vFulfillment_service;
    }

    /**
     * @return mixed
     */
    public function getVInventoryManagement()
    {
        return $this->vInventory_management;
    }

    /**
     * @param mixed $vInventory_management
     */
    public function setVInventoryManagement($vInventory_management)
    {
        $this->vInventory_management = $vInventory_management;
    }

    /**
     * @return mixed
     */
    public function getVOption1()
    {
        return $this->vOption1;
    }

    /**
     * @param mixed $vOption1
     */
    public function setVOption1($vOption1)
    {
        $this->vOption1 = $vOption1;
    }

    /**
     * @return mixed
     */
    public function getVOption2()
    {
        return $this->vOption2;
    }

    /**
     * @param mixed $vOption2
     */
    public function setVOption2($vOption2)
    {
        $this->vOption2 = $vOption2;
    }

    /**
     * @return mixed
     */
    public function getCOption3()
    {
        return $this->cOption3;
    }

    /**
     * @param mixed $cOption3
     */
    public function setCOption3($cOption3)
    {
        $this->cOption3 = $cOption3;
    }

    /**
     * @return mixed
     */
    public function getVTaxable()
    {
        return $this->vTaxable;
    }

    /**
     * @param mixed $vTaxable
     */
    public function setVTaxable($vTaxable)
    {
        $this->vTaxable = $vTaxable;
    }

    /**
     * @return mixed
     */
    public function getVBarcode()
    {
        return $this->vBarcode;
    }

    /**
     * @param mixed $vBarcode
     */
    public function setVBarcode($vBarcode)
    {
        $this->vBarcode = $vBarcode;
    }

    /**
     * @return mixed
     */
    public function getVGrams()
    {
        return $this->vGrams;
    }

    /**
     * @param mixed $vGrams
     */
    public function setVGrams($vGrams)
    {
        $this->vGrams = $vGrams;
    }

    /**
     * @return mixed
     */
    public function getVImageId()
    {
        return $this->vImage_id;
    }

    /**
     * @param mixed $vImage_id
     */
    public function setVImageId($vImage_id)
    {
        $this->vImage_id = $vImage_id;
    }

    /**
     * @return mixed
     */
    public function getVWeight()
    {
        return $this->vWeight;
    }

    /**
     * @param mixed $vWeight
     */
    public function setVWeight($vWeight)
    {
        $this->vWeight = $vWeight;
    }

    /**
     * @return mixed
     */
    public function getVWeightUnit()
    {
        return $this->vWeight_unit;
    }

    /**
     * @param mixed $vWeight_unit
     */
    public function setVWeightUnit($vWeight_unit)
    {
        $this->vWeight_unit = $vWeight_unit;
    }

    /**
     * @return mixed
     */
    public function getVInventoryItemId()
    {
        return $this->vInventory_item_id;
    }

    /**
     * @param mixed $vInventory_item_id
     */
    public function setVInventoryItemId($vInventory_item_id)
    {
        $this->vInventory_item_id = $vInventory_item_id;
    }

    /**
     * @return mixed
     */
    public function getVInventoryQuantity()
    {
        return $this->vInventory_quantity;
    }

    /**
     * @param mixed $vInventory_quantity
     */
    public function setVInventoryQuantity($vInventory_quantity)
    {
        $this->vInventory_quantity = $vInventory_quantity;
    }

    /**
     * @return mixed
     */
    public function getVOldInventoryQuantity()
    {
        return $this->vOld_inventory_quantity;
    }

    /**
     * @param mixed $vOld_inventory_quantity
     */
    public function setVOldInventoryQuantity($vOld_inventory_quantity)
    {
        $this->vOld_inventory_quantity = $vOld_inventory_quantity;
    }

    /**
     * @return mixed
     */
    public function getVRequiresShipping()
    {
        return $this->vRequires_shipping;
    }

    /**
     * @param mixed $vRequires_shipping
     */
    public function setVRequiresShipping($vRequires_shipping)
    {
        $this->vRequires_shipping = $vRequires_shipping;
    }

    /**
     * @return mixed
     */
    public function getVAdminGraphqlApiId()
    {
        return $this->vAdmin_graphql_api_id;
    }

    /**
     * @param mixed $vAdmin_graphql_api_id
     */
    public function setVAdminGraphqlApiId($vAdmin_graphql_api_id)
    {
        $this->vAdmin_graphql_api_id = $vAdmin_graphql_api_id;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getOProductId()
    {
        return $this->oProduct_id;
    }

    /**
     * @param mixed $oProduct_id
     */
    public function setOProductId($oProduct_id)
    {
        $this->oProduct_id = $oProduct_id;
    }

    /**
     * @return mixed
     */
    public function getOName()
    {
        return $this->oName;
    }

    /**
     * @param mixed $oName
     */
    public function setOName($oName)
    {
        $this->oName = $oName;
    }

    /**
     * @return mixed
     */
    public function getOPosition()
    {
        return $this->oPosition;
    }

    /**
     * @param mixed $oPosition
     */
    public function setOPosition($oPosition)
    {
        $this->oPosition = $oPosition;
    }

    /**
     * @return array
     */
    public function getOValues(): array
    {
        return $this->oValues;
    }

    /**
     * @param array $oValues
     */
    public function setOValues(array $oValues)
    {
        $this->oValues = $oValues;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getIProductId()
    {
        return $this->iProduct_id;
    }

    /**
     * @param mixed $iProduct_id
     */
    public function setIProductId($iProduct_id)
    {
        $this->iProduct_id = $iProduct_id;
    }

    /**
     * @return mixed
     */
    public function getIPosition()
    {
        return $this->iPosition;
    }

    /**
     * @param mixed $iPosition
     */
    public function setIPosition($iPosition)
    {
        $this->iPosition = $iPosition;
    }

    /**
     * @return mixed
     */
    public function getIAlt()
    {
        return $this->iAlt;
    }

    /**
     * @param mixed $iAlt
     */
    public function setIAlt($iAlt)
    {
        $this->iAlt = $iAlt;
    }

    /**
     * @return mixed
     */
    public function getIWidth()
    {
        return $this->iWidth;
    }

    /**
     * @param mixed $iWidth
     */
    public function setIWidth($iWidth)
    {
        $this->iWidth = $iWidth;
    }

    /**
     * @return mixed
     */
    public function getIHeight()
    {
        return $this->iHeight;
    }

    /**
     * @param mixed $iHeight
     */
    public function setIHeight($iHeight)
    {
        $this->iHeight = $iHeight;
    }

    /**
     * @return mixed
     */
    public function getISrc()
    {
        return $this->iSrc;
    }

    /**
     * @param mixed $iSrc
     */
    public function setISrc($iSrc)
    {
        $this->iSrc = $iSrc;
    }

    /**
     * @return array
     */
    public function getIVariantIds(): array
    {
        return $this->iVariant_ids;
    }

    /**
     * @param array $iVariant_ids
     */
    public function setIVariantIds(array $iVariant_ids)
    {
        $this->iVariant_ids = $iVariant_ids;
    }

    /**
     * @return mixed
     */
    public function getIAdminGraphqlApiId()
    {
        return $this->iAdmin_graphql_api_id;
    }

    /**
     * @param mixed $iAdmin_graphql_api_id
     */
    public function setIAdminGraphqlApiId($iAdmin_graphql_api_id)
    {
        $this->iAdmin_graphql_api_id = $iAdmin_graphql_api_id;
    }


}