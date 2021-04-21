@extends('layouts.base')

@section('content')
  {!! Form::open(['action' => 'App\Http\Controllers\GalleryController@store', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('title', 'Title:') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('artworks', 'Artworks:') !!}
      <select name="artworks" id="artworks" class="form-control">
        @foreach ($artworks as $artwork)
          <option value="{{ $artwork->id }}">{{ $artwork->name }}</option>
        @endforeach
      </select>
    </div>

    {!! Form::button('<span class="fa fa-plus"></span> Add Gallery', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
