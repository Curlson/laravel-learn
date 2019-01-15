<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/28
 * Time: 14:35
 */

class DemoService
{
    private $project;

    private $organization;

    private $depot;

    private $factory;

    public function __construct($project, $organization, $depot, $factory)
    {
        $this->project = $project;
        $this->organization = $organization;
        $this->depot = $depot;
        $this->factory = $factory;
    }

    private function getOrderData()
    {

    }

    private function getOrderGoodsList()
    {

    }
}