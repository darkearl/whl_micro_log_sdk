<?php
namespace Hbe\ServiceLog\Sdk;

require_once(__DIR__ . "/../tools/ServiceHelper.php");
require_once(__DIR__."/../tools/JsonTools.php");
require_once(__DIR__."/../tools/UrlTools.php");

final class UserActivity
{
	private $filter;
	private $data;
    private $action;
	private $actionMap = array("create" => "POST", "get" => "GET");

	 public function create($userId, $hotelId, $function, $message, $date)
    {
        $this->data = ["UserID" => $userId, "HotelID"=>$hotelId, "Function"=>$function, "Message" => $message, "Date" => $date];
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
            'UserID'      => $this->data["UserID"],
            'HotelID'    => $this->data["HotelID"],
            'Function'   => $this->data["Function"],
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
                return "userActivity";
            case "get":
                return $urlTools->BuildQueryStringUrl("userActivity", $this->filter);
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