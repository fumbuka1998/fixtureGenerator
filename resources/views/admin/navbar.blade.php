 <!-- top navigation bar Fixture<span class="text-primary">Generator</span>-->
 <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebar"
        aria-controls="offcanvasExample"
      >
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a
        class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
        href="#"
        >Fixture<span class="text-primary">Generator</span></a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#topNavBar"
        aria-controls="topNavBar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <form class="d-flex ms-auto my-3 my-lg-0">
          <div class="input-group">
            <input
              class="form-control"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle ms-2"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i>  {{ Auth::user()?->name  }}</a></li>
              
              <li >
                  
                  <div class="dropdown-item" >
                      {{-- <a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left"></i>  logout</a> --}}
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i> {{ __('logout') }}
                         
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>
              
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- top navigation bar -->