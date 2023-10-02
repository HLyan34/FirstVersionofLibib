<x-app-layout>
    <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
        <div class="card w-100" style="background-color: #1f2937; ">
          <div class="card-header d-flex justify-content-sm-between flex-column flex-sm-row justify-content-start align-items-sm-center align-items-start">
            <h2 class="card-title card-title-custom text-white  pt-3 ps-2 ">Dashboard</h2>
        </div>
            <div class="card-body">


                <div class="d-flex flex-wrap justify-content-center align-items-center">
                    <div class="statics dash-1 ms-3 mt-2">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <p class="fw-bold h6 mb-2">Users</p>
                                <h4 class="text-primary">{{$numberOfUsers }}</h4>

                                <p class="mt-2 fw-light"><span class=" h6 {{$usersChange > 0 ? 'text-success' : 'text-danger'}}">{{ $usersChange > 0 ? "⬆️ " . abs($usersChange) . "%" : "⬇️ " . abs($usersChange) . "%" }}</span> Last Week</p>

                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16"><path fill="currentColor" d="M16 7.992C16 3.58 12.416 0 8 0S0 3.58 0 7.992c0 2.43 1.104 4.62 2.832 6.09c.016.016.032.016.032.032c.144.112.288.224.448.336c.08.048.144.111.224.175A7.98 7.98 0 0 0 8.016 16a7.98 7.98 0 0 0 4.48-1.375c.08-.048.144-.111.224-.16c.144-.111.304-.223.448-.335c.016-.016.032-.016.032-.032c1.696-1.487 2.8-3.676 2.8-6.106zm-8 7.001c-1.504 0-2.88-.48-4.016-1.279c.016-.128.048-.255.08-.383a4.17 4.17 0 0 1 .416-.991c.176-.304.384-.576.64-.816c.24-.24.528-.463.816-.639c.304-.176.624-.304.976-.4A4.15 4.15 0 0 1 8 10.342a4.185 4.185 0 0 1 2.928 1.166c.368.368.656.8.864 1.295c.112.288.192.592.24.911A7.03 7.03 0 0 1 8 14.993zm-2.448-7.4a2.49 2.49 0 0 1-.208-1.024c0-.351.064-.703.208-1.023c.144-.32.336-.607.576-.847c.24-.24.528-.431.848-.575c.32-.144.672-.208 1.024-.208c.368 0 .704.064 1.024.208c.32.144.608.336.848.575c.24.24.432.528.576.847c.144.32.208.672.208 1.023c0 .368-.064.704-.208 1.023a2.84 2.84 0 0 1-.576.848a2.84 2.84 0 0 1-.848.575a2.715 2.715 0 0 1-2.064 0a2.84 2.84 0 0 1-.848-.575a2.526 2.526 0 0 1-.56-.848zm7.424 5.306c0-.032-.016-.048-.016-.08a5.22 5.22 0 0 0-.688-1.406a4.883 4.883 0 0 0-1.088-1.135a5.207 5.207 0 0 0-1.04-.608a2.82 2.82 0 0 0 .464-.383a4.2 4.2 0 0 0 .624-.784a3.624 3.624 0 0 0 .528-1.934a3.71 3.71 0 0 0-.288-1.47a3.799 3.799 0 0 0-.816-1.199a3.845 3.845 0 0 0-1.2-.8a3.72 3.72 0 0 0-1.472-.287a3.72 3.72 0 0 0-1.472.288a3.631 3.631 0 0 0-1.2.815a3.84 3.84 0 0 0-.8 1.199a3.71 3.71 0 0 0-.288 1.47c0 .352.048.688.144 1.007c.096.336.224.64.4.927c.16.288.384.544.624.784c.144.144.304.271.48.383a5.12 5.12 0 0 0-1.04.624c-.416.32-.784.703-1.088 1.119a4.999 4.999 0 0 0-.688 1.406c-.016.032-.016.064-.016.08C1.776 11.636.992 9.91.992 7.992C.992 4.14 4.144.991 8 .991s7.008 3.149 7.008 7.001a6.96 6.96 0 0 1-2.032 4.907z"/></svg>
                              </div>
                        </div>
                    </div>
                    <div class="statics dash-1 ms-3 mt-2">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <p class="fw-bold h6 mb-2">Books</p>
                                <h4 class="text-primary">{{$numberOfBooks }}</h4>
                                <p class="mt-2 fw-light"><span class=" h6 {{$booksChange > 0 ? 'text-success' : 'text-danger'}}">{{ $booksChange > 0 ? "⬆️ " . abs($booksChange) . "%" : "⬇️ " . abs($booksChange) . "%" }}</span> Last Week </p>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g id="feBook0" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="feBook1" fill="currentColor" fill-rule="nonzero"><path id="feBook2" d="m13 16.006l7-.047V5.992l-5.17.007l-1.814 1.814L13 16.006Zm-2-8.193L9.179 6.038L4 6.003v9.956l7 .047V7.813Zm-1-3.77L12 6l2-2l5.997-.008A2 2 0 0 1 22 5.989v9.97a2 2 0 0 1-1.986 2L14 18l-1.996 2L10 18l-6.014-.041a2 2 0 0 1-1.986-2V6.003a2 2 0 0 1 2-2l6 .04Z"/></g></g></svg>
                              </div>
                        </div>
                    </div>
                    <div class="statics dash-1 ms-3 mt-2">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <p class="fw-bold h6 mb-2">Subscribers</p>
                                <h4 class="text-primary">{{$numberOfSubscribers }}</h4>
                                <p class="mt-2 fw-light"><span class=" h6 {{$subscribersChange > 0 ? 'text-success' : 'text-danger'}}">{{ $subscribersChange > 0 ? "⬆️ " . abs($subscribersChange) . "%" : "⬇️ " . abs($subscribersChange) . "%" }} </span> Last Week </p>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g id="feDistributeVertically0" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="feDistributeVertically1" fill="currentColor"><path id="feDistributeVertically2" d="M7 10h10a2 2 0 1 1 0 4H7a2 2 0 1 1 0-4Zm-4 7h18a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2ZM3 5h18a1 1 0 0 1 0 2H3a1 1 0 1 1 0-2Z"/></g></g></svg>
                              </div>
                        </div>
                    </div>
                    <div class="statics dash-1 ms-3 mt-2">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <p class="fw-bold h6 mb-2">Authors</p>
                                <h4 class="text-primary">{{$numberOfAuthors }}</h4>
                                <p class="mt-2 fw-light"><span class=" h6 {{$authorsChange > 0 ? 'text-success' : 'text-danger'}}">{{ $authorsChange > 0 ? "⬆️ " . abs($authorsChange) . "%" : "⬇️ " . abs($authorsChange) . "%" }} </span> Last Week </p>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g id="fePencil0" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g id="fePencil1" fill="currentColor"><path id="fePencil2" d="M3 18L15 6l3 3L6 21H3v-3ZM16 5l2-2l3 3l-2.001 2.001L16 5Z"/></g></g></svg>
                              </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex flex-wrap justify-content-center align-items-center mt-4 mb-4">
                    <div class="statics dash-1 ms-3 mt-2">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <p class="fw-bold h6 mb-2">Facebook</p>
                                <h4 class="text-primary">{{$numberOfUsers }} Followers</h4>

                                <p class="mt-2 fw-light"><span class=" h6 {{$usersChange > 0 ? 'text-success' : 'text-danger'}}">{{ $usersChange > 0 ? "⬆️ " . abs($usersChange) . "%" : "⬇️ " . abs($usersChange) . "%" }}</span> Last Week</p>

                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M20 3H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h8.615v-6.96h-2.338v-2.725h2.338v-2c0-2.325 1.42-3.592 3.5-3.592c.699-.002 1.399.034 2.095.107v2.42h-1.435c-1.128 0-1.348.538-1.348 1.325v1.735h2.697l-.35 2.725h-2.348V21H20a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z"/></svg>
                              </div>
                        </div>
                    </div>
                    <div class="statics dash-1 ms-3 mt-2">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <p class="fw-bold h6 mb-2">Instagram</p>
                                <h4 class="text-primary">{{$numberOfBooks }}  Followers</h4>
                                <p class="mt-2 fw-light"><span class=" h6 {{$booksChange > 0 ? 'text-success' : 'text-danger'}}">{{ $booksChange > 0 ? "⬆️ " . abs($booksChange) . "%" : "⬇️ " . abs($booksChange) . "%" }}</span> Last Week </p>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248a4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008a3.004 3.004 0 0 1 0 6.008z"/><circle cx="16.806" cy="7.207" r="1.078" fill="currentColor"/><path fill="currentColor" d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42a4.6 4.6 0 0 0-2.633 2.632a6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71c0 2.442 0 2.753.056 3.71c.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632a6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419a4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186c.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688a2.987 2.987 0 0 1-1.712 1.711a4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055c-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311a2.985 2.985 0 0 1-1.719-1.711a5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654c0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311a2.991 2.991 0 0 1 1.712 1.712a5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655c0 2.436 0 2.698-.043 3.654h-.011z"/></svg>
                              </div>
                        </div>
                    </div>
                    <div class="statics dash-1 ms-3 mt-2">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <p class="fw-bold h6 mb-2">Twitter</p>
                                <h4 class="text-primary">{{$numberOfSubscribers }} Followers</h4>
                                <p class="mt-2 fw-light"><span class=" h6 {{$subscribersChange > 0 ? 'text-success' : 'text-danger'}}">{{ $subscribersChange > 0 ? "⬆️ " . abs($subscribersChange) . "%" : "⬇️ " . abs($subscribersChange) . "%" }} </span> Last Week </p>
                              </div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19.633 7.997c.013.175.013.349.013.523c0 5.325-4.053 11.461-11.46 11.461c-2.282 0-4.402-.661-6.186-1.809c.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721a4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062c.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973a4.02 4.02 0 0 1-1.771 2.22a8.073 8.073 0 0 0 2.319-.624a8.645 8.645 0 0 1-2.019 2.083z"/></svg>
                              </div>
                        </div>
                    </div>
                  
                </div>
    



            <div class="row flex-wrap mb-5 mt-5">
                <div class="p-3 col-12 col-md-8">
                    <canvas id="bar"></canvas>
                </div>

                <div class="col-12 col-md-4">
                    <canvas id="doughnut"></canvas>
                </div>
            </div>

            @section('scripts')
            <script>
                     const ctx = document.getElementById('doughnut');
            const bar = document.getElementById('bar');
            
            new Chart(ctx, {
              type: 'doughnut',
              data: {
                labels: @json($categoryNames),
                datasets: [{
                  label: '# of Votes',
                  data: @json($categorydata),
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
            
            new Chart(bar, {
              type: 'bar',
              data: {
                labels:  @json($categoryNames),
                datasets: [{
                  label: 'According to categories',
                  data: @json($categorydata),
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });

             
          
                
            </script>
        @endsection

     
          </div>
        </div>
    </div>
</x-app-layout>
