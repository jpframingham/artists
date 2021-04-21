@extends('layouts.base')

@section('content')
  {!! Form::model($artwork, ['action' => ['App\Http\Controllers\ArtworkController@update', $artwork->id], 'method' => 'put', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('title', 'Title:') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}

      {!! Form::label('image', 'Upload Image:') !!}
      {!! Form::file('image', ['class' => 'btn btn-dark']) !!}

      {!! Form::hidden('old_image', $artwork->image) !!}
    </div>
    <div class="form-group">
      {!! Form::label('statement', 'Statement:') !!}
      {!! Form::textarea('statement', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>

    {!! Form::button('<span class="fa fa-edit"></span> Edit Artwork', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
