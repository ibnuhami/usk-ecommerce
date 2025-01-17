<?php

namespace App\Enum;

enum OrderStatus: String {
    case PENDING = '0';
    case PAID = '1';
    case CONFIRM = '2';
    case CANCEL = '3';

}
