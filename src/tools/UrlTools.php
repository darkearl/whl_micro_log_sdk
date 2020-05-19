<?php
namespace Hbe\ServiceLog\Sdk;

final class UrlTools
{
    public function BuildQueryStringUrl($baseUrl, $filter)
    {
        $url = $baseUrl;
        if (!empty($filter)) {
            $url .= "?";
            foreach ($filter as $key => $value) {
                $url .= urlencode($key) . "=" . urlencode($value) .'&';
            }
        }
        return $url;
    }
}
?>