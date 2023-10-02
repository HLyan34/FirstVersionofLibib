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
        <h2 class="card-title  card-title-custom pt-3 ps-2 text-white">Show Trashed Authors</h2>
        <a href="{{route('authors.trashed')}}" class="btn btn-warning d-flex justify-content-center align-items-center" style="height:50px;">Back</a>
      </div>
      <div class="card-body">
        
        <div class='row'>
          <div class="col-12 col-md-6">
            <p class="fw-bold text-white">ID</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$author->id}}</p>
          </div>
          <hr  class='mt-3 mb-3 bg-white'>
        </div>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Category</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <p class="text-white">{{$author->name}}</p>
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6 ">
            <p  class="fw-bold text-white">Image</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <img src="{{asset($author->image)}}" alt="" width="300">
          </div>
        </div>
        <hr  class='mt-3 mb-3 bg-white'>
        <div class='row'>
          <div class="col-12 col-md-6">
            <p  class="fw-bold text-white">Action</p>
          </div>
          <div class="col-12 col-md-6 mt-3 mt-md-0">
            <a href="{{route('authors.restore',$author->id)}}" class="edit btn btn-warning btn-sm mt-2 me-3">Restore</a>
            <a href="javascript:void(0);" data-url="{{route('authors.forceDelete', $author->id)}}" class="btn btn-danger btn-sm mt-2 delete-modal-btn me-3">Delete</a>
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
