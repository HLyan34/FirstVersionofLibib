<x-app-layout>
  <x-slot name="slot">
      <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card w-100" style="background-color: #1f2937; ">
          <div class="card-header d-flex justify-content-sm-between flex-column flex-sm-row justify-content-start align-items-sm-center align-items-start">
            <h2 class="card-title card-title-custom text-white  pt-3 ps-2 ">Edit Categories</h2>
            <a class="btn btn-warning mt-2 me-5" href="{{route('categories.index')}}"><i class="fa-solid fa-arrow-left"></i> <span class="ms-2">Back</span></a>
          </div>
          <div class="card-body">
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger me-sm-5 mt-2">{{$error}}</div>
            @endforeach
            @endif
            <form action="{{route('categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group me-sm-5 mt-2 ps-2">
                <label for="categoryName" class="pb-2 text-white card-custom-body-text mt-3 mb-3">Category Name</label>
                <input name='category' type="text" class="form-control custom-form-control" id="categoryName" placeholder="Category Name" value="{{$category->name}}">
              </div>
              <button type="submit" class="btn btn-primary mt-4 card-custom-body-text ms-2 mb-3">Submit</button>
            </form>
          </div>
        </div>
       
      </div>
  </x-slot>
</x-app-layout>
