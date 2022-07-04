<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [ 'nama', 'rate' ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pajak';
}
