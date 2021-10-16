<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid mx-5">
    <a class="navbar-brand" href="{{ route('main/index') }}">ISP Provider</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link @yield('formHomeActive')" href="{{ route('main/index') }}">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @yield('formProviderActive')" href="{{ route('main/provider') }}">Buat Provider</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @yield('formDataActive')" href="{{ route('main/data-provider') }}">Isi Data Provider</a>
        </li>
      </ul>
    </div>
  </div>
</nav>