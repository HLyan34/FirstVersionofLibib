<x-app-layout>
  <x-slot name="slot">
      <div class="container d-flex justify-content-center align-items-center mt-5 mb-5 ">
        <div class="card w-100" style="background-color: #1f2937; ">
          <div class="card-header d-flex justify-content-sm-between flex-column flex-sm-row justify-content-start align-items-sm-center align-items-start">
            <h2 class="card-title card-title-custom text-white  pt-3 ps-2 ">Add Users</h2>
            <a class="btn btn-warning mt-2 me-5" href="{{route('users.index')}}">View Users</a>
          </div>
          <div class="card-body">
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger me-sm-5 mt-2">{{$error}}</div>
            @endforeach
            @endif
            <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group me-sm-5 ps-2">
                <label for="username" class="pb-2 text-white card-custom-body-text mt-3 mb-3">Username</label>
                <input type="text" class="form-control custom-form-control" id="username" placeholder="UserName" name="username">
              </div>

              <div class="form-group mt-3 me-sm-5 ps-2">
                <label for="email"  class="pb-2 text-white card-custom-body-text mt-3 mb-3">Email address</label>
                <input type="email" class="form-control custom-form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>

              <div class="form-group mt-3 me-sm-5 ps-2">
                <label for="password"  class="pb-2 text-white card-custom-body-text mt-3 mb-3">Password</label>
                <input type="password" name="password" class="form-control custom-form-control" id="password" placeholder="Password" name="password">
              </div>

              <div class="form-group mt-3 d-flex flex-column flex-sm-row align-items-sm-center ps-2">
                <label for="userimage" class="me-3 text-white card-custom-body-text mt-3 mb-3">User Image</label>
                <input type="file" class="form-control-file" id="userimage" name="userImage">
              </div>
            

              <div class="form-group mt-3 me-sm-5 ps-2">
                <label for="userRole" class="pb-2 text-white card-custom-body-text mt-3 mb-3">User Role</label>
                <select name="userRole" id="userRole" class="form-control custom-form-control">
                  <option value="subscriber">Subscriber</option>
                  <option value="admin">Admin</option>
                  <option value="author">Author</option>
                </select>
              </div>
            
    
              <button type="submit" class="btn btn-primary mt-4 text-white card-custom-body-text ms-2">Submit</button>
            </form>
          </div>
        </div>
       
      </div>
  </x-slot>
</x-app-layout>
