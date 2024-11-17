<?php

namespace App\Models;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    protected $hidden = [
        'secret',
    ];
}
