<x-client-layout.clientapp>
  <div class="container bg-dark text-white book-container">
    <div class="h3 mt-3 mb-3">Books</div>
    <div class="d-flex flex-wrap justify-content-center  align-items-center mt-3 mb-5">
      @foreach ($books as $book )
      <a class="d-flex flex-column m-4 text-decoration-none text-white books-books-books" href="{{route('book.show',$book->id)}}">
        <div class="book" style="background-image: url('{{asset($book->image)}}')">

        </div>
        <div class="book-title text-center mt-2">
          {{ mb_strimwidth($book->books_title, 0, 25, "...") }}
      </div>
      
      </a>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $books->links() }} 
  </div>
  </div>
</x-client-layout.clientapp>