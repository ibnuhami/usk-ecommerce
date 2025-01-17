<?php
namespace App\Enum;

enum CartStatus : String {
    case NO_ORDER = '0';
    case ALREADY_ORDER = '1';
    case DELETE_ORDER = '2';
}
