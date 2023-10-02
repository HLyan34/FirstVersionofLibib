<x-client-layout.clientapp>
  <div class="container bg-dark text-white book-container">
    <div class="h3 mt-3 mb-3">Categories</div>
      
    @foreach ($allBooks as $categoryName => $booksInCategory)
    <h3 class="pt-4">{{ $categoryName }}</h3> <!-- Display the category name -->
    <div class="row flex-wrap mt-3 mb-3">
        @foreach ($booksInCategory as $book)
        <a href="{{route('book.show',$book->id)}}" class="text-decoration-none text-white col-md-4 mt-3 mb-2 d-inline">
          
              <img src="{{ asset($book->image) }}" class="m-2" alt="{{ $book->title }}" width="200" height="300">
                <h5 class="card-title p-0">{{ mb_strimwidth($book->books_title, 0, 25, "...") }}</h5>
                <p class="card-text">Author: {{ $book->author->name }}</p>
      </a>
     
        @endforeach
    </div>
    @endforeach
  </div>
</x-client-layout.clientapp>