<?php
include_once 'header.php'

?>
<!DOCTYPE html>
<html>

<head>

    <title> Export HTML Table To Excel, CSV, PDF and More </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!--[CSS/JS Files - Start]-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">


    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Blfrtip',
            });

        });
    </script>

</head>

<body>

    <div class="">

        <div style="padding:50px;"></div>
        <div class="text-center">

        </div>

        <h1>Products</h1>

        <table id="example" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                <th>NO#</th>
                    <th>PRODUCT NAME</th>
                    <th>PRODUCT CATEGORY</th>
                    <th>PRODUCT QUANTITY</th>
                    <th>UNIT PRICE</th>
                </tr>

            </thead>
            <tbody>

                <?php
                include_once 'connection.php';

                $sql = mysqli_query($con, "SELECT * FROM products");

                while ($result = mysqli_fetch_array($sql)) {
                    # code...
                    echo "<tr>
                    <td>$result[productId]</td>
                    <td>$result[productName]</td>
                    <td>$result[productCategory]</td>
                    <td>$result[productQuantity]</td>
                    <td>$result[unitPrice]</td>

 
    </tr>";
                }

                ?>

            </tbody>
            <tfoot>
                <tr>     <th>NO#</th>
                    <th>PRODUCT NAME</th>
                    <th>PRODUCT CATEGORY</th>
                    <th>PRODUCT QUANTITY</th>
                    <th>UNIT PRICE</th>

                </tr>
            </tfoot>
        </table>

    </div>


</body>

</html>