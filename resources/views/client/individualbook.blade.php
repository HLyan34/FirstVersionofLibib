<x-client-layout.clientapp>
  <div class="container bg-dark">
    <div class="d-flex mt-5 mb-5 flex-column flex-md-row justify-content-center align-items-start justify-content-md-start w-100 text-white">
      <div class="book-img-container me-3 ms-3">
          <img src="{{asset($book->image)}}" class="book-img img-fluid rounded" alt="Book Image">
      </div>
      <div class="book-information-container ms-3 mt-3 w-100">
          <div class="book-title h4 text-white mb-3">
             {{$book->books_title}}
          </div>
          <div class="text-white overflow-hidden">
            {{$book->books_description}}
          </div>
          <div class="mt-3">
            <h4>Book Categories</h4>
            <p class="mt-2">
              @foreach ($categories as $category)
              <a href="{{ route('book.categoryshow',$category->id) }}" class="text-decoration-none text-warning">
                {{$category->name}} ,
              </a>
              @endforeach
            </p>
          </div>
          <div class="mt-5 d-flex justify-content-sm-between flex-column flex-sm-row align-items-start">
            <h5>By <a href="{{route('author.show',$author->id)}}" class="text-success text-decoration-none">{{$book->author->name}}</span></a></h5>
            <a href="{{route('book.download',$book->id)}}" class="btn btn-success mt-3"><i class="fa-solid fa-download"></i> <span class="ms-2">Download</span></a>
          </div>

        
      </div>
    </div>
  
      <div class="section2 mt-5 mb-5">
        <div class="section2-heading text-align-start mb-3">
          <h4 class="text-white">Recomendation</h4>
        </div>
        <div class="swiper mySwiper ms-3 me-3">
          <div class="swiper-wrapper">
            @foreach ($combinedBooks as $book) 
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