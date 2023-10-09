<x-app-layout>
  <x-slot name="slot">
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content  bg-dark">
          <div class="modal-header">
            <h5 class="modal-title text-white" id="exampleModalLabel">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body  text-white">
            Are you sure you want to delete this item permently?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary  text-white" data-bs-dismiss="modal">Cancel</button>
            <form method="POST" action="#" id="deleteForm">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger  text-white">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5 mb-5 border" style="background-color:#212529; ">
      <div class="card-header d-flex justify-content-between">
        <h2 class="card-title  card-title-custom pt-3 ps-2 text-white">Show Books</h2>
        <a href="{{route('books.trashed')}}" class="btn btn-warning d-flex justify-content-center align-items-center" style="height:50px;"> <i class="fa-solid fa-arrow-left"></i> <span class="ms-2">Back</span></a>
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
            <p class="text-white">{{ $book->author->name}}</p>
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
              @foreach ($book->categories as $category) 
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
            <a href="{{route('books.restore',$book->id)}}" class="edit btn btn-warning btn-sm mt-2 me-3">Restore</a>
            <a href="javascript:void(0);" data-url="{{route('books.forceDelete', $book->id)}}" class="btn btn-danger btn-sm mt-2 delete-modal-btn me-3"><i class="fa-solid fa-trash"></i><span class="ms-2">Delete</span></a>
          </div>
        </div>
       
    </div>
      </div>
      @section('scripts')
      <script>
           $('body').on('click', '.delete-modal-btn', function () {
        var url = $(this).data('url');
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
       
    });
          
      </script>
  @endsection
       
  </x-slot>
</x-app-layout>
