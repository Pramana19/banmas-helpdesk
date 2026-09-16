<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'ticket_number',
    'title',
    'description',
    'category_id',
    'reporter_id',
    'technician_id',
    'priority',
    'status',
    'location',
    'attachment',
    'solution'
])]
class Ticket extends Model
{
    use HasFactory;

    // Relasi: Tiket ini milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Tiket ini dibuat oleh user (pelapor)
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // Relasi: Tiket ini ditangani oleh user (teknisi)
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}