<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_logbook extends Model
{
    protected $table = 'detail_logbook';
    protected $fillable = [
        'logbook_id',
        'no',
        'waktu',
        'aktivitas',
        'proyek',
        'deskripsi',
        'pekerja',
        'output',
    ];

    public function record()
    {
        return $this->belongsTo(Logbook::class, 'logbook_id');
    }
}
