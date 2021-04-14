<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist; # UPDATE ME W12
use URL;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Index is for displaying all of the artists in a list
        // The index method uses a static get method of the mdoel to select all artists from the database.
        // Then it returns a view and passes variables for the title and the artists to it.
        $artists = Artist::get();
        return view('view-artists',
        [
            'title' => 'Artists',
            'artists' => $artists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // The create method is used to display the form the user would use to add a new item to the database.
        // It will list an array of image files, and return a view and pass variables for the title and the image files to it.
        $images =
        [
        'Leonardo da Vinci' => 'da-vinci.jpg',
        'Walt Disney' => 'disney.jpg',
        'Frida Kahlo' => 'kahlo.jpg',
        'Pablo Picasso' => 'picasso.jpg',
        'Bob Ross' => 'ross.jpg',
        'Charles M.Schulz' => 'schulz.jpg',
        'Bill Watterson' => 'watterson.jpg',
        'Vincent van Goch' => 'van-goch.jpg'
        ];
        return view('add-artist',
        [
            'title' => 'Add Artist',
            'images' => $images
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

        // The store method will be used to actually save data from the database once it is collected.
        // It will validate the form using the validate() method of the request object.

        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|max:255',
            'styles' => 'required'
        ]);

        // Then we will create a new instance of the Artist class and then set each property of the artist object to be equal to the corresponding property of the request object which was collected from the form.
        $artist = new Artist;

        $artist->name = $request->name;
        $artist->image = $request->image;
        $artist->styles = $request->styles;

        // The artist object is then saved and stored in the database using the model's save() method.
        $artist->save();

        // Finally, the user is redirected back to the home page with a success message.
        return redirect('/')->with(
            'success',
            'New artist, "' . $artist->name . '" added successfully!'
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
        // The edit method is very similar to the create method excecpt that it takes in an ID from the route, selects artists from the database if their ID matches, then selects the first one.
        // The artist is then passed to the view so that its properties can be used in the form to display their currently existing data.
        // $artist = Artist::get('id', $id)->first();
        $artist = Artist::where('id', $id)->first();

        // FINISHED W11 HERE

        $images =
        [
        'Leonardo da Vinci' => 'da-vinci.jpg',
        'Walt Disney' => 'disney.jpg',
        'Frida Kahlo' => 'kahlo.jpg',
        'Pablo Picasso' => 'picasso.jpg',
        'Bob Ross' => 'ross.jpg',
        'Charles M.Schulz' => 'schulz.jpg',
        'Bill Watterson' => 'watterson.jpg',
        'Vincent van Goch' => 'van-goch.jpg'
        ];
        return view('edit-artist',
        [
        'artist' => $artist,
        'title' => 'Edit ' . $artist->name,
        'images' => $images
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
        // The update method is very similar to the store method except that it selects a specific artist and reassigns its properties instead of creating a new instance of the Artist class.

        $request->validate(
        [
        'name' => 'required|max:255',
        'image' => 'required|max:255',
        'styles' => 'required'
        ]);

        // $artist = Artist::get('id', $id)->first();
        $artist = Artist::where('id', $id)->first();

        $artist->name = $request->name;
        $artist->image = $request->image;
        $artist->styles = $request->styles;

        // The artist object is then saved and stored in the database using the model's save() method.
        $artist->save();

        // Finally, the user is redirected back to the home page with a success message.
        // return redirect(URL::previous())->with(
        return redirect('/')->with(
            'success',
            'The artist, "' . $artist->name . '" was updated successfully!'
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
        // The destroy method is fairly simple. It just selects an artist with an ID that matches the one which was passed to the method in the route.
        // Then it uses the delete() method to delete it and redirects back to the previous page using the URL class and the previous() method.
        // $artist = Artist::get('id', $id)->first();
        $artist = Artist::where('id', $id)->first();
        $artist->delete();

        // return redirect(URL::previous())->with(
        return redirect('/')->with(
            'success',
            'The artist, "' . $artist->name . '" was deleted successfully!'
        );
    }
}
