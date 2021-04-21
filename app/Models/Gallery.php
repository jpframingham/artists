<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Artwork;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';
    protected $fillable = ['title'];

    /**
     * Get the artworks for the artist.
     */
    public function artworks() {
        return $this->belongsToMany(Artwork::class, 'artwork_gallery', 'gallery_id', 'artwork_id');
    }

}
