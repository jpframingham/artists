<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Artist;
use App\Models\Gallery;
use URL;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artworks = Artwork::with('artist', 'galleries')->get();

        return view('view-artworks', [
            'title' => 'Artworks',
            'artworks' => $artworks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::get();
        $galleries = Gallery::get();

        return view('add-artwork', [
            'title' => 'Add Artwork',
            'artists' => $artists,
            'galleries' => $galleries
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
        $artwork = new Artwork;
        $artwork->title = $request->title;
        $artwork->statement = $request->statement;
        $artwork->artist_id = $request->artist_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = strtolower(str_replace(' ', '_', $request->title));
            $image_time = time();
            $image_extension = '.' . $image->getClientOriginalExtension();
            $full_image_name = $image_name . ' ' . $image_time . $image_extension;
            $image_path = date('Y/m/d');
            $destination_path = public_path('/images/' . $image_path);
            $image->move($destination_path, $full_image_name);
            $artwork->image = $image_path . '/' . $full_image_name;
        }
        $artwork->save();

        $galleries = $request->get('galleries');
        $artwork->galleries()->sync($galleries);

        return redirect('/artworks')->with(
            'success',
            'New artwork, "' . $artwork->title . '" added successfully!'
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
            'artist' => $artist->name,
            'title' => $artwork->title
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
        $artwork = Artwork::with('artist', 'galleries')->find($id);
        $artists = Artist::get();

        return view('edit-artwork', [
            'artwork' => $artwork,
            'title' => 'Edit ' . $artwork->title,
            'artists' => $artists
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
        $artwork = Artwork::find($id);
        $artwork->title = $request->title;
        $artwork->statement = $request->statement;
        $artwork->artist_id = $request->artist_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = strtolower(str_replace(' ', '_', $request->title));
            $image_time = time();
            $image_extension = '.' . $image->getClientOriginalExtension();
            $full_image_name = $image_name . ' ' . $image_time . $image_extension;
            $image_path = date('Y/m/d');
            $destination_path = public_path('/images/' . $image_path);
            $image->move($destination_path, $full_image_name);
            $artwork->image = $image_path . '/' . $full_image_name;
        } else {
            $artwork->image = $request->old_image;
        }

        $artwork->save();

        $galleries = $request->get('galleries');
        $artwork->galleries()->sync($galleries);

        return redirect(URL::previous())->with(
            'success',
            'The artwork, "' . $artwork->title . '" was updated successfully!'
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
        //
    }
}
