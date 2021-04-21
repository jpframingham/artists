<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bio;
use App\Models\Artwork;

class Artist extends Model
{
    use HasFactory;

    protected $table = 'artists';
    protected $fillable = [
        'name',
        'image',
        'styles'
    ];

    /**
     * Get the bio associated with the artist.
     */
    public function bio() {
        return $this->hasOne(Bio::class);
    }

    /**
     * Get the artworks for the artist.
     */
    public function artworks() {
        return $this->hasMany(Artwork::class);
    }

}