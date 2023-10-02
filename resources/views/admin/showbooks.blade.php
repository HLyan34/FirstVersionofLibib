<x-app-layout>
  <x-slot name="slot">
    <div class="container mt-5 mb-5 border" style="background-color:#212529; ">
      <div class="card-header d-flex justify-content-between">
        <h2 class="card-title  card-title-custom pt-3 ps-2 text-white">Show Books</h2>
        <a href="{{route('books.index')}}" class="btn btn-warning d-flex justify-content-center align-items-center" style="height:50px;">Back</a>
      </div>
      <div class="card-body">
        <div class='row'>
          <div class="col-12 col-md-6">
            <p class="fw-bold text-white">ID</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{ $book->id }}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Book Title</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{ $book->books_title }}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Author Name</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{ $author->name }}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Book Description</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{ $book->books_description }}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Book Categories</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">
              @foreach($categories as $category)
              {{ $category->name }} /
           @endforeach
            </p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Book Image</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <img src="{{asset($book->image)}}" alt="" width="300">
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Book Files</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            @php
            $parts = explode('_', $book->books_file);
            array_shift($parts);
            $filename = implode('_', $parts);
        @endphp
        
        <p class="text-white">{{ $filename }}</p>
        

          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6">
            <p  class="fw-bold text-white">Action</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <a href="{{route('books.edit',$book->id)}}" class="edit btn btn-success btn-sm mt-2 me-3">Edit</a>
            <a href="javascript:void(0);" onclick="document.getElementById('delete-form-{{ $book->id }}').submit();" class="btn btn-danger btn-sm mt-2">Delete</a>
         <form id="delete-form-{{ $book->id }}" action="{{ route('books.destroy',$book->id) }}" method="POST" style="display: none;" >
           @csrf
          @method('DELETE')
          </form>
          </div>
        </div>
       
    </div>
      </div>
     
       
  </x-slot>
</x-app-layout>
