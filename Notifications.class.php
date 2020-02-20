<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/16/2020
 * Time: 7:55 PM
 */

class Notifications
{

    public $event = array("ProductUpdates","PremiumUpdates","MarketTransitions","CLIRADealerSignUp","ShipmentReceived");
    public $data;
    public $host;
    public $status;
    public $lastStatus;
    public $params;
    public $lastNotificationTime;

    function __construct($params){
        $this->params = implode("/", $params);
    }

    public function register(){

    }

    public function getNotification(){

    }

    public function clientCallback(){

    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

}