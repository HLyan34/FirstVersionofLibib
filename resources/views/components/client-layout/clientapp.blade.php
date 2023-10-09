<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/12f3b80f60.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/client.css','resources/js/client.js'])
        @vite('resources/js/app.js')
    </head>
    <body class="font-sans antialiased bg-dark">
      <nav class="w-100 search-navbar dropdown-search-nav d-flex justify-content-center align-items-center">
        <form id="searchForm" class="d-flex justify-content-center align-items-center" style="width: 60%;">
          <input type="text" id="searchInput" class="form-control" placeholder="Search for books...">
      </form>
      </nav>
      <div class="searchingResults">
        <div id="searchResults">
        </div>
      </div>
      
      <nav class="navbar navbar-expand-lg navbar-light w-100">
        <div class="container">
        
          <a class="navbar-brand text-white d-flex justify-content-start align-iteems-center" href="{{route('home')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41a60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84a51.39 51.39 0 0 0-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5a.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg> <span class="ms-2 h4">Libib</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link text-white home_nav" aria-current="page" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white book_nav" href="{{route('book')}}">Books</a>
              </li>
              <li class="nav-item nav-item-cat-drop">
                <a class="nav-link text-white nav-link-categories category_nav" >Categories  <i class="fa-solid fa-caret-down"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white author_nav" href="{{route('author')}}">Authors</a>
              </li>
              <li class="nav-item search-icons d-flex justify-content-center align-items-center ms-2  mt-3 mt-sm-0">
                <a class="nav-link text-white search-icons  d-flex justify-content-center align-items-center" href="#">   
                  <i class="fa-solid fa-magnifying-glass text-dark "></i>
                </a>
              </li>
            </ul>
            <div class="d-flex mt-3 mt-sm-0">
              @if(auth()->check() && (auth()->user()->user_role == 'admin' || auth()->user()->user_role == 'author'))
              <a class="btn btn-primary me-3" href="{{route('dashboard') }}">Dashboard</a>
              <a class="btn btn-primary me-3" href="{{route('profile.edit') }}">Profile</a>
              <form method="POST" action="{{route('logout')}}">
                @csrf
                <button class="btn btn-danger text-white">Log Out</button>
            </form>
          @elseif(auth()->check() && auth()->user()->user_role == 'subscriber')
              <a class="btn btn-primary me-3" href="{{route('profile.edit')}}">Profile</a>

              <form method="POST" action="{{route('logout')}}">
                @csrf
                <button class="btn btn-danger text-white">Log Out</button>
            </form>

          @else
              <a class="btn btn-primary me-3" href="{{ route('login') }}">Log In</a>
              <a class="btn btn-outline-primary" href="{{ route('register') }}">Sign Up</a>
          @endif
          
          
          
            </div>
          
            
       
        </div>
        </div>
        <nav class="w-100 cat-navbar dropdown-cat-nav d-flex flex-wrap">
          <a class="nav-link text-white"  href="{{route('book.category')}}">All Categories</a>
          @foreach ($categories as $category)
            <a class="nav-link text-white second-nav-link {{$category->id}}_nav"  href="{{ route('book.categoryshow',$category->id) }}">{{$category->name}}</a>
          @endforeach
        </nav>
      </nav>


      <div class="nav-search-box w-100 justify-content-center align-items-center">
           <form id="searchForm2" class="d-flex justify-content-center align-items-center form-in-nav" style="width: 90%;">
            <input type="text" id="searchInput2" class="form-control ms-2 me-2" placeholder="Search for books...">
        </form>
        <div class="searchingResults">
          <div id="searchResults2">
          </div>
        </div>
      </div>
      
      {{$slot}}
      <div class="text-white" style="background-color: #343a40;">
        <div class="container py-4">
          <div class="row d-flex justify-content-center align-items-start">
            <div class="col-md-4 mt-md-0 mt-4 ms-4 ms-sm-0">
             
              @if(auth()->check())
              <div>
                <p class="h6">If there is somthing new, We will email you</p>
              </div>
              @else
              <h5>What let you wait</h5>
              <p>Fill your Email. We will get to you</p>
              <form action="{{route('sendemail')}}" id="subscriptionForm" method="POST">
                @csrf
                <div class="d-flex align-itmes-start flex-column ">
                  <input id="subscriberInput" type="email" name="subscriber_email" class="me-3 form-control" placeholder="Enter your email" style="width : 70%;">
                  <input type="submit" class="btn-primary btn-sm mt-2 " style="width : 100px;">
                </div>
                <div id="worng" class="p text-danger mt-2"></div>
                <div id="wronng" class="p text-success mt-2"></div>
              </form>
              @endif
        

            </div>
            <div class="col-md-4 mt-md-0 mt-4 ms-4 ms-sm-0">
              <h5>Pages</h5>
              <ul class="list-unstyled d-flex align-items-center justify-content-start mt-3">

                <ul class="d-flex flex-column align-items-start justify-content-start ps-0">
                  <li class="d-flex align-items-start justify-content-start"><a href="{{route('home')}}" class="text-decoration-none text-white">Home</a></li>
                  <li class="d-flex align-items-center justify-content-start mt-2"><a href="{{route('book')}}"
                    class="text-decoration-none text-white" >Books</a></li>
                  <li class="d-flex align-items-center justify-content-start mt-2"><a href="{{route('book.category')}}"
                    class="text-decoration-none text-white" >Categories</a></li>
                </ul>

                <ul class="d-flex flex-column align-items-start justify-content-start ms-3">
                  <li class="d-flex align-items-center justify-content-center"><a href="{{route('author')}}"
                    class="text-decoration-none text-white">Author</a></li>


                    @if(auth()->check() && (auth()->user()->user_role == 'admin' || auth()->user()->user_role == 'author'))
                    <li class="d-flex align-items-center justify-content-center mt-2"><a href="{{route('dashboard')}}"class="text-decoration-none text-white">Dashboard</a></li>
                    <li class="d-flex align-items-center justify-content-center mt-2"><a href="{{route('profile.edit')}}"class="text-decoration-none text-white">Profile</a></li>
                    @else
                    <li class="d-flex align-items-center justify-content-center mt-2"><a href="{{route('register')}}"class="text-decoration-none text-white">Sign Up</a></li>
                    <li class="d-flex align-items-center justify-content-center mt-2"><a href="{{route('login')}}"
                      class="text-decoration-none text-white">Log In</a></li>
                    @endif
                </ul>
      
      
              </ul>
            </div>
            <div class="col-md-4 mt-md-0 mt-4 ms-4 ms-sm-0">
              <h5>Contact Us</h5>
              <address>
                <p>Email: info@example.com</p>
                <p>Phone: +1 (123) 456-7890</p>
              </address>
              <!-- Social Media Links -->
              <div class="social-media">
                <a href="#" class="text-white"><i class="fab fa-facebook-square fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-twitter-square fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram-square fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
              </div>
            </div>
          </div>
      
          <!-- Copyright Notice -->
        </div>
      </div>
      <footer class="bg-dark text-white text-center py-3 mt-3 mb-5">
        © 2023 MyWebsite. All rights reserved.
    </footer>
    
      <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
        $('body').on('click', '.delete-modal-btn', function () {
  var url = $(this).data('url');
  $('#deleteForm').attr('action', url);
  $('#deleteModal').modal('show');
 
});

