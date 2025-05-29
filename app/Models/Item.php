<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['namaBarang', 'jumlah'];

    public function borrowings()
    {
        return $this->belongsToMany(Borrowing::class, 'borrowing_item')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
