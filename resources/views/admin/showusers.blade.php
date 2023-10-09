<x-app-layout>
  <x-slot name="slot">
    <div class="container mt-5 mb-5 border" style="background-color:#212529; ">
      <div class="card-header d-flex justify-content-between">
        <h2 class="card-title  card-title-custom pt-3 ps-2 text-white">Show Authors</h2>
        <a href="{{route('users.index')}}" class="btn btn-warning d-flex justify-content-center align-items-center" style="height:50px;"> <i class="fa-solid fa-arrow-left"></i> <span class="ms-2">Back</span></a>
      </div>
      <div class="card-body">
        
        <div class='row'>
          <div class="col-12 col-md-6">
            <p class="fw-bold text-white">ID</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$user->id}}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Username</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$user->name}}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Email</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$user->email}}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Use Role</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$user->user_role}}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Image</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <img src="{{asset($user->image)}}" alt="" width="300">
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6">
            <p  class="fw-bold text-white">Action</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <a href="{{route('users.edit',$user->id)}}" class="edit btn btn-success btn-sm mt-2 me-3"><i class="fa-solid fa-pen"></i> <span class="ms-2">Edit</span></a>
            <a href="javascript:void(0);" onclick="document.getElementById('delete-form-{{ $user->id }}').submit();" class="btn btn-danger btn-sm mt-2"><i class="fa-solid fa-trash"></i><span class="ms-2">Delete</span></a>
            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy',$user->id) }}" method="POST" style="display: none;" >
              @csrf
             @method('DELETE')
             </form>
          </div>
        </div>
       
    </div>
      </div>
     
       
  </x-slot>
</x-app-layout>
