<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Artist;
use App\Models\Gallery;
use URL;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::with('artworks')->get();

        return view('view-galleries', [
            'title' => 'Galleries',
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artworks = Artwork::get();

        return view('add-gallery', [
            'title' => 'Add Gallery',
            'artworks' => $artworks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery = new Gallery;
        $gallery->title = $request->title;
        $gallery->save();

        $artworks = $request->get('artworks');
        $gallery->artworks()->sync($artworks);

        return redirect('/galleries')->with(
            'success',
            'New gallery, "' . $gallery->title . '" added successfully!'
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Artist::with('artworks')->find($id);

        return view('show-artist', [
            'artist' => $artist,
            'title' => $artist->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $artist = Artist::with('artworks')->find($id);

        // return view('edit-artist', [
        //     'artist' => $artist,
        //     'title' => 'Edit ' . $artist->name
        // ]);
        $gallery = Gallery::with('artworks')->find($id);
        $artworks = Artwork::get();

        return view('edit-gallery', [
            'gallery' => $gallery,
            'artworks' => $artworks,
            'title' => 'Edit ' . $gallery->title
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->title = $request->title;
        $gallery->save();

        $artworks = $request->get('artworks');
        $gallery->artworks()->sync($artworks);

        return redirect(URL::previous())->with(
            'success',
            'Gallery, "' . $gallery->title . '" updated successfully!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return redirect(URL::previous())->with(
            'success',
            'The gallery, "' . $gallery->title . '" was deleted successfully!'
        );
    }
}
