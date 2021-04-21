<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;

class Bio extends Model
{
    use HasFactory;

    protected $table = 'bios';
    protected $fillable = ['title', 'text'];

    /**
     * Get the artist that owns the bio.
     */
    public function artist() {
        return $this->belongsTo(Artist::class);
    }
    
}
