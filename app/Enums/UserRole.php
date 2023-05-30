<?php 
namespace App\Enums;

enum UserRole : string {
    case USER = "USR";
    case ADMIN = "ADM";
    case SUPERADMIN = "SADM";
    
    public function isUser() : bool
    {
        return $this === self::USER;
    }
    
    public function isSuperAdmin() : bool
    {
        return $this === self::SUPERADMIN;
    }

    public function isAdmin() : bool
    {
        return $this === self::ADMIN || $this === self::SUPERADMIN;
    }
    
    public static function getArrayRole() : array
    {
        return [self::ADMIN->value, self::SUPERADMIN->value, self::USER->value];
    }
    
    public static function getMiddlewareUserRole() : string
    {
        return 'role:'.self::USER->value;
    }
    
    public static function getMiddlewareAdminRole() : string
    {
        return 'role:'.self::ADMIN->value;
    }
    
    public static function getMiddlewareSuperAdminRole() : string
    {
        return 'role:'.self::SUPERADMIN->value;
    }
    
    public static function getMiddlewareSuperAdminAndAdminRole() : string
    {
        return 'role:'.self::SUPERADMIN->value.'|'.self::ADMIN->value;
    }
    
    public static function getMiddlewareAllRole() : string
    {
        return 'role:'.self::SUPERADMIN->value.'|'.self::ADMIN->value.'|'.self::USER->value;
    }
}
?>