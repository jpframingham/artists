@extends('layouts.base')

@section('content')
  {!! Form::open(['action' => 'App\Http\Controllers\ArtworkController@store', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('title', 'Artwork Title:') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}

      {!! Form::label('image', 'Upload Image:') !!}
      {!! Form::file('image', ['class' => 'btn btn-dark']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('artist_id', 'Artist:') !!}
      <select name="artist_id">
        @foreach ($artists as $artist_num => $artist)
          <option value="{{ $artist->id }}">{{ $artist->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      {!! Form::label('statement', 'Artist Statement:') !!}
      {!! Form::textarea('statement', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>

    {!! Form::button('<span class="fa fa-plus"></span> Add Artwork', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
