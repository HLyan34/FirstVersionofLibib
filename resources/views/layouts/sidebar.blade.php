<div class="sidebar hiding"> 
  <div class="d-flex w-100 flex-column ">
  <div class="sidebar-heading-container d-flex justify-content-between justify-content-md-start align-items-center w-100 mb-1 mt-3">
      <div class="ms-3 mt-2">
        <a href="{{route('home')}}" class="text-white text-decoration-none d-flex justify-content-center align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41a60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84a51.39 51.39 0 0 0-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5a.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg> <span class="ms-2 h4 mb-0">Libib</span>
            </a>
      </div>
      <div class="cross-btn-container me-4">
          <span class="cross-part"></span>
          <span class="cross-part"></span>
      </div>
    </div>
    <hr class='w-100  mb-3 sidebar-line mt-3'>
<div class='sidebar-content d-flex flex-column w-100 justify-content-center align-items-center mt-3'>
  <div class="sidebar-img-container" style="background-image: url('{{asset(auth()->user()->image)}}')"></div>
  </div>      

    <h5 class="ps-3 pe-3 mt-3 mb-3 d-flex justify-content-center align-items-center text-white ">
      {{ auth()->user()->name }}
    </h5>

    <hr class='w-100  mb-4 sidebar-line mt-3'>
    <ul class="list-unstyled pb-4">
      @if(auth()->user()->user_role == 'admin') 
      <a href="{{route('dashboard')}}" class="text-decoration-none text-white sidebar-text">
        <li class="sidebar-link">
          <i class="fa-solid fa-tachometer-alt me-3"></i>Dashboard
        </li>
      </a>
      <a href="javascript:void(0);" class="text-decoration-none text-white sidebar-text sidebar-link-toggle" data-target=".user-sidebar-lists">
        <li class="sidebar-link">
            <i class="fa-solid fa-user me-3"></i>Users <i class="fa-solid fa-caret-down ms-3"></i>
        </li>
    </a>
    <ul class="user-sidebar-lists lists-unstyled">
      <a href="{{route('users.create')}}" class="text-decoration-none text-white sidebar-text d-block ms-2">
        <li class="sidebar-link">
          Add Users
        </li>
      </a>
      <a href='{{route('users.index')}}' class="text-decoration-none text-white sidebar-text d-block ms-2 view-user">
        <li class="sidebar-link">
          View Users
        </li>
      </a>
    </ul>
    
    <a href="javascript:void(0);" class="text-decoration-none text-white sidebar-text sidebar-link-toggle" data-target=".author-sidebar-lists">
        <li class="sidebar-link">
            <i class="fa-solid fa-pen me-3"></i>Authors <i class="fa-solid fa-caret-down ms-3"></i>
        </li>
    </a>
    <ul class="author-sidebar-lists lists-unstyled">
      <a href="{{route('authors.create')}}" class="text-decoration-none text-white sidebar-text d-block ms-2">
          <li class="sidebar-link">
            Add Authors
          </li>
        </a>
      <a href='{{route('authors.index')}}' class="text-decoration-none text-white sidebar-text d-block ms-2 view-user">
          <li class="sidebar-link">
            View Authors
          </li>
        </a>
      </ul>
      @endif
    <a href="javascript:void(0);" class="text-decoration-none text-white sidebar-text sidebar-link-toggle" data-target=".books-sidebar-lists">
        <li class="sidebar-link">
            <i class="fa-solid fa-book me-3"></i>Books <i class="fa-solid fa-caret-down ms-3"></i>
        </li>
    </a>
    <ul class="books-sidebar-lists lists-unstyled">
      <a href="{{route('books.create')}}" class="text-decoration-none text-white sidebar-text d-block ms-2">
          <li class="sidebar-link">
            Add Books
          </li>
        </a>
      <a href='{{route('books.index')}}' class="text-decoration-none text-white sidebar-text d-block ms-2 view-user">
          <li class="sidebar-link">
            View Books
          </li>
        </a>
      </ul>
    <a href="javascript:void(0);" class="text-decoration-none text-white sidebar-text sidebar-link-toggle" data-target=".categories-sidebar-lists">
        <li class="sidebar-link">
            <i class="fa-solid  fa-list me-3"></i>Categories <i class="fa-solid fa-caret-down ms-3"></i>
        </li>
    </a>
    <ul class="categories-sidebar-lists lists-unstyled">
      <a href="{{route('categories.create')}}" class="text-decoration-none text-white sidebar-text d-block ms-2">
          <li class="sidebar-link">
            Add Categories
          </li>
        </a>
        @if(auth()->user()->user_role == 'admin')
      <a href='{{route('categories.index')}}' class="text-decoration-none text-white sidebar-text d-block ms-2 view-user">
          <li class="sidebar-link">
            View Categories
          </li>
        </a>
        @endif
      </ul>
  
    </ul>
</div>
 
         
</div>