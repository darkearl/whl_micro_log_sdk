<?php
namespace Hbe\ServiceLog\Sdk;

require_once(__DIR__ . "/../tools/ServiceHelper.php");
require_once(__DIR__."/../tools/JsonTools.php");
require_once(__DIR__."/../tools/UrlTools.php");

final class ExceptionLog
{
    private $filter;
    private $data;
    private $action;
    private $actionMap = array("create" => "POST", "get" => "GET");

    /**
     * @param $level ( info | debug | warning | error )
     * @param $message
     * @param $date
     * @return $this
     */
    public function create($level, $message, $date)
    {
        $this->data = ["Level"=>$level, "Message" => $message, "Date" => $date];
        $this->action = "create";
        return $this;
    }

    public function withParameters($filter)
    {
        $this->filter = $filter;
        return $this;
    }

    public function get()
    {
        $this->action = "get";
        return $this;
    }

    private function buildCreateJson()
    {

        $arrayData = [
            'Level'   => $this->data["Level"],
            'Message'   => $this->data["Message"],
            'Date'   => $this->data["Date"]
        ];

        $jsonTools = new JsonTools();
        $arrayData = $jsonTools->CleanArray($arrayData);

        return json_encode($arrayData);
    }

    private function buildJson()
    {
        switch ($this->action) {
            case "create":
                return $this->buildCreateJson();
        }

        return "";
    }

    private function buildUrl()
    {
        $urlTools = new UrlTools();
        switch ($this->action) {
            case "create":
                return "exception";
            case "get":
                return $urlTools->BuildQueryStringUrl("exception", $this->filter);
        }

        return "charges";
    }

    public function call()
    {
        $data = $this->buildJson();
        $url = $this->buildUrl();

        return ServiceHelper::privateApiCall($this->actionMap[$this->action], $url, $data);
    }
}