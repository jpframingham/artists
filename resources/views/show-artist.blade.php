@extends('layouts.base')

@section('content')
  <div class="row">
    <div class="col-3">
      <h2>{{ $artist->name }}</h2>
      <img src="{{ url('/images/' . $artist->image) }}" alt="{{ $artist->name }}">
      <p>Styles: {{ $artist->styles }}</p>
      @if ($artist->bio)
        <h3>{{ $artist->bio->title }}</h3>
        <p>{{ $artist->bio->text }}</p>
        <a href="{{ url('/bios/' . $artist->bio->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit"></span> Edit Bio</a>
      @else
        <a href="{{ url('/bios/create') }}" class="btn btn-dark"><span class="fa fa-plus"></span> Add Bio</a>
      @endif
    </div>
    <div class="col-7">
      <h3>Artworks by {{ $artist->name }}</h3>
      <div class="row">
      @foreach ($artist->artworks as $artwork)
        <div class="col-4">
          <img src="{{ url('/images/' . $artwork->image) }}" alt="{{ $artwork->title }}">
          <h3>{{ $artwork->title }}</h3>
          <p>{{ $artwork->statement }}</p>
        </div>
      @endforeach
      </div>
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
