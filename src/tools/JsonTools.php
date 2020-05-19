<?php
namespace Hbe\ServiceLog\Sdk;

final class JsonTools
{
    public function CleanArray($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->CleanArray($value);
            } else {
                if (empty($value)){
                    unset($array[$key]);
                }
            }
        }
        return $array;
    }
}
?>