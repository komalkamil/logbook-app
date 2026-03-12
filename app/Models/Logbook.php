<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $table = 'logbook';
    protected $fillable = [
        'user_id',
        'hm',
        'tanggal'
    ];

    public function details()
    {
        return $this->hasMany(Detail_logbook::class, 'logbook_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
