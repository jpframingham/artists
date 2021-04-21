@extends('layouts.base')

@section('content')
  {!! Form::model($gallery, ['action' => ['App\Http\Controllers\GalleryController@update', $gallery->id], 'method' => 'put']) !!}
    <div class="form-group">
      {!! Form::label('title', 'Name:') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('artworks[]', 'Artworks:') !!}
      <select name="artworks[]" multiple>
        @foreach ($artworks as $artwork_num => $artwork)
          <option value="{{ $artwork->id }}"
            @foreach ($gallery->artworks as $gallery_artwork_num => $gallery_artwork)
              @if ($artwork->id == $gallery_artwork->id) selected @endif
            @endforeach
          >{{ $artwork->title }}</option>
        @endforeach
      </select>
    </div>

    {!! Form::button('<span class="fa fa-edit"></span> Edit Gallery', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
  {!! Form::close() !!}
@endsection
