{{-- 
To specify a parent template to base a child template on, use the extends() function with a string with the path to the parent template as a parameter.
--}}
@extends('layouts.base')

{{-- 
In the child template you can use sections with the same names as any of the yields from the parent.
Any content which is included inside of these sections will oeverwrite the yields in the parent template.
--}}
@section('navigation')
<nav>
    <ul>
        <li><a href="{{ url('/') }}">Artists</a></li>
        <li><a href="{{ url('/add') }}">Add Artist</a></li>
    </ul>
</nav>
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
    </div>
    @elseif( session('success') )
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    {{--
    <form action="{{ url('/' . $artist->id . '/update') }}" method="post">
    @method('PUT')
    @csrf

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $artist->name }}" id="name">

    <label for="image">Name:</label>
    <select name="image" id="image">
        @foreach ( $images as $name => $value )
            @if ($value == $artist->image)
                <option value="{{ $value }}" selected>{{ $name }}</option>
            @else
                <option value="{{ $value }}">{{ $name }}</option>
            @endif
        @endforeach
    </select>

    <label for="styles">Name:</label>
    <textarea name="styles" rows="3" id="styles">{{ $artist->styles }}</textarea>

    <button type="submit" class="btn">Edit Artist</button>
    </form>
    --}}

    {!! Form::model($artist, ['url' => '/' . $artist->id . '/update', 'method' => 'put', 'files' => true]) !!}

    {{-- 
    Laravel Collective automatically assumes that we want to include a CSRF token in our form so it is not necessary to explicitly include it.
    --}}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image', 'Upload Image:') !!}
        {!! Form::file('image', ['class' => 'btn btn-dark']) !!}
    </div>

        {{-- 
        Because we are accepting images using a file() upload input, it is necessary for us to pass the value of the old existing image back to the controller using a hidden() field. Laravel Collective can not set this for us automatically because file() inputs ignore set value attributes.
        --}}

        {!! Form::hidden('old_image', $artist->image) !!}

    <div class="form-group">
        {!! Form::label('styles', 'Styles:') !!}
        {!! Form::textarea('styles', null, ['class' => 'form-control', 'rows' => 5]) !!}
    </div>

    <div class="form-group">    
        {!! Form::button('Edit Artist', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
    </div>

    {!! Form::close() !!}

@endsection