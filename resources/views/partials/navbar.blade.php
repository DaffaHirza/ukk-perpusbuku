<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="">Perpustakaan Manhwa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        {{-- <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link {{ ( $title === 'Gallery') ? 'active' : '' }}" href="/gallery">Gallery</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ ( $title === 'Add Book') ? 'active' : '' }}" href="{{ route('contacts.create')}}">Contact Us</a>
            </li>
        </ul> --}}
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route ('login')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route ('register')}}">Register</a>
            </li>
        </ul>
        </div>
    </div>
</nav>