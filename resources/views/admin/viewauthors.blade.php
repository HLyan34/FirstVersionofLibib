<x-app-layout>
  <x-slot name="slot">
    <div class="container mt-5 mb-5">
      <div class="heading-container w-100 mt-3 mb-5 d-flex justify-content-sm-between flex-column flex-sm-row justify-content-start align-items-sm-center align-items-start">
        <h3 class="h3 text-white mt-2">View Authors</h1>
          <div>
            <a class="btn btn-warning mt-2" href="{{route('authors.trashed')}}">Trashed</a>
            <a class="btn btn-success mt-2" href="{{route('authors.create')}}"> Create</a>
          </div>
      </div>
      <table class="table table-bordered data-table-authors  table-dark table-striped w-100 mt-5">
          <thead>
              <tr>
                  <th width="20%" class="d-none d-sm-table-cell">No</th>
                  <th  width="20%">Author Name</th>
                  <th  width="20%">Author Image</th>
                  <th  width="20%">Action</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>
       
  </body>
       
  <script type="text/javascript">
    $(function () {
        
      var table = $('.data-table-authors').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('authors.index') }}",
          columns: [
              {data: 'id', name: 'id', className: 'd-none d-sm-table-cell'},
              {data: 'name', name: 'name'},
              {
            data: 'image',
            name: 'image',
            render: function(data, type, row) {
              
          return '<img src="' + data + '" alt="Image" height="50" width="50">';
        }
      },
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
        
    });
  </script>
  </x-slot>
</x-app-layout>
