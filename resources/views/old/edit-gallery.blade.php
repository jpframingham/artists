@extends('layouts.base')

@section('content')
  {!! Form::model($gallery, ['action' => ['App\Http\Controllers\ArtistsController@update', $gallery->id], 'method' => 'put', 'files' => true]) !!}
    <div class="form-group">
      {!! Form::label('title', 'Name:') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::button('<span class="fa fa-edit"></span> Edit Artist', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
