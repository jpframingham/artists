@extends('layouts.base')

@section('content')
  {!! Form::open(['action' => 'App\Http\Controllers\BioController@store']) !!}
    <div class="form-group">
      {!! Form::label('title', 'Title:') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('text', 'Bio Text:') !!}
      {!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>


    {!! Form::button('<span class="fa fa-plus"></span> Add Bio', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
