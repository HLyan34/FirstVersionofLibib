<x-app-layout>
  <x-slot name="slot">
    <div class="container mt-5 mb-5 border" style="background-color:#212529; ">
      <div class="card-header d-flex justify-content-between">
        <h2 class="card-title  card-title-custom pt-3 ps-2 text-white">Show Categories</h2>
        <a href="{{route('categories.index')}}" class="btn btn-warning d-flex justify-content-center align-items-center" style="height:50px;">Back</a>
      </div>
      <div class="card-body">
        
        <div class='row'>
          <div class="col-12 col-md-6">
            <p class="fw-bold text-white">ID</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$category->id}}</p>
          </div>
          <hr  class='mt-3 mb-3 bg-white'>
        </div>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Category</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$category->name}}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6">
            <p  class="fw-bold text-white">Action</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <a href="{{route('categories.edit',$category->id)}}" class="edit btn btn-success btn-sm mt-2 me-3">Edit</a>
            <a href="{{route('categories.destroy',$category->id)}}" class="delete btn btn-danger btn-sm mt-2">Delete</a>
          </div>
        </div>
       
    </div>
      </div>
    
       
  </x-slot>
</x-app-layout>
