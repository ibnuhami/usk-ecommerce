<?php
namespace App\Enum;

enum UserType: String {
    case Admin = 'admin';
    case User = 'user';
    case SuperAdmin = 'super_admin';
}
