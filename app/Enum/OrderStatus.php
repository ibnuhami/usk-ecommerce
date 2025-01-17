<?php

namespace App\Enum;

enum OrderStatus: String {
    case PENDING = '0';
    case SUCCESS = '1';
    case CANCEL = '2';
}
