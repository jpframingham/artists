@extends('layouts.base')

@section('content')
  {!! Form::model($artist, ['action' => ['App\Http\Controllers\ArtistsController@update', $artist->id], 'method' => 'put', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('name', 'Name:') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}

      {!! Form::label('image', 'Upload Image:') !!}
      {!! Form::file('image', ['class' => 'btn btn-dark']) !!}

      {!! Form::hidden('old_image', $artist->image) !!}
    </div>
    <div class="form-group">
      {!! Form::label('styles', 'Styles:') !!}
      {!! Form::textarea('styles', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>

    {!! Form::button('<span class="fa fa-edit"></span> Edit Artist', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
