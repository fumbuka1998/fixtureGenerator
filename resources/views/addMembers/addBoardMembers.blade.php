@extends('layouts.addboard')

@section('content')
    <!-- add member model -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Board Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- display error validations --}}
                    <ul id="saveform_errlist"></ul>

                    <div class="form-control mb-3">
                        <label for="">Member Name</label>
                        <input type="text" class="name form-control">
                    </div>
                    <div class="form-control mb-3">
                        <label for="">Member Email</label>
                        <input type="text" class="email form-control">
                    </div>
                    <div class="form-control mb-3">
                        <label for="">Member Pic</label>
                        <input type="file" class="pic form-control">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_member">Add Member</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of add Member modal --}}

    <!-- edit Member model -->
    <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit/Update Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- display error validations --}}
                    <ul id="updateform_errlist"></ul>

                    {{-- <input type="text" id="edit_Member_id"> --}}

                    <input type="hidden" id="edit_member_id" class="id form-control">

                    <div class="form-control mb-3">
                        <label for="">Name</label>
                        <input type="text" id="edit_name" class="name form-control">
                    </div>
                    <div class="form-control mb-3">
                        <label for="">Email</label>
                        <input type="text" id="edit_email" class="email form-control">
                    </div>
                    <div class="form-control mb-3">
                        <label for="">Member Pic</label>
                        <input type="text" id="edit_pic" class="pic form-control">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_member">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of edit member modal --}}


    <!-- delete member model -->
    <div class="modal fade" id="deleteMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <input type="hidden" id="delete_member_id" class="id form-control">
                    <h3>are you sure you want to delete this member?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_member_btn">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of delete member modal --}}

    <div class="container py-5">
        <div class="row">
            <div class="container text-md-center">
                <h2 class="barge bg-dark text-light">
                    BOARDMEMBER DASHBOARD
                </h2>
            </div>

            <div class="col-md-12">
                {{-- the div tag below display the  success message from ajax response --}}
                <div id="success_message"></div>

                <div class="card">
                    <div class="card-header">
                        <h4>
                            BoardMember Data
                            <a href="#" class="btn btn-primary float-end btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addMemberModal">Add BoardMember</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered  table-striper table-hover">
                            <thead>
                                <tr>
                                    <th>MEMBER ID</th>
                                    <th>MEMBER NAME</th>
                                    <th>MEMBER EMAIL</th>
                                    <th>MEMBER PIC</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            fetchMembers()
            //ajax function to get data from the database
            function fetchMembers() {
                $.ajax({
                    type: 'GET',
                    url: '/fetchmembers',
                    dataType: 'json',
                    success: function(response) {

                        $('tbody').html(""); //empty he table first
                        // alert(1);
                        // console.log(response.members);
                        $.each(response.members, function(key, item) {
                            $('tbody').append(
                                `<tr>
                                    <td>` + item.id + `</td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.email + `</td>
                                    <td>` + item.pic + `</td>
                                    
                                    <td><button type="button" value="` + item.id + `"
                                            class="edit_member btn btn-primary btn-sm">edit</button></td>
                                    <td><button type="button" value="` + item.id + `"
                                            class="delete_member btn btn-danger btn-sm">delete</button></td>
                                </tr>`
                            );
                        });

                    }
                });
            }

            // an ajax function to member data from the list
            $(document).on('click', '.delete_member', function(e) {
                e.preventDefault();

                var std_id = $(this).val();
                // alert(std_id);
                $('#delete_member_id').val(std_id);
                $('#deleteMemberModal').modal('show');

            });
            $(document).on('click', '.delete_member_btn', function(e) {
                e.preventDefault();

                $(this).text('deleting');
                var std_id = $('#delete_member_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'delete',
                    url: '/delete-member/' + member_id,
                    success: function(response) {
                        // alert(response)
                        $('#success_message').text(response.message);
                        $('#success_message').addClass('alert alert-success');
                        $('#deleteMemberModal').modal('hide');
                        setTimeout(function() {
                            $("#success_message").text("").removeClass();
                        }, 5000);
                        $('.delete_member_btn').text('Yes Delete');

                        fetchMembers();
                    }
                });


            });
            //function below edit members by id
            $(document).on('click', '.edit_member', function(e) {
                e.preventDefault();
                var std_id = $(this).val();
                // console.log(std_id);
                // alert(1);
                $('#editMemberModal').modal('show');
                //ajax get request to fetch data to be edited
                $.ajax({
                    method: "GET",
                    url: "/edit-member/" + std_id,
                    type: "JSON",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            $('#edit_name').val(response.member.name);
                            $('#edit_email').val(response.member.email);
                            $('#edit_pic').val(response.member.pic);
                            $('#edit_member_id').val(std_id);
                        }
                    }

                });
            });

            //update function appear below 
            $(document).on('click', '.update_member', function(e) {
                e.preventDefault();
                $(this).text('Updating');
                var std_id = $('#edit_member_id').val();

                var ed_data = {
                    'name': $('#edit_name').val(),
                    'email': $('#edit_email').val(),
                    'pic': $('#edit_pic').val(),
                    

                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'PUT',
                    url: '/update_member/' + std_id,
                    data: ed_data,
                    dataType: 'json',
                    success: function(response) {
                        // alert(1);
                        // console.log(response);
                        if (response.status == 400) {
                            $('#updateform_errlist').html("");
                            $('#updateform_errlist').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_values) {
                                // console.log(err_values);
                                $('#updateform_errlist').append(`<li>` + err_values +
                                    `</li>`);

                            });
                            $('.update_member').text('Update');

                            setTimeout(function() {
                                $("#updateform_errlist").text("").removeClass();
                            }, 5000);

                        } else if (response.status == 404) {
                            $('#updateform_errlist').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);

                        } else {
                            $('#updateform_errlist').html("");
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.update_member').text('Update');

                            $('#editMemberModal').modal('hide');

                            fetchMembers();

                        }
                    }
                });
            })

            //below function add members to list
            $(document).on('click', '.add_member', function(e) {
                e.preventDefault();
                // alert('tunafika hapa');
                //below variable take data from the input field using jquery
                var data = {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'pic': $('.pic').val(),
                    
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // console.log(data)
                $.ajax({
                    type: 'POST',
                    url: '/memberstore',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#saveform_errlist').html("");
                            $('#saveform_errlist').addClass('alert alert-danger');
                            $.each(response.error, function(key, err_values) {
                                // console.log(err_values);
                                $('#saveform_errlist').append(`<li>` + err_values +
                                    `</li>`);

                            });
                            setTimeout(function() {
                                $("#saveform_errlist").text("").removeClass();
                            }, 5000);
                        } else {

                            $('#saveform_errlist').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#addMemberModal').modal('hide');
                            $('#addMemberModal').find('input').val("");
                            fetchMembers();
                            //function to set time out for the success message
                            setTimeout(function() {
                                $("#success_message").text("").removeClass();
                            }, 5000);

                        }
                    }
                });
            });
        });
    </script>
@endsection
