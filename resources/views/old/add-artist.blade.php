@extends('layouts.base')

@section('content')
  {!! Form::open(['action' => 'App\Http\Controllers\ArtistsController@store', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('name', 'Name:') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}

      {!! Form::label('image', 'Upload Image:') !!}
      {!! Form::file('image', ['class' => 'btn btn-dark']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('styles', 'Styles:') !!}
      {!! Form::textarea('styles', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>

    {!! Form::button('<span class="fa fa-plus"></span> Add Artist', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
