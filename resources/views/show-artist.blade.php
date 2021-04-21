@extends('layouts.base')

@section('content')
  <div class="row">
    <div class="col-12">
    <h2 class="mb-3">About {{ $artist->name }}</h2>
    </div>
    <div class="col-3">
      <img class="mb-4" src="{{ url('/images/' . $artist->image) }}" alt="{{ $artist->name }}">
      <h3 class="h4">Styles</h3>
      <p>{{ $artist->styles }}</p>
      @if ($artist->bio)
      <h3 class="h4">{{ $artist->bio->title }}</h3>
        <p>{{ $artist->bio->text }}</p>
        <a href="{{ url('/bios/' . $artist->bio->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit"></span> Edit Bio</a>
      @else
        <a href="{{ url('/bios/create') }}" class="btn btn-dark"><span class="fa fa-plus"></span> Add Bio</a>
      @endif
    </div>
    <div class="col-6">
      <div class="row">
      @foreach ($artist->artworks as $artwork)
        <div class="col-4">
          <img class="mb-2" src="{{ url('/images/' . $artwork->image) }}" alt="{{ $artwork->title }}">
          <h3 class="h6">{{ $artwork->title }}</h3>
        </div>
      @endforeach
      </div>
    </div>
    <div class="col-3 bg-manage">
      <h3 class="h4 mt-0">Manage {{ $artist->name }}</h3>
      {!! Form::open(['action' => ['App\Http\Controllers\ArtistsController@destroy', $artist->id], 'method' => 'delete']) !!}
        <a href="{{ url('artists/' . $artist->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit"></span> Edit Artist</a>
        {!! Form::button('<span class="fa fa-trash"></span> Delete Artist', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
      {!! Form::close() !!}
    </div>
  </div>
@endsection
