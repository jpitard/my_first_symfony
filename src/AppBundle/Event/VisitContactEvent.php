<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 26/01/17
 * Time: 09:55
 */

namespace AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class VisitContactEvent extends Event {

    private $ip;

    /**
     * VisitContactEvent constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

}