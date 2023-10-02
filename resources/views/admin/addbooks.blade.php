<x-app-layout>
  <x-slot name="slot">
      <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card w-100" style="background-color: #1f2937; ">
          <div class="card-header d-flex justify-content-sm-between flex-column flex-sm-row justify-content-start align-items-sm-center align-items-start">
            <h2 class="card-title card-title-custom text-white  pt-3 ps-2 ">Add Books</h2>
            <a class="btn btn-warning mt-2 me-5" href="{{route('books.index')}}">View</a>
          </div>
          <div class="card-body">
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger me-sm-5 mt-2">{{$error}}</div>
            @endforeach
            @endif
            <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group me-sm-5  ps-2">
                <label for="booktitle" class="pb-2 text-white card-custom-body-text mt-3 mb-3">Books Title</label>
                <input type="text" class="form-control" id="booktitle" name="bookTitle" placeholder="Book Title">
              </div>
              <div class="form-group mt-3 me-sm-5  ps-2">
                <label for="authorname" class="pb-2 text-white card-custom-body-text mt-3 mb-3">Author Name</label>
                
                @if(auth()->user()->user_role == 'admin')
                    <select name="author_id" id="" class="form-control">
                        @foreach ($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}}</option>
                        @endforeach  
                    </select>
                @elseif(auth()->user()->user_role == 'author')
                    <input type="hidden" name="author_name" value="{{ auth()->user()->name }}">
                    <p class="text-white">{{auth()->user()->name}}</p>
                @endif
            </div>

              <div class="form-group mt-3 me-sm-5  ps-2">
                <label for="bookCategory" class="pb-2 text-white card-custom-body-text mt-3 mb-3">Book Categories</label>
                <div class="form-group-checkbox mt-2 mb-2 form-group-select">
                @foreach ($categories as $category)
                <div class="form-check ">
                  <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="CheckBox{{$category->id}}" name="categories[]">
                  <label class="form-check-label text-white " for="CheckBox{{$category->id}}">
                   {{$category->name}}
                  </label>
                </div>
                @endforeach
              </div>
              </div>

              <div class="form-group mt-3 me-sm-5  ps-2">
                <label for="bookdescription"  class="pb-2 text-white card-custom-body-text mt-3 mb-3">Books Description</label>
                <textarea name="bookDescription" id="bookdescription" class="form-control" cols="25" rows="8"></textarea>
              </div>

              <div class="form-group mt-3 d-flex flex-column flex-sm-row align-items-sm-center  ps-2">
                <label for="bookImage" class="me-3 text-white card-custom-body-text mt-3 mb-3">Books Image</label>
                <input type="file" class="form-control-file" id="bookImage" name="bookImage">
              </div>

              <div class="form-group mt-3 d-flex flex-column flex-sm-row align-items-sm-center  ps-2">
                <label for="bookFile" class="me-3 text-white card-custom-body-text mt-3 mb-3">Books Files</label>
                <input type="file" class="form-control-file" id="bookFile" name="bookFile">
              </div>
            

              <button type="submit" class="btn btn-primary mt-4 mt-sm-3 text-white card-custom-body-text  ms-2 mb-3">Submit</button>
            </form>
          </div>
        </div>
       
      </div>
  </x-slot>
</x-app-layout>
