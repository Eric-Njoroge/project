<?php include('connection.php');

include_once 'header.php';

?>



<div class="">
	<div class="container-fluid">
		<div class="col-md-12 bg-light text-right">
			<a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addOrderModal" class="btn btn-success btn-sm">Place an Order</a>
		</div>
		<br>
		<div class="">
			<div class=""></div>
			<div class="">
				<table id="example1" class="table">
					<thead>
						<th>NO#</th>
						<th>PRODUCT NAME</th>
						<th>PRODUCT QUANTITY</th>
						<th>PRODUCT TYPE</th>
						<th>PRODUCT SUPPLIER</th>
						<th>DATE</th>
						<th>CREATED BY</th>
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
		$('#example1').DataTable({
			"fnCreatedRow": function(nRow, aData, iDataIndex) {
				$(nRow).attr('id', aData[0]);
			},
			'serverSide': 'true',
			'processing': 'true',
			'paging': 'true',
			'order': [],
			'ajax': {
				'url': 'fetch_order.php',
				'type': 'post',
			},
			"aoColumnDefs": [{
					"bSortable": false,
					"aTargets": [5]
				},

			]
		});
	});
	$(document).on('submit', '#addOrder', function(e) {
		e.preventDefault();
		var name = $('#addNameField').val();
		var quantity = $('#addQuantityField').val();
		var type = $('#addTypeField').val();
		var supplier = $('#addSupplierField').val();
		var date = $('#addDateField').val();
		var createdby = $('#addCreatedbyField').val();
		if (quantity != '' && name != '' && type != '' && supplier != '') {
			$.ajax({
				url: "add_order.php",
				type: "post",
				data: {
					name: name,
					quantity: quantity,
					type: type,
					supplier: supplier,
					date: date,
					createdby: createdby,
				},
				success: function(data) {
					var json = JSON.parse(data);
					var status = json.status;
					if (status == 'true') {
						mytable = $('#example1').DataTable();
						mytable.draw();
						$('#addOrderModal').modal('hide');
					} else {
						alert('failed');
					}
				}
			});
		} else {
			alert('Fill all the required fields');
		}
	});
	$(document).on('submit', '#updateOrder', function(e) {
		e.preventDefault();
		//var tr = $(this).closest('tr');
		// var name = $('#nameField').val();
		// var quantity = $('#quantityField').val();
		// var type = $('#typeField').val();
		// var supplier = $('#supplierField').val();
		// var date = $('#sateField').val();
		// var createdby = $('#createdbyField').val();

		///////////////////////
		var name = $('#nameField').val();
        var quantity = $('#quantityField').val();
        var type = $('#typeField').val();
        var supplier = $('#supplierField').val();
        var date = $('#dateField').val();
        var createdby = $('#createdbyField').val();
      

		//////////////////
		var trid = $('#trid').val();
		var id = $('#id').val();
		if (quantity != '' && name != '' && type != '' && supplier != '' && type != '' && date != '' && createdby != '') {
			$.ajax({
				url: "update_order.php",
				type: "post",
				data: {
					quantity: quantity,
					name: name,
					type: type,
					supplier: supplier,
					date: date,
					createdby: createdby,
					id: id,
				},
				success: function(data) {
					var json = JSON.parse(data);
					var status = json.status;
					if (status == 'true') {
						table = $('#example1').DataTable();
						// table.cell(parseInt(trid) - 1,0).data(id);
						// table.cell(parseInt(trid) - 1,1).data(name);
						// table.cell(parseInt(trid) - 1,2).data(supplier);
						// table.cell(parseInt(trid) - 1,3).data(type);
						// table.cell(parseInt(trid) - 1,4).data(quantity);
						var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
						var row = table.row("[id='" + trid + "']");
						row.row("[id='" + trid + "']").data([id, name, supplier, type, quantity, date, createdby, button]);
						$('#example1Modal').modal('hide');
					} else {
						alert('failed');
					}
				}
			});
		} else {
			alert('Fill all the required fields');
		}
	});
	$('#example1').on('click', '.editbtn ', function(event) {
		var table = $('#example1').DataTable();
		var trid = $(this).closest('tr').attr('id');
		// console.log(selectedRow);
		var id = $(this).data('id');
		$('#example1Modal').modal('show');

		$.ajax({
			url: "get_single_data_orders.php",
			data: {
				id: id
			},
			type: 'post',
			success: function(data) {
				var json = JSON.parse(data);
				$('#nameField').val(json.name);
				$('#supplierField').val(json.supplier);
				$('#typeField').val(json.type);
				$('#quantityField').val(json.quantity);
				$('#dateField').val(json.date);
				$('#createdbyField').val(json.createdby);
				$('#id').val(id);
				$('#trid').val(trid);
			}
		})
	});

	$(document).on('click', '.deleteBtn', function(event) {
		var table = $('#example1').DataTable();
		event.preventDefault();
		var id = $(this).data('id');
		if (confirm("Are you sure want to delete this User ? ")) {
			$.ajax({
				url: "delete_order.php",
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
<div class="modal fade" id="example1Modal" tabindex="-1" aria-labelledby="example1ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example1ModalLabel">Update Order</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="updateOrder">
					<input type="hidden" name="id" id="id" value="">
					<input type="hidden" name="trid" id="trid" value="">
					<div class="mb-3 row">
						<label for="nameField" class="col-md-3 form-label">Name</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="nameField" name="name">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="supplierField" class="col-md-3 form-label">supplier</label>
						<div class="col-md-9">
							<input type="supplier" class="form-control" id="supplierField" name="supplier">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="typeField" class="col-md-3 form-label">type</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="typeField" name="type">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="quantityField" class="col-md-3 form-label">quantity</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="quantityField" name="quantity">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="dateField" class="col-md-3 form-label">date</label>
						<div class="col-md-9">
							<input type="date" class="form-control" id="dateField" name="date">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="createdbyField" class="col-md-3 form-label">createdby</label>
						<div class="col-md-9">
							<input type="text" class="form-control" value= " <?php echo $_SESSION['firstname']; ?>"id="createdby" name="createdby">
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
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="example1ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example1ModalLabel">PLace an Order</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="addOrder" action="">

					<div class="mb-3 row">
						<label for="addNameField" class="col-md-3 form-label">Product Name</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="addNameField" name="name">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="addQuantityField" class="col-md-3 form-label">Product Quantity</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="addQuantityField" name="quantity">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="addTypeField" class="col-md-3 form-label">Product Type</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="addTypeField" name="type">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="addSupplierField" class="col-md-3 form-label">Product Supplier</label>
						<div class="col-md-9">
							<input type="supplier" class="form-control" id="addSupplierField" name="supplier">
						</div>
					</div>



					<div class="mb-3 row">
						<label for="addDateField" class="col-md-3 form-label">Order Date</label>
						<div class="col-md-9">
							<input type="date" class="form-control" id="addDateField" name="date">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="addCreatedbyField" class="col-md-3 form-label">Created By</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="addCreatedbyField" value=" <?php echo $_SESSION['firstname']; ?>" name="createdby">
						</div>
					</div>
					<!-- <div class="mb-3 row">
											<label for="addNameField" class="col-md-3 form-label">quantity</label>
											<div class="col-md-9">
												<input type="text" class="form-control" id="addNameField" name="quantity">
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