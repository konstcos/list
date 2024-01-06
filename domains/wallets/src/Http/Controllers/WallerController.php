<?php

namespace Wallets\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class WallerController extends BaseController
{

    public function userWallets(): array
    {

        return [
            'status' => 'success',
            'info' => 'user wallets',
            'data' => [

            ],
        ];
    }

}
