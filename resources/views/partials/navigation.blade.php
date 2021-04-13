<nav>
    <ul>
        <li><a href="{{ url('/') }}" class="{{ Request::path() == '/' ? 'current' : '' }}">Artists</a></li>
        <li><a href="{{ url('/add') }}" class="{{ Request::path() == 'add' ? 'current' : '' }}">Add Artist</a></li>
    </ul>
</nav>