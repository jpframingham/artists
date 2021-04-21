<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        {{-- 
        We can echo variables which we have passed to our Blade templates using our Controller by simply wrapping them in double curly braces.
        --}}
        <title>{{ $title }}</title>
        <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
        {{--
        Because of Laravel's folder structure, it can not read regular relative links to static files such as CSS files, JS files or image files.
        In order to properly link to these files we use the asset() function, where the parameter is the path to the folder which contains the asset.
        --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <header>
            <h1>{{ $title }}</h1>
            {{-- 
            Blade provides a stucture called sections. Sections can be created in parent templates using the yield() function which is used as placeholders for content which could be different for every page and then referenced in child templates. Use a name for the section as the parameter of this function.
            --}}
            @include('partials.navigation')
        </header>

        <div class="content-wrapper">
            <div class="container">

                <div class="row">
                    <div class="col-12 mb-3">
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
                    </div>
                </div>

                @yield('content')
            </div>
        </div>

        {{-- 
        Blade automatically does HTML escaping using htmlentities() for us so it is not necessary for us to do escaping manually.
        If we don't want Blade to do HTML escaping then we need to use curly braces with two exclaimation points instead.
        --}}

        <footer>
            <p>You're on the <em>{{ $title }}</em> page</br>
            <small>Copyright &copy; {{ date('Y') }} Seneca College. All rights reserved.<small></p>
        </footer>
    </body>

</html>
