<x-client-layout.clientapp>
    <button onclick="scrollToTop()" id="scrollTopButton" class="justify-content-center align-items-center" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m13.854 7l-5-5h-.707l-5 5l.707.707L8 3.561V14h1V3.56l4.146 4.147l.708-.707z" clip-rule="evenodd"/></svg></button>
  <div class="container bg-dark text-white book-container">
    <div class="h2 mt-3 mb-4">Categories</div>
      
      @foreach ($allBooks as $categoryName => $booksInCategory)
      <section class="mt-5 mb-3" id="{{ $categoryName }}">
          <h5 class="ms-2">{{ $categoryName }}</h5> <!-- Moved the <h5> inside the section -->
          <div class="d-flex flex-wrap justify-content-center justify-content-sm-start align-items-center mt-3 mb-3">
              <div class="swiper mySwiper me-3">
                  <div class="swiper-wrapper">
                      @foreach ($booksInCategory as $book)
                          <div class="swiper-slide">
                              <a href="{{ route('book.show',$book->id ) }}" class="w-100 h-100">
                                  <div class="swiper-book-container" style="background-image: url('{{ asset($book->image) }}')"></div>
                              </a>
                          </div>
                      @endforeach
                  </div>
                  <div class="swiper-pagination"></div>
              </div>
          </div>
      </section>
  @endforeach
  </div>
</x-client-layout.clientapp>