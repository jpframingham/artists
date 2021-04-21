@extends('layouts.base')

@section('content')
    @foreach ($galleries as $gallery_num => $gallery)
    <div class="row pb-5">
        <div class="col-12">
            <h2 class="mb-3">{{ $gallery->title }}</h2>
        </div>
        @foreach ($gallery->artworks as $artwork)
            <div class="col-2">
                <img class="mb-3" src="{{ url('/images/' . $artwork->image) }}" alt="{{ $artwork->title }}">
                <h3 class="h5 font-weight-bold mb-4">{{ $artwork->title }} by {{ $artwork->artist['name'] }}</h3>
                <p><b>Artist Statement:</b></br>{{ $artwork->statement }}</p>
            </div>
        @endforeach
        <div class="col-12 pt-3">
            {!! Form::open(['action' => ['App\Http\Controllers\GalleryController@destroy', $gallery->id], 'method' => 'delete']) !!}
            <a href="{{ url('galleries/' . $gallery->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit" aria-hidden="true"></span> Edit Gallery</a>
            {!! Form::button('<span class="fa fa-trash"></span> Delete Gallery', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    @endforeach
@endsection
