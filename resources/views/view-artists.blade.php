@extends('layouts.base')

@section('navigation')
<nav>
    <ul>
        <li><a href="{{ url('/') }}" class="current">Artists</a></li>
        <li><a href="{{ url('/add') }}">Add Artist</a></li>
    </ul>
</nav>
@endsection

@section('content')
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

<div class="row">
    @foreach ($artists as $artist_num => $artist)
        <div class="col-3">
            <h2>{{ $artist->name }}</h2>
            <img src="{{ url('/images/' . $artist->image) }}" alt="{{ $artist->name }}">
            <p>Styles: {{ $artist->styles }}</p>

            {{--
            Because HTML forms do not natively accept PUT or DELETE HTTP methods it is neccessary to use Laravel's method() function in edit and delete forms to "spoof" them. 
                --}}

            {{--
            <form action="{{ url('/' . $artist->id . '/destroy') }}" method="post">
                @method('DELETE')
                @csrf
                <a href="{{ url('/' . $artist->id . '/edit') }}" class="btn btn-dark">Edit</a>
                <button type="submit" class="btn btn-dark">Delete</button>
            </form>
            --}}

            {!! Form::open(['url' => '/' . $artist->id . '/destroy', 'method' => 'delete']) !!}
                <a href="{{ url('/' . $artist->id . '/edit') }}" class="btn btn-dark">Edit</a>
                {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-dark']) !!}
            {!! Form::close() !!}
        </div>
    @endforeach
</div>
@endsection