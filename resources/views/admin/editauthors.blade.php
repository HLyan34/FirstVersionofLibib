<x-app-layout>
  <x-slot name="slot">
      <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card w-100" style="background-color: #1f2937; ">
          <div class="card-header d-flex justify-content-sm-between flex-column flex-sm-row justify-content-start align-items-sm-center align-items-start">
            <h2 class="card-title card-title-custom text-white  pt-3 ps-2 ">Edit Authors</h2>
            <a class="btn btn-warning mt-2 me-5 d-flex justify-content-center align-items-center" href="{{route('authors.index')}}"> <i class="fa-solid fa-arrow-left"></i> <span class="ms-2">Back</span></a>
          </div>
          <div class="card-body">
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger me-sm-5 mt-2">{{$error}}</div>
            @endforeach
            @endif
            <form action="{{route('authors.update', $author->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group me-sm-5 mt-2 ps-2">
                <label for="authorName" class="pb-2 text-white card-custom-body-text mt-3 mb-3">Author Name</label>
                <input name='authorName' type="text" class="form-control custom-form-control" id="authorName" placeholder="Author Name" value="{{$author->name}}">
              </div>
              <div class="form-group mt-3 me-sm-5  ps-2">
                <label for="authorDescription"  class="pb-2 text-white card-custom-body-text mt-3 mb-3">Author's Background</label>
                <textarea name="authorDescription" id="authorDescription" class="form-control custom-form-control" cols="25" rows="8">
                  {{$author->background}}
                </textarea>
              </div>
              <div class="form-group me-sm-5 mt-3 ps-2"> 
                <img src="{{asset($author->image)}}" alt="" style="width:250px;">
             </div> 
              <div class="form-group me-sm-5 mt-2 d-flex flex-column flex-sm-row align-items-sm-center ps-2">
                <label for="authorImage" class="me-3 text-white card-custom-body-text mt-3 mb-3">Authors Image</label>
                <input type="file" class="form-control-file" id="authorImage" name="authorImage">
              </div>
              <button type="submit" class="btn btn-primary mt-4 card-custom-body-text ms-2 mb-3">Submit</button>
            </form>
          </div>
        </div>
       
      </div>
  </x-slot>
</x-app-layout>
