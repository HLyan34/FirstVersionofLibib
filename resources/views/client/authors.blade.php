<x-client-layout.clientapp>
  <div class="container bg-dark text-white book-container">
    <div class="h3 mt-3 mb-3">Books</div>
    <div class="d-flex flex-wrap justify-content-center  align-items-center mt-3 mb-5">
      @foreach ($authors as $author )
      <a class="d-flex flex-column m-4 text-decoration-none text-white" href="{{route('author.show',$author->id)}}">
        <div class="book" style="background-image: url('{{asset($author->image)}}')">

        </div>
        <div class="book-title text-center mt-2">
          {{ $author->name, 0, 25 }}
      </div>
      
      </a>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $authors->links() }} 
  </div>
    </div>
  </x-client-layout.clientapp>