<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;
use App\Models\Gallery;

class Artwork extends Model
{
    use HasFactory;

    protected $table = 'artworks';
    protected $fillable = ['title', 'image', 'statement'];

    /**
     * Get the artist that owns the bio.
     */
    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    /**
     * The galleries that belong to the artwork.
     */
    public function galleries() {
        return $this->belongsToMany(Gallery::class, 'artwork_gallery','artwork_id', 'gallery_id');
    }

}
