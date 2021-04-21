<!-- <nav>
    <ul>
        <li><a href="{{ url('/') }}" class="{{ Request::path() == '/' ? 'current' : '' }}">Artists</a></li>
        <li><a href="{{ url('/add') }}" class="{{ Request::path() == 'add' ? 'current' : '' }}">Add Artist</a></li>
    </ul>
</nav> -->

<nav>
    <ul>
        <li><a href="{{ url('/') }}" @if(Request::path() == '/') class="current" @endif><span class="fa fa-palette"></span> Artists</a></li>
        <li><a href="{{ url('/artists/create') }}" @if(Request::path() == 'artists/create') class="current" @endif><span class="fa fa-plus"></span> Add Artist</a></li>
        <li><a href="{{ url('/artworks') }}" @if(Request::path() == 'artworks') class="current" @endif><span class="fa fa-image"></span> Artworks</a></li>
        <li><a href="{{ url('/artworks/create') }}" @if(Request::path() == 'artworks/create') class="current" @endif><span class="fa fa-plus"></span> Add Artwork</a></li>
        <li><a href="{{ url('/galleries') }}" @if(Request::path() == 'galleries') class="current" @endif><span class="fa fa-images"></span> Galleries</a></li>
        <li><a href="{{ url('/galleries/create') }}" @if(Request::path() == 'galleries/create') class="current" @endif><span class="fa fa-plus"></span> Add Gallery</a></li>
    </ul>
</nav>