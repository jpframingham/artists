<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Models\Artist; # UPDATE ME W12
use App\Models\Artwork;
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
        $artists = Artist::with('artworks')->get();

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
        return view('add-artist',
        [
            'title' => 'Add Artist'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistRequest $request)
    {

        // The store method will be used to actually save data from the database once it is collected.
        // It will validate the form using the validate() method of the request object.

        // $request->validate([
        //     'name' => 'required|max:255',
        //     'image' => 'required|max:255',
        //     'styles' => 'required'
        // ]);

        // Then we will create a new instance of the Artist class and then set each property of the artist object to be equal to the corresponding property of the request object which was collected from the form.
        $artist = new Artist;
        $artist->name = $request->name;
        
        /**
         * Since we using an image upload instead of a select field, we need to write some code to process the image upload.
         * 
         * First we need to check if the submitted form data includes an image file using the hasFile method.
         */
        if ($request->hasFile('image')) {
            
            // Then we can save the file as a variable using the file() method.
            $image = $request->file('image');

            /**
             * We can format the provided artist name to reate an image name by replacing spaces with underscores and changing capital letters to lowercase.
             */
            $image_name = strtolower(str_replace(' ', '_', $request->name));

            /**
             * It is common convention to include a timestamp in file names to prevent files with the same names from conflicting. We can do this using the time() function.
             */
            $image_time = time();

            /**
             * Then we can collect the original file extension of the uploaded image and add it to the end of our new file name.
             */
            $image_extension = '.' . $image->getClientOriginalExtension();
            $full_image_name = $image_name . '_' . $image_time . $image_extension;

            /**
             * We can save the image in a path with folders that correspond to today's date to further keep images organized.
             */
            $image_path = date('Y/m/d');

            /**
             * We need to define a destination path for the file to be moved to using the public_path() function.
             */
            $destination_path = public_path('/images/' . $image_path);

            // Then we need to move the file using the move() method.
            $image->move($destination_path, $full_image_name);

            /**
             * We need to set the $image property of the artist to equal the image path concatenated with the full name of the image.
             */
            $artist->image = $image_path . '/' . $full_image_name;
            
        }

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
        // The edit method is very similar to the create method excecpt that it takes in an ID from the route, selects artists from the database if their ID matches, then selects the first one.
        // The artist is then passed to the view so that its properties can be used in the form to display their currently existing data.
        // $artist = Artist::get('id', $id)->first();
        // $artist = Artist::where('id', $id)->first();

        // FINISHED W11 HERE

        // $images =
        // [
        // 'Leonardo da Vinci' => 'da-vinci.jpg',
        // 'Walt Disney' => 'disney.jpg',
        // 'Frida Kahlo' => 'kahlo.jpg',
        // 'Pablo Picasso' => 'picasso.jpg',
        // 'Bob Ross' => 'ross.jpg',
        // 'Charles M.Schulz' => 'schulz.jpg',
        // 'Bill Watterson' => 'watterson.jpg',
        // 'Vincent van Goch' => 'van-goch.jpg'
        // ];
        // return view('edit-artist',
        // [
        // 'artist' => $artist,
        // 'title' => 'Edit ' . $artist->name,
        // 'images' => $images
        // ]);

        $artist = Artist::with('artworks')->find($id);
        return view('edit-artist', [
            'artist' => $artist,
            'title' => 'Edit ' . $artist->name,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistRequest $request, $id)
    {
        // The update method is very similar to the store method except that it selects a specific artist and reassigns its properties instead of creating a new instance of the Artist class.

        // $request->validate(
        // [
        // 'name' => 'required|max:255',
        // 'image' => 'required|max:255',
        // 'styles' => 'required'
        // ]);

        // $artist = Artist::get('id', $id)->first();
        $artist = Artist::find($id);

        $artist->name = $request->name;
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $image_name = strtolower(str_replace(' ', '_', $request->name));

            $image_time = time();

            $image_extension = '.' . $image->getClientOriginalExtension();

            $full_image_name = $image_name . '_' . $image_time . $image_extension;

            $image_path = date('Y/m/d');

            $destination_path = public_path('/images/' . $image_path);

            $image->move($destination_path, $full_image_name);

            $artist->image = $image_path . '/' . $full_image_name;
            
        } else {

            $artist->image = $request->old_image;

        }

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
        $artist = Artist::find($id);
        $artist->delete();

        // return redirect(URL::previous())->with(
        return redirect(URL::previous())->with(
            'success',
            'The artist, "' . $artist->name . '" was deleted successfully!'
        );
    }
}
