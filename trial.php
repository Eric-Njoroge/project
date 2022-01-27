<?php
//  include_once '/opt/lampp/htdocs/project/header.php ';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3"></div>
            <table class="table table-bordered" id="ordersTable">
                <thead>
                    <th>NO#</th>
                    <th>PRODUCT NAME</th>
                    <th>PRODUCT QUANTITY</th>
                    <th>PRODUCT TYPE</th>
                    <th>PRODUCT SUPPLIER</th>
                    <th>DATE</th>
                    <th>CREATED BY</th>
                </thead>

                <tbody>


                    <?php
                    include_once 'connection.php';

                    $sql = mysqli_query($con, "SELECT * FROM orders
WHERE quantity < 200 ");

while ($result = mysqli_fetch_array($sql)) {
    # code...
    echo "<tr>
    <td>'.$result[id].'</td>
    <td>'.$result[name].'</td>
    <td>'.$result[quantity].'</td>
    <td>'.$result[date].'</td>
    <td>'.$result[createdby].'</td>
 
    </tr>";
}

                    ?>

                </tbody>

            </table>
        </div>
    </div>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    
    

    <script >
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>

<!-- 
<script>
	
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script> -->

</body>

</html>