$('#subscriptionForm').on('submit', function(event) {
            event.preventDefault();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    $('#wronng').html(data.message)
                    setTimeout(function() {
                        $('#subscriberInput').val(''); 
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    var parse = JSON.parse(xhr.responseText);
                    $('#worng').html(parse.message)
                }
            });
        });



          $('#searchInput').on('input', function () {
              var query = $(this).val();
  
              if (query.length >= 2) {
                  $.ajax({
                      url: '{{ route('books.search') }}',
                      method: 'GET',
                      data: { query: query },
                      dataType: 'json', // Update the dataType to 'json'
                      success: function (data) {
                        
                          $('#searchResults').empty();
                          $.each(data.results, function (index, result) {
                          
                              var bookLink = $('<a>')
                                  .attr('href', result.url) 
                                  .text(result.title)
                                  .addClass('custom-search-class p-3 text-decoration-none text-white')
                              $('#searchResults').append(bookLink);
                          });
                      }
                  });
              } else {
                  $('#searchResults').empty();
              }
          });

          $('#searchInput2').on('input', function () {
              var query = $(this).val();
  
              if (query.length >= 2) {
                  $.ajax({
                      url: '{{ route('books.search') }}',
                      method: 'GET',
                      data: { query: query },
                      dataType: 'json', // Update the dataType to 'json'
                      success: function (data) {
                        
                          $('#searchResults2').empty();
                          $.each(data.results, function (index, result) {
                          
                              var bookLink = $('<a>')
                                  .attr('href', result.url) 
                                  .text(result.title)
                                  .addClass('custom-search-class p-3 text-decoration-none text-white')
                              $('#searchResults2').append(bookLink);
                          });
                      }
                  });
              } else {
                  $('#searchResults2').empty();
              }
          });
      });
  </script>
  
    </body>
</html>