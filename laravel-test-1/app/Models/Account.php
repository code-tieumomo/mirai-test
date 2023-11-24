<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $registerID
 * @property string $login
 * @property string $password
 * @property string $phone
 */
class Account extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $primaryKey = 'registerID';

    public $timestamps = false;

    protected $fillable = [
        'registerID',
        'login',
        'password',
        'phone',
    ];

    public $filterFields = [
        'registerID' => 'id',
        'login',
        'phone',
    ];

    public $sortFields = [
        'registerID' => 'id',
        'login',
        'phone',
    ];
}
