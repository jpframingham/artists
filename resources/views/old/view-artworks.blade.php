@extends('layouts.base')

@section('content')
  <div class="row">
    @foreach ($artworks as $artwork_num => $artwork)
      <div class="col-3">

        {!! Form::open(['action' => ['App\Http\Controllers\ArtworkController@destroy', $artwork->id], 'method' => 'delete']) !!}
          <a href="{{ url('artworks/' . $artwork->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit" aria-hidden="true"></span> Edit</a>
          {!! Form::button('<span class="fa fa-trash"></span> Delete', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
        {!! Form::close() !!}
      </div>
    @endforeach
  </div>
@endsection
