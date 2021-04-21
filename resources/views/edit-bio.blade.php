@extends('layouts.base')

@section('content')
  {!! Form::model($bio, ['action' => ['App\Http\Controllers\BioController@update', $bio->id], 'method' => 'put']) !!}
    <div class="form-group">
      {!! Form::label('title', 'Title:') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('text', 'Bio Text:') !!}
      {!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>
    <div class="form-group">
      {!! Form::label('artist_id', 'Artist:') !!}
      <select name="artist_id" class="form-control">
        @foreach ($artists as $artist_num => $artist)
          <option value="{{ $artist->id }}" @if ($artist->id == $bio->artist->id) selected @endif>{{ $artist->name }}</option>
        @endforeach
      </select>
    </div>

    {!! Form::button('<span class="fa fa-edit"></span> Edit Bio', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
