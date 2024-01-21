<?php

namespace Wallets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletUser extends Model
{

    use SoftDeletes;

    protected $table = 'wallet_users';

}
