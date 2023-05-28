@extends('layouts.dash')

@include('admin.navbar')
@include('admin.sidebar')
@include('admin.maincards') 
{{-- @include('admin.scripts') --}}

@section('content')

   

    {{-- new with sweetalert --}}

    {{-- add new referee modal start --}}
<div class="modal fade" id="addRefereeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Referee</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_referee_form" enctype="multipart/form-data">
      {{-- {{ csrf_field() }} --}}
      @csrf
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="referee_name">Referee Name</label>
            <input type="text" name="referee_name" class="form-control" placeholder="Referee Name" required>
          </div>
          <div class="col-lg">
            <label for="referee_id">Referee ID</label>
            <input type="text" name="referee_id" class="form-control" placeholder="Referee ID" required>
          </div>
        </div>
        <div class="my-2">
          <label for="referee_email">Referee Email</label>
          <input type="referee_email" name="referee_email" class="form-control" placeholder="Referee Email" required>
        </div>
       
        <div class="my-2">
          <label for="referee_pic">Referee Pic</label>
          <input type="file" name="referee_pic" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_Referee_btn" class="btn btn-primary">Add Referee</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- add new referee modal end --}}

{{-- edit referee modal start --}}
<div class="modal fade" id="editRefereeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Referee</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="edit_referee_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" id="id">
      <input type="hidden" name="memb_referee_pic" id="memb_referee_pic">
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="referee_name">Referee Name</label>
            <input type="text" name="referee_name" id="referee_name" class="form-control" placeholder="Referee Name" required>
          </div>
          <div class="col-lg">
            <label for="referee_id">Referee ID</label>
            <input type="text" name="referee_id" id="referee_id" class="form-control" placeholder="Referee ID" required>
          </div>
        </div>
        <div class="my-2">
          <label for="referee_email">Referee Email</label>
          <input type="referee_email" name="referee_email" id="referee_email" class="form-control" placeholder="Referee Email" required>
        </div>
       
        <div class="my-2">
          <label for="referee_pic">Referee Pic</label>
          <input type="file" name="referee_pic" class="form-control">
        </div>
        <div class="mt-2" id="referee_pic">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="edit_Referee_btn" class="btn btn-success">Update Referee</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- edit referee modal end --}}

<body class="bg-light">
<div class="container">
  <div class="row my-5">
    <div class="col-lg-12">
      <div class="card shadow">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
          <h3 class="text-light">Manage Referees</h3>
          <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addRefereeModal"><i
              class="bi-plus-circle me-2"></i>Add New Referee</button>
        </div>
        <div class="card-body" id="show_all_referees">
          <h1 class="text-center text-secondary my-5">Loading...</h1>
        </div>
      </div>
    </div>
  </div>
</div>
 
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script>
  $(function() {

    // add new referee ajax request
    $("#add_referee_form").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      // console.log(fd);
      $("#add_referee_btn").text('Adding...');
      $.ajax({
        url: '{{ route('store') }}',
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
          if (response.status == 200) {
            Swal.fire(
              'Added!',
              'Referee Added Successfully!',
              'success'
            )
            fetchAllReferees();
          }
          $("#add_referee_btn").text('Add Referee');
          $("#add_referee_form")[0].reset();
          $("#addRefereeModal").modal('hide');
        }
      });
    });

    // edit referee ajax request
    $(document).on('click', '.editIcon', function(e) {
      e.preventDefault();
      let id = $(this).attr('id');
      $.ajax({
        url: '{{ route('edit') }}',
        method: 'get',
        data: {
          id: id,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          $("#referee_name").val(response.referee_name);
          $("#referee_id").val(response.referee_id);
          $("#referee_email").val(response.referee_email);
          $("#referee_pic").html(
            `<img src="public/storage/images/${response.referee_pic}" width="100" class="img-fluid img-thumbnail">`);
          $("#referee_id").val(response.id);
          $("#memb_referee_pic").val(response.referee_pic);
        }
      });
    });

    // update referee ajax request
    $("#edit_referee_form").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      $("#edit_referee_btn").text('Updating...');
      $.ajax({
        url: '{{ route('update') }}',
        method: 'post',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
          if (response.status == 200) {
            Swal.fire(
              'Updated!',
              'Referee Updated Successfully!',
              'success'
            )
            fetchAllReferees();
          }
          $("#edit_referee_btn").text('Update Referee');
          $("#edit_referee_form")[0].reset();
          $("#editRefereeModal").modal('hide');
        }
      });
    });

    // delete referee ajax request
    $(document).on('click', '.deleteIcon', function(e) {
      e.preventDefault();
      // let id=$("#id").val();
      
      let id = $(this).attr('referee_id');
      // console.log(id);
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '{{ route('delete') }}',
            method: 'delete',
            data: {
              id: id,
              _token: csrf
            },
            success: function(response) {
              console.log(response);
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              fetchAllReferees();
            }
          });
        }
      })
    });

    // fetch all referees ajax request
    fetchAllReferees();

    function fetchAllReferees() {
      $.ajax({
        url: '{{ route('fetchAll') }}',
        method: 'get',
        success: function(response) {
          $("#show_all_referees").html(response);
          $("table").DataTable({
            order: [0, 'desc']
          });
        }
      });
    }
  });
</script>
@endsection


