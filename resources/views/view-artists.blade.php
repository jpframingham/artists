@extends('layouts.base')

@if ($errors->any())
    <div class="alert alert-danger">
        {{--
        All loops can be used in Blade template using a slightly different syntax. 
            --}}
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
    </div>
    @elseif( session('success') )
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('content')
  <div class="row">
    @foreach ($artists as $artist_num => $artist)
      <div class="col-3">
        <h2>{{ $artist->name }}</h2>
        <img src="{{ url('/images/' . $artist->image) }}" alt="{{ $artist->name }}">
        <p>Styles: {{ $artist->styles }}</p>


        {!! Form::open(['action' => ['App\Http\Controllers\ArtistsController@destroy', $artist->id], 'method' => 'delete']) !!}
          <a href="{{ url('artists/' . $artist->id) }}" class="btn btn-dark"><span class="fa fa-eye"></span> Details</a>
          <a href="{{ url('artists/' . $artist->id . '/edit') }}" class="btn btn-dark"><span class="fa fa-edit"></span> Edit</a>
          {!! Form::button('<span class="fa fa-trash"></span> Delete', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
        {!! Form::close() !!}
      </div>
    @endforeach
  </div>
@endsection
