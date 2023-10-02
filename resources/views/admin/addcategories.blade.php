<x-app-layout>
  <x-slot name="slot">
      <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card w-100" style="background-color: #1f2937; ">
          <div class="card-header d-flex justify-content-sm-between flex-column flex-sm-row justify-content-start align-items-sm-center align-items-start">
            <h2 class="card-title card-title-custom text-white  pt-3 ps-2 ">Add Categories</h2>
            @if(auth()->user()->user_role == 'admin')
            <a class="btn btn-warning mt-2 me-5" href="{{ route('categories.index') }}">View</a>
            @endif
            @if(auth()->user()->user_role == 'author')
            <a class="btn btn-warning mt-2 me-5" href="{{ route('books.index') }}">View</a>
            @endif
    
          </div>
          <div class="card-body">
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger me-sm-5 mt-2">{{$error}}</div>
            @endforeach
            @endif
            <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group me-sm-5 mt-2 ps-2">
                <label for="categoryName" class="pb-2 text-white card-custom-body-text mt-3 mb-3">Category Name</label>
                <input name='category' type="text" class="form-control" id="categoryName" placeholder="Category Name">
              </div>
              <button type="submit" class="btn btn-primary mt-4 card-custom-body-text ms-2 mb-3">Submit</button>
            </form>
          </div>
        </div>
       
      </div>
  </x-slot>
</x-app-layout>
