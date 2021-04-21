@extends('layouts.base')

@section('content')
  <div class="row">
    @foreach ($artworks as $artwork)
      <div class="col-3">
        <h2>{{ $artwork->title }}</h2>
        <h3>By {{ $artwork->artist['name'] }}</h3>
        <img src="{{ url('/images/' . $artwork->image) }}" alt="{{ $artwork->name }}">
        <p>{{ $artwork->statement }}</p>

        {!! Form::open(['action' => ['App\Http\Controllers\ArtworkController@destroy', $artwork->id], 'method' => 'delete']) !!}
          <a href="{{ url('artworks/' . $artwork->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit" aria-hidden="true"></span> Edit</a>
          {!! Form::button('<span class="fa fa-trash"></span> Delete', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
        {!! Form::close() !!}
      </div>
    @endforeach
  </div>
@endsection
