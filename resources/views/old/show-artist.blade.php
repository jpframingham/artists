@extends('layouts.base')

@section('content')
  <div class="row">
    <div class="col-3">
      <h2>{{ $artist->name }}</h2>
      <img src="{{ url('/images/' . $artist->image) }}" alt="{{ $artist->name }}">
      <p>Styles: {{ $artist->styles }}</p>

    </div>
    <div class="col-7">
      <h3>Artworks by {{ $artist->name }}</h3>

    </div>
    <div class="col-2">
      <h3>Manage {{ $artist->name }}</h3>
      {!! Form::open(['action' => ['App\Http\Controllers\ArtistsController@destroy', $artist->id], 'method' => 'delete']) !!}
        <a href="{{ url('artists/' . $artist->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit"></span> Edit</a>
        {!! Form::button('<span class="fa fa-trash"></span> Delete', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
      {!! Form::close() !!}
    </div>
  </div>
@endsection
