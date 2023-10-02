<x-client-layout.clientapp>
  <div class="container bg-dark">
    <div class="d-flex mt-5 mb-5 flex-column flex-md-row justify-content-center align-items-start justify-content-md-start w-100 text-white">
      <div class="book-img-container me-3">
          <img src="{{asset($author->image)}}" class="book-img img-fluid rounded" alt="Book Image">
      </div>
      <div class="book-information-container ms-3 mt-3 w-100">
          <div class="book-title h2 text-white mb-3 ">
            <i> {{$author->name}}</i>
          </div>
          <div class="mt-3">
            <h5>Author's Background</h5>
            <p class="mt-2">
              {{$author->background}}
            </p>
          </div>

        
      </div>
    </div>
  
      <div class="section2 mt-5 mb-5">
        <div class="section2-heading text-align-start mb-3">
          <h4 class="text-white">Author's Books</h4>
        </div>
        <div class="swiper mySwiper ms-3 me-3">
          <div class="swiper-wrapper">
            @foreach ($author->books as $book)
            <div class="swiper-slide"><a href="{{route('book.show',$book->id)}}" class="w-100 h-100">
                <div class="swiper-book-container" style="background-image: url('{{asset($book->image)}}')"></div>
            </a></div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div> 
      
      </div> 
    </div>
  </div>
</x-client-layout.clientapp>