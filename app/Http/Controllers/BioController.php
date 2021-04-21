<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bio;
use App\Models\Artist;
use URL;

class BioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::get();
        return view('add-bio', [
            'title' => 'Add Bio',
            'artists' => $artists
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
        $bio = new Bio;
        $bio->title = $request->title;
        $bio->text = $request->text;
        $bio->artist_id = $request->artist_id;
        $bio->save();

        return redirect('/artists/' . $bio->artist->id)->with(
            'success',
            'New bio added for ' . $bio->artist->name . '!'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bio = Bio::find($id);
        $artists = Artist::get();

        return view('edit-bio', [
            'title' => 'Edit ' . $bio->title,
            'bio' => $bio,
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
        $bio = Bio::find($id);
        $bio->title = $request->title;
        $bio->text = $request->text;
        $bio->artist_id = $request->artist_id;
        $bio->save();

        return redirect('/artists/' . $bio->artist->id)->with(
            'success',
            'Bio updated for ' . $bio->artist->name . '!'
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
