@extends('layouts.dash')

@include('admin.navbar')
@include('admin.sidebar')
@include('admin.maincards') 
{{-- @include('admin.scripts') --}}

@section('content')

   

    {{-- new with sweetalert --}}

    {{-- add new stadium modal start --}}
<div class="modal fade" id="addStadiumModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Stadium</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_stadium_form" enctype="multipart/form-data">
      {{-- {{ csrf_field() }} --}}
      @csrf
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="stadium_name">Stadium Name</label>
            <input type="text" name="stadium_name" class="form-control" placeholder="Stadium Name" required>
          </div>
          <div class="col-lg">
            <label for="stadium_id">Stadium ID</label>
            <input type="text" name="stadium_id" class="form-control" placeholder="Stadium ID" required>
          </div>
        </div>
        <div class="my-2">
          <label for="stadium_email">Stadium Email</label>
          <input type="stadium_email" name="stadium_email" class="form-control" placeholder="Stadium Email" required>
        </div>
       
        <div class="my-2">
          <label for="stadium_pic">Stadium Pic</label>
          <input type="file" name="stadium_pic" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_stadium_btn" class="btn btn-primary">Add Stadium</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- add new stadium modal end --}}

{{-- edit stadium modal start --}}
<div class="modal fade" id="editStadiumModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Stadium</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="edit_stadium_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" id="id">
      <input type="hidden" name="memb_stadium_pic" id="memb_stadium_pic">
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="stadium_name">Stadium Name</label>
            <input type="text" name="stadium_name" id="stadium_name" class="form-control" placeholder="Stadium Name" required>
          </div>
          <div class="col-lg">
            <label for="stadium_id">Stadium ID</label>
            <input type="text" name="stadium_id" id="stadium_id" class="form-control" placeholder="Stadium ID" required>
          </div>
        </div>
        <div class="my-2">
          <label for="stadium_email">Stadium Email</label>
          <input type="stadium_email" name="stadium_email" id="stadium_email" class="form-control" placeholder="Stadium Email" required>
        </div>
       
        <div class="my-2">
          <label for="stadium_pic">Stadium Pic</label>
          <input type="file" name="stadium_pic" class="form-control">
        </div>
        <div class="mt-2" id="stadium_pic">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="edit_stadium_btn" class="btn btn-success">Update Stadium</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- edit stadium modal end --}}

<body class="bg-light">
<div class="container">
  <div class="row my-5">
    <div class="col-lg-12">
      <div class="card shadow">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
          <h3 class="text-light">Manage Stadiums</h3>
          <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addStadiumModal"><i
              class="bi-plus-circle me-2"></i>Add New Stadium</button>
        </div>
        <div class="card-body" id="show_all_stadiums">
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

    // add new stadium ajax request
    $("#add_stadium_form").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      // console.log(fd);
      $("#add_stadium_btn").text('Adding...');
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
              'Stadium Added Successfully!',
              'success'
            )
            fetchAllStadiums();
          }
          $("#add_stadium_btn").text('Add Stadium');
          $("#add_stadium_form")[0].reset();
          $("#addStadiumModal").modal('hide');
        }
      });
    });

    // edit stadium ajax request
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
          $("#stadium_name").val(response.stadium_name);
          $("#stadium_id").val(response.stadium_id);
          $("#stadium_email").val(response.stadium_email);
          $("#stadium_pic").html(
            `<img src="public/storage/images/${response.stadium_pic}" width="100" class="img-fluid img-thumbnail">`);
          $("#stadium_id").val(response.id);
          $("#memb_stadium_pic").val(response.stadium_pic);
        }
      });
    });

    // update stadium ajax request
    $("#edit_stadium_form").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      $("#edit_stadium_btn").text('Updating...');
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
              'Stadium Updated Successfully!',
              'success'
            )
            fetchAllStadiums();
          }
          $("#edit_stadium_btn").text('Update Stadium');
          $("#edit_stadium_form")[0].reset();
          $("#editStadiumModal").modal('hide');
        }
      });
    });

    // delete stadium ajax request
    $(document).on('click', '.deleteIcon', function(e) {
      e.preventDefault();
      // let id=$("#id").val();
      
      let id = $(this).attr('stadium_id');
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
              fetchAllStadiums();
            }
          });
        }
      })
    });

    // fetch all stadiums ajax request
    fetchAllStadiums();

    function fetchAllStadiums() {
      $.ajax({
        url: '{{ route('fetchAll') }}',
        method: 'get',
        success: function(response) {
          $("#show_all_stadiums").html(response);
          $("table").DataTable({
            order: [0, 'desc']
          });
        }
      });
    }
  });
</script>
@endsection


