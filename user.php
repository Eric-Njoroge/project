<?php include('connection.php');

include_once 'header.php';

?>


hello world
<div class="">
    <div class="container-fluid">
        <div class="col-md-12 bg-light text-right">
            <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm"> Add a user</a>
        </div>
        <br>
        <div class="">
            <div class=""></div>
            <div class="">
                <table id="example" class="table">
                    <thead>
                        <th>NO#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>Role</th>
                        <th>Options</th>



                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
                'url': 'fetch_data.php',
                'type': 'post',
            },
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [5]
                },

            ]
        });
    });
    $(document).on('submit', '#addUser', function(e) {
        e.preventDefault();
        var firstname = $('#addFirstNameField').val();
        var lastname = $('#addlastnameField').val();
        var email = $('#addEmailField').val();
        var role = $('#addRoleField').val();
        var mobile = $('#addMobileField').val();
        var city = $('#addCityField').val();
        var password = $('#addPasswordField').val();
      
        if (lastname != '' && firstname != '' && email != '' && role != '') {
            $.ajax({
                url: "add_user.php",
                type: "post",
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    role: role,
                    mobile: mobile,
                    city: city,
                    password: password,
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    var status = json.status;
                    if (status == 'true') {
                        mytable = $('#example').DataTable();
                        mytable.draw();
                        $('#addUserModal').modal('hide');
                    } else {
                        alert('failed');
                    }
                }
            });
        } else {
            alert('Fill all the required fields');
        }
    });
    $(document).on('submit', '#updateUser', function(e) {
        e.preventDefault();
        //var tr = $(this).closest('tr');
        var firstname = $('#firstnameField').val();
        var lastname = $('#lastnameField').val();
        var email = $('#emailField').val();
        var role = $('#roleField').val();
        var mobile = $('#mobileField').val();
        var city = $('#cityField').val();
        var password = $('#passwordField').val();
        var trid = $('#trid').val();
        var id = $('#id').val();
        if (lastname != '' && firstname != '' && email != '' && role != '' && email != '' && mobile != '' && city != '' && password !='') {
            $.ajax({
                url: "update_user.php",
                type: "post",
                data: {
                    lastname: lastname,
                    firstname: firstname,
                    email: email,
                    role: role,
                    mobile: mobile,
                    city: city,
                    password: password,
                    id: id
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    var status = json.status;
                    if (status == 'true') {
                        table = $('#example').DataTable();
                        // table.cell(parseInt(trid) - 1,0).data(id);
                        // table.cell(parseInt(trid) - 1,1).data(name);
                        // table.cell(parseInt(trid) - 1,2).data(role);
                        // table.cell(parseInt(trid) - 1,3).data(type);
                        // table.cell(parseInt(trid) - 1,4).data(quantity);
                        var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
                        var row = table.row("[id='" + trid + "']");
                        row.row("[id='" + trid + "']").data([id, firstname, role, email, lastname, mobile, city,password, button]);
                        $('#exampleModal').modal('hide');
                    } else {
                        alert('failed');
                    }
                }
            });
        } else {
            alert('Fill all the required fields');
        }
    });
    $('#example').on('click', '.editbtn ', function(event) {
        var table = $('#example').DataTable();
        var trid = $(this).closest('tr').attr('id');
        // console.log(selectedRow);
        var id = $(this).data('id');
        $('#exampleModal').modal('show');

        $.ajax({
            url: "get_single_data.php",
            data: {
                id: id
            },
            type: 'post',
            success: function(data) {
                var json = JSON.parse(data);
                $('#firstnameField').val(json.firstname);
                $('#roleField').val(json.role);
                $('#emailField').val(json.email);
                $('#lastnameField').val(json.lastname);
                $('#mobileField').val(json.mobile);
                $('#cityField').val(json.city);
                $('#passwordField').val(json.password);
                $('#id').val(id);
                $('#trid').val(trid);
            }
        })
    });

    $(document).on('click', '.deleteBtn', function(event) {
        var table = $('#example').DataTable();
        event.preventDefault();
        var id = $(this).data('id');
        if (confirm("Are you sure want to delete this User ? ")) {
            $.ajax({
                url: "delete_user.php",
                data: {
                    id: id
                },
                type: "post",
                success: function(data) {
                    var json = JSON.parse(data);
                    status = json.status;
                    if (status == 'success') {
                        //table.fnDeleteRow( table.$('#' + id)[0] );
                        //$("#example1 tbody").find(id).remove();
                        //table.row($(this).closest("tr")) .remove();
                        $("#" + id).closest('tr').remove();
                    } else {
                        alert('Failed');
                        return;
                    }
                }
            });
        } else {
            return null;
        }



    })
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateUser">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="trid" id="trid" value="">
                    <div class="mb-3 row">
                        <label for="firstnameField" class="col-md-3 form-label">firstname</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="firstnameField" name="firstname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roleField" class="col-md-3 form-label">role</label>
                        <div class="col-md-9">
                            <input type="role" class="form-control" id="roleField" name="role">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="typeField" class="col-md-3 form-label">email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="emailField" name="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="lastnameField" class="col-md-3 form-label">lastname</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="lastnameField" name="lastname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mobileField" class="col-md-3 form-label">mobile</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="mobileField" name="mobile">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cityField" class="col-md-3 form-label">city</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="cityField" name="city">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="passwordField" class="col-md-3 form-label">password</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="passwordField" name="password">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Add user Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUser" action="">

                    <div class="mb-3 row">
                        <label for="addFirstNameField" class="col-md-3 form-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addFirstNameField" name="firstname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="addLastNameField" class="col-md-3 form-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addLastNameField" name="lastname">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="addEmailField" class="col-md-3 form-label">Email Address</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addEmailField" name="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="addRoleField" class="col-md-3 form-label">User Role</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addRoleField" name="role">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="addPasswordField" class="col-md-3 form-label">User Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" id="addPasswordField" name="password">
                        </div>
                    </div>



                    <div class="mb-3 row">
                        <label for="addMobileField" class="col-md-3 form-label">Mobile no.</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" id="addMobileField" name="mobile">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="addCityField" class="col-md-3 form-label">City</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="addCityField" name="city">
                        </div>
                    </div>
                    <!-- <div class="mb-3 row">
											<label for="addFirstNameField" class="col-md-3 form-label">quantity</label>
											<div class="col-md-9">
												<input type="text" class="form-control" id="addFirstNameField" name="quantity">
											</div>
										</div> -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
<?php

include_once 'footer.php'

?>