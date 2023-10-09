<x-client-layout.clientapp>

  <div class="container bg-dark">
    <div id="carouselExampleInterval" class="carousel slide mt-3" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <a href="{{route('book.show', ['id' => 24]);}}">
          <img src="{{asset('storage/static_images/beautiful.jpg')}}" class="d-block w-100 carousel-image " alt="...">
          </a>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <a href="{{route('book.show', ['id' => 23]);}}">
          <img src="{{asset('storage/static_images/change.jpg')}}" class="d-block w-100 carousel-image"  alt="...">
        </a>
        </div>
        <div class="carousel-item">
          <a href="{{route('book.show', ['id' => 25]);}}">
          <img src="{{asset('storage/static_images/escape.jpg')}}" class="d-block w-100 carousel-image" alt="...">
        </a>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div class="section2 mt-5 mb-5">
      <div class="section2-heading text-align-start mb-3">
        <h4 class="text-white">Feel Your Emotion</h4>
      </div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        @foreach ($book4s as $book)
        <div class="swiper-slide"><a href="{{route('book.show',$book->id)}}" class="w-100 h-100">
            <div class="swiper-book-container" style="background-image: url('{{asset($book->image)}}')"></div>
            {{-- <img src="{{asset($book->image)}}" alt="" class="swiper-image"> --}}
        </a></div>
        @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <div class="section2 mt-5 mb-5">
      <div class="section2-heading text-align-start mb-3">
        <h4 class="text-white">Be A Self-Made Millionare</h4>
      </div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        @foreach ($book2s as $book)
        <div class="swiper-slide"><a href="{{route('book.show',$book->id)}}" class="w-100 h-100">
            <div class="swiper-book-container" style="background-image: url('{{asset($book->image)}}')"></div>
            {{-- <img src="{{asset($book->image)}}" alt="" class="swiper-image"> --}}
        </a></div>
        @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
   
  
    <div class="section2 mt-5 mb-5">
      <div class="section2-heading text-align-start mb-3">
        <h4 class="text-white">Newly Added</h4>
      </div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          @foreach ($book3s as $book)
          <div class="swiper-slide"><a href="{{route('book.show',$book->id)}}" class="w-100 h-100">
              {{-- <div class="swiper-book-container" style="background-image: url('{{asset($book->image)}}')"></div> --}}
              <img src="{{asset($book->image)}}" alt="" class="swiper-image">
          </a></div>
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
    
    </div>
    </div>

  </div>
</x-client-layout.clientapp>