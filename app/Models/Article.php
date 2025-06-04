<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Fields yang boleh diisi lewat mass assignment
    protected $fillable = [
        'institution_id',
        'title',
        'content',
    ];

    // Relasi ke Institution (optional, tapi bagus untuk relasi)
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
