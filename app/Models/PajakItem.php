<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakItem extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [ 'pajak_id', 'item_id' ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pajakitem';
}
