
<x-client-layout.clientapp>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content  bg-dark">
            <div class="modal-header">
              <h5 class="modal-title text-white" id="exampleModalLabel">Delete Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  text-white">
              Are you sure you want to delete this item permently?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary  text-white" data-bs-dismiss="modal">Cancel</button>
              <form method="POST" action="#" id="deleteForm">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger  text-white">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <div class="container">
    <div class="profile-conatiner text-white">
        <div class="card mt-5 mb-5 pt-5 pb-5 ps-5 pe-5" style="background-color: #343a40">


        <div class="">
            <div class="d-flex justify-content-center align-items-center">
                <div class="max-w-xl w-100">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <div class="max-w-xl w-100">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <div class="max-w-xl w-100">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</x-client-layout.clientapp>