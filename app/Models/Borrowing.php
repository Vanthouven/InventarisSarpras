<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama','role','jurusan','kelas','status'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'borrowing_item')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}