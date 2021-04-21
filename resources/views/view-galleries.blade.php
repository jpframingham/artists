@extends('layouts.base')

@section('content')
  <div class="row">
    @foreach ($galleries as $gallery_num => $gallery)
      <div class="col-3">
        <h2>{{ $gallery->title }}</h2>

        @foreach ($gallery->artworks as $artwork)
          <img src="{{ url('/images/' . $artwork->image) }}" alt="{{ $artwork->title }}">
          <h3>{{ $artwork->title }}</h3>
          <h4>By {{ $artwork->artist['name'] }}</h4>
          <p>{{ $artwork->statement }}</p>
        @endforeach

        {!! Form::open(['action' => ['App\Http\Controllers\GalleryController@destroy', $gallery->id], 'method' => 'delete']) !!}
          <a href="{{ url('galleries/' . $gallery->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit" aria-hidden="true"></span> Edit</a>
          {!! Form::button('<span class="fa fa-trash"></span> Delete', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
        {!! Form::close() !!}
      </div>
    @endforeach
  </div>
@endsection
