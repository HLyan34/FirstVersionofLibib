<nav class="navbar d-flex align-items-center justify-content-between w-100 ps-5 pe-5 pt-3 pb-3">
        <div class="toggler" id="hamburgerMenu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="dropdown">
            <div class="dropdown-toggle user-btn text-white d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <p class="text-white"><i class="fa-solid fa-user"></i></p>
            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background-color: #1f2937;">
              <a class="dropdown-item text-white" href="{{route('profile.edit')}}"> <i class="fa fa-fw fa-user me-2"></i> Profile</a>
              <a class="dropdown-item text-white" href="{{route('home')}}"><i class="fa fa-fw fa-home me-2"></i> Homesite</a>
              <div class="dropdown-divider"></div>

              <form class="dropdown-item text-white logout-nav" id="logout" action="{{route('logout')}}" method="POST">
                  @csrf
                 <button><i class="fa fa-fw fa-power-off me-2"></i> Log Out</button>
                </form>
               

            </div>
          </div>
        

</nav>