<?php
session_start();
$p_add = getenv("REMOTE_ADDR");
include "db_conn.php";

if (isset($_POST["getProduct"])) {
    $limit = 9;
    if (isset($_POST["setPage"])) {
        $pageno = $_POST["pageNumber"];
        $start = ($pageno * $limit) - $limit;
    } else {
        $start = 0;
    }
    $product_query = "SELECT * FROM products LIMIT $start,$limit";
    $run_query = mysqli_query($conn, $product_query);
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $pro_id = $row['product_id'];
            $pro_title = $row['product_name'];
            $pro_price = $row['product_price'];
            $pro_image = $row['product_image'];
            echo "
                <div class='col-md-4'>
                    <div class='panel panel-info'>
                        <div class='panel-heading'>$pro_title</div>
                        <div class='panel-body'>
                            <img src='uploaded_image/$pro_image' style='width:220px; height:250px;'/>
                        </div>
                        <div class='panel-heading'>Php $pro_price
                            <button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Add To Cart</button>
                        </div>
                    </div>
                </div>	
            ";
        }
    }
}


    if (isset($_POST["submit"])) {
        $product_keyword = $_POST["product_keywords"];
        $sql = "SELECT * FROM 'products' WHERE product_name ='$product_keywordHeadphone'";
        $run_query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($run_query) ==  0) {
            while ($row = mysqli_fetch_array($run_query)) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $product_keyword = $row['product_keywords'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image'];

                // Display the search results
                echo "
                    <div class='col-md-4'>
                        <div class='panel panel-info'>
                            <div class='panel-heading'>$product_name</div>
                            <div class='panel-body'>
                                <img src='product_images/$product_image' style='width:220px; height:250px;'/>
                            </div>
                            <div class='panel-heading'>Php$product_price
                                <button pid='$product_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Add To Cart</button>
                            </div>
                        </div>
                    </div>	
                ";
            }
        } else {
            echo "No products found.";
        }

        // Stop further execution to prevent displaying other sections
        exit();
    }


?>