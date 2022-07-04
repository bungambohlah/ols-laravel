<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [ 'nama' ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item';

    /**
     * Get list of pajak
     */
    public function pajak()
    {
        return $this->belongsToMany(Pajak::class, 'pajakitem')
        ->select(array('pajak.id', 'pajak.nama', 'pajak.rate'))
        ->as('pajak');
    }
}
