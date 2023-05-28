@extends('layouts.dash')

@include('admin.navbar')
@include('admin.sidebar')
@include('admin.maincards') 
{{-- @include('admin.scripts') --}}

@section('content')

   

    {{-- new with sweetalert --}}

    {{-- add new Team modal start --}}
<div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Team</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_team_form" enctype="multipart/form-data">
      {{-- {{ csrf_field() }} --}}
      @csrf
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="team_name">Team Name</label>
            <input type="text" name="team_name" class="form-control" placeholder="Team Name" required>
          </div>
          <div class="col-lg">
            <label for="team_id">Team ID</label>
            <input type="text" name="team_id" class="form-control" placeholder="Team ID" required>
          </div>
        </div>
        <div class="my-2">
          <label for="team_email">Team Email</label>
          <input type="team_email" name="team_email" class="form-control" placeholder="Team Email" required>
        </div>
       
        <div class="my-2">
          <label for="team_pic">Team Pic</label>
          <input type="file" name="team_pic" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_Team_btn" class="btn btn-primary">Add Team</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- add new Team modal end --}}

{{-- edit Team modal start --}}
<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Team</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="edit_team_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" id="id">
      <input type="hidden" name="memb_team_pic" id="memb_team_pic">
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="team_name">Team Name</label>
            <input type="text" name="team_name" id="team_name" class="form-control" placeholder="Team Name" required>
          </div>
          <div class="col-lg">
            <label for="team_id">Team ID</label>
            <input type="text" name="team_id" id="Team_id" class="form-control" placeholder="Team ID" required>
          </div>
        </div>
        <div class="my-2">
          <label for="team_email">Team Email</label>
          <input type="team_email" name="team_email" id="team_email" class="form-control" placeholder="Team Email" required>
        </div>
       
        <div class="my-2">
          <label for="team_pic">Team Pic</label>
          <input type="file" name="team_pic" class="form-control">
        </div>
        <div class="mt-2" id="team_pic">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="edit_Team_btn" class="btn btn-success">Update Team</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- edit Team modal end --}}

<body class="bg-light">
<div class="container">
  <div class="row my-5">
    <div class="col-lg-12">
      <div class="card shadow">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
          <h3 class="text-light">Manage SportTeams</h3>
          <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addTeamModal"><i
              class="bi-plus-circle me-2"></i>Add New SportTeam</button>
        </div>
        <div class="card-body" id="show_all_teams">
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

    // add new Team ajax request
    $("#add_team_form").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      // console.log(fd);
      $("#add_team_btn").text('Adding...');
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
              'Team Added Successfully!',
              'success'
            )
            fetchAllTeams();
          }
          $("#add_team_btn").text('Add Team');
          $("#add_team_form")[0].reset();
          $("#addTeamModal").modal('hide');
        }
      });
    });

    // edit team ajax request
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
          $("#team_name").val(response.team_name);
          $("#team_id").val(response.team_id);
          $("#team_email").val(response.team_email);
          $("#team_pic").html(
            `<img src="public/storage/images/${response.team_pic}" width="100" class="img-fluid img-thumbnail">`);
          $("#team_id").val(response.id);
          $("#memb_team_pic").val(response.team_pic);
        }
      });
    });

    // update team ajax request
    $("#edit_team_form").submit(function(e) {
      e.preventDefault();
      const fd = new FormData(this);
      $("#edit_team_btn").text('Updating...');
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
              'Team Updated Successfully!',
              'success'
            )
            fetchAllTeams();
          }
          $("#edit_team_btn").text('Update Team');
          $("#edit_team_form")[0].reset();
          $("#editTeamModal").modal('hide');
        }
      });
    });

    // delete team ajax request
    $(document).on('click', '.deleteIcon', function(e) {
      e.preventDefault();
      // let id=$("#id").val();
      
      let id = $(this).attr('team_id');
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
              fetchAllTeams();
            }
          });
        }
      })
    });

    // fetch all teams ajax request
    fetchAllTeams();

    function fetchAllTeams() {
      $.ajax({
        url: '{{ route('fetchAll') }}',
        method: 'get',
        success: function(response) {
          $("#show_all_teams").html(response);
          $("table").DataTable({
            order: [0, 'desc']
          });
        }
      });
    }
  });
</script>
@endsection


