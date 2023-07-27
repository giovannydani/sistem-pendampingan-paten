<?php
namespace App\Enums;

enum UserType : string{
    case Normal = "NRL";
    case SSOUMS = "SSO UMS";

    public function isNormal() : bool
    {
        return $this === self::Normal;
    }
    
    public function isSSO() : bool
    {
        return $this != self::Normal;
    }
    
    public function isSSOUms() : bool
    {
        return $this === self::SSOUMS;
    }
}
?>