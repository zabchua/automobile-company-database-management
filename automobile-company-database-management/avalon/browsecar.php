<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>SZA Auto</title>
</head>
<body>
  <nav>
    <div class="logo"> <a href="index.php"><img src="images/logo.png" alt="#"></a> </div>
    <ul>
      <li><a href="index.php">Home</a></li>
      
     

    </ul>
  </nav>
  
  <div style="width: 1100px; margin: 0 auto;">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Browse Through Our Available Car models</h4>
                    </div>
                </div>
            </div>

           
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                            <select name="sort" class="form-control">
                                            <option value="">--Select Option--</option>
                                            <option value="a-z" <?php if(isset($_GET['sort']) && $_GET['sort'] == "a-z"){ echo "selected"; } ?> > A-Z (Ascending Order)</option>
                                            <option value="z-a" <?php if(isset($_GET['sort']) && $_GET['sort'] == "z-a"){ echo "selected"; } ?> > Z-A (Descending Order)</option>
                                            <option value="price_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == "price_asc"){ echo "selected"; } ?> > price_asc</option>
                                            <option value="price_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == "price_desc"){ echo "selected"; } ?> > price_desc</option>
                                            <option value="year_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == "year_asc"){ echo "selected"; } ?> > Older Model</option>
                                            <option value="year_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == "year_desc"){ echo "selected"; } ?> > Newer Model</option>
                                        </select>
                                        
                        </div>
                        <!-- Search Bar  -->
                        <div class="card-body">
                        <input type = "text" name = "search"
                         value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>"
                            placeholder = "search for car models">
                        <!-- Price Filter 
                            <div class="col-md-4">
                                    <label for="">Start Price</label>
                                    <input type="text" name="start_price" value="<?php if(isset($_GET['start_price'])){echo $_GET['start_price']; }else{echo "0";} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">End Price</label>
                                    <input type="text" name="end_price" value="<?php if(isset($_GET['end_price'])){echo $_GET['end_price']; }else{echo "0";} ?>" class="form-control">
                                </div>
                       -->

                        <!-- Brand List -->
                            <h6>Brand List</h6>
                            <hr>
                            <?php
                                $con = mysqli_connect("localhost","root","","sza");

                                $brand_query = "SELECT * FROM brand";
                                $brand_query_run  = mysqli_query($con, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['brands']))
                                        {
                                            $checked = $_GET['brands'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="brands[]" value="<?= $brandlist['brand_id']; ?>" 
                                                    <?php if(in_array($brandlist['brand_id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['brand_name']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                
                            ?>
                        </div>
                        <!-- Car Type  -->
                        <div class="card-body">
                            <h6>Vehicle Type</h6>
                            <hr>
                            <?php
                                $con = mysqli_connect("localhost","root","","sza");

                                $type_query = "SELECT * FROM vehicle_type";
                                $type_query_run  = mysqli_query($con, $type_query);

                                if(mysqli_num_rows($type_query_run) > 0)
                                {
                                    foreach($type_query_run as $typelist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['type']))
                                        {
                                            $checked = $_GET['type'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="type[]" value="<?= $typelist['type_id']; ?>" 
                                                    <?php if(in_array($typelist['type_id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $typelist['type_name']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                               
                            ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Brand Items - Products -->
            <div class="col-md-9 mt-3">
                <div class="card ">
                    <div class="card-body row">
                        
                        <?php

                        $sort_option = "ASC";
                        $sort_field = "serial_no";
                        
                        if(isset($_GET['sort']))
                        {
                            if($_GET['sort'] == "a-z")
                            {
                                $sort_field = "model_name";
                                $sort_option = "ASC";
                            }elseif($_GET['sort'] == "z-a")
                            {
                                $sort_field = "model_name";
                                $sort_option = "DESC";
                            }
                            elseif($_GET['sort'] == "price_asc")
                            {
                                $sort_field = "price";
                                $sort_option = "ASC";
                            }elseif($_GET['sort'] == "price_desc")
                            {
                                $sort_field = "price";
                                $sort_option = "DESC";
                            }elseif($_GET['sort'] == "year_asc")
                            {
                                $sort_field = "year";
                                $sort_option = "ASC";
                            }elseif($_GET['sort'] == "year_desc")
                            {
                                $sort_field = "year";
                                $sort_option = "DESC";
                            }
                        }

                        if(!empty($_GET['brands']) or !empty($_GET['type'])) 
                        {
                            if(!empty($_GET['brands']) AND empty($_GET['type'])) 
                            {
                               
                                if(isset($_GET['brands']) or isset($_GET['search']) or isset($_GET['sort']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['brands'];
                                $filtervalues = $_GET['search'];
                               
                                foreach($branchecked as $rowbrand)
                                {
                                    // echo $rowbrand;
                                    $items = "SELECT * FROM item WHERE model_name LIKE '%$filtervalues%' 
                                                        AND serial_no IN(
                                                            SELECT 
                                                            serial_no FROM item WHERE serial_no IN 
                                                                    (select serial_no from branded where brand_id = $rowbrand) 
                                                            ) ORDER BY  $sort_field $sort_option";
                                    $items_run = mysqli_query($con, $items);
                                   
                                    if(mysqli_num_rows($items_run) > 0)
                                    {
                                        foreach($items_run as $items) :
                                            ?>
                                                <div class="col-md-4 mt-3">
                                                            <div class="border p-2">
                                                            
                                                            <h6><?= $items['model_name']; ?> (<?= $items['year']; ?>)</h6>
                                                            <div><a href="./carmodel.php?data=<?php $items['serial_no']; ?>"><img src="<?= $items['image']; ?>.png" alt="Car Model Image"></a></div>
                                                            <h6><?= $items['price']; ?>
                                                            </div>
                                                </div>
                                            <?php
                                        endforeach;
                                    }
                                }
                            }
                            }else if(empty($_GET['brands']) AND !empty($_GET['type']))
                            {
                                
                                if(isset($_GET['type']) or isset($_GET['search']) or isset($_GET['sort']))
                            {
                                $typechecked = [];
                                $typechecked = $_GET['type'];
                                $filtervalues = $_GET['search'];
                                
                                foreach($typechecked as $rowtype)
                                {
                                    $items = "SELECT * FROM item WHERE model_name LIKE '%$filtervalues%' 
                                                        AND serial_no IN(
                                                            SELECT 
                                                            serial_no FROM item WHERE serial_no IN 
                                                                    (select serial_no from categorized where type_id = $rowtype) 
                                                            ) ORDER BY  $sort_field $sort_option";
                                    $items_run = mysqli_query($con, $items);
                                    if(mysqli_num_rows($items_run) > 0)
                                    {
                                        foreach($items_run as $items) :
                                            ?>
                                                <div class="col-md-4 mt-3">
                                                            <div class="border p-2">
                                                            <h6><?= $items['model_name']; ?> (<?= $items['year']; ?>)</h6>
                                                            <div><a href="./carmodel.php? data=<?= $items['serial_no']; ?>"><img src="<?= $items['image']; ?>.png" alt="Car Model Image"></a></div>
                                                            <h6><?= $items['price']; ?>
                                                            </div>
                                                </div>
                                            <?php
                                        endforeach;
                                    }
                                }
                            }
                            }else{
                                if(isset($_GET['brands']) OR isset($_GET['type']) OR isset($_GET['search']) or isset($_GET['sort']))
                                {
    
                                    $branchecked = [];
                                    $branchecked = $_GET['brands'];
                                    $typechecked = [];
                                    $typechecked = $_GET['type'];
                                    $storedata = [];
                                    $filtervalues = $_GET['search'];
                                   
                                    
                                    foreach($branchecked as $rowbrand)
                                    {
                                        foreach($typechecked as $rowtype)
                                        {
                                       
                                         $items = "SELECT * FROM item WHERE model_name LIKE '%$filtervalues%' 
                                                        AND serial_no  IN(
                                                            SELECT 
                                                            serial_no FROM item WHERE serial_no IN 
                                                                    (select serial_no from branded where brand_id = $rowbrand) 
                                                            OR
                                                            serial_no IN 
                                                                    (select serial_no from categorized where type_id = $rowtype)
                                                                        )";
                                         
                                         $items_run = mysqli_query($con, $items);
                                       
                                            if(mysqli_num_rows($items_run) > 0)
                                            {
                                                foreach($items_run as $proditems):
                                                    $storedata[] = $proditems['serial_no'];
                                                
                                                endforeach;
                                            }
                                        }
                                    }
                                    
                                    foreach(array_unique( $storedata) as $proditems) :
                                            $items = "SELECT * FROM item WHERE serial_no = $proditems";
                                            $items_run = mysqli_query($con, $items);
                                            if(mysqli_num_rows($items_run) > 0)
                                            {
                                                    foreach($items_run as $proditems) :
                                                    $storedata[] = $proditems['serial_no'];
                                                   
                                                    ?>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="border p-2">
                                                            
                                                              
                                                               <!--<h6><?= "brand:";?><?= $rowbrand; ?></h6>
                                                                <h6><?= "type:"; ?><?= $rowtype; ?></h6>-->
                                                                <div><a href="./carmodel.php? data=<?= $proditems['serial_no']; ?>"><img src="<?= $proditems['image']; ?>.png" alt="Car Model Image"></a></div>
                                                                <div><img src="<?= $proditems['image']; ?>.png" alt="Car Model Image"></div>
                                                                <h6><?= $proditems['price']; ?>
                                                            </div>
                                                        </div>
                                                    <?php
                                                endforeach;
                                            }
                                    endforeach;
                                }
                            }
                            
                        }
                            
                            else
                            {
                                if(isset($_GET['search']) or isset($_GET['sort'])){
                                    $filtervalues = $_GET['search'];
                                    $items = "SELECT * FROM item WHERE model_name LIKE '%$filtervalues%'  ORDER BY  $sort_field $sort_option";
                                    $items_run = mysqli_query($con, $items);
                                    if(mysqli_num_rows($items_run) > 0)
                                    {
                                        foreach($items_run as $proditems) :
                                            ?>
                                                <div class="col-md-4 mt-3">
                                                    <div class="border p-2">
                                                    <h6><?= $proditems['model_name']; ?> (<?= $proditems['year']; ?>)</h6>
                                                    <div><a href="./carmodel.php? data=<?= $proditems['serial_no']; ?>"><img src="<?= $proditems['image']; ?>.png" alt="Car Model Image"></a></div>
                                                    <h6><?= $proditems['price']; ?>
                                                    </div>
                                                </div>
                                            <?php
                                        endforeach;
                                    }
                                    else
                                    {
                                        echo "No Items Found";
                                    }
                                }else{
                                    $items = "SELECT * FROM item";
                                $items_run = mysqli_query($con, $items);
                                if(mysqli_num_rows($items_run) > 0)
                                {
                                    foreach($items_run as $proditems) :
                                        ?>
                                            <div class="col-md-4 mt-3"> 
                                                <div class="border p-2">
                                                <h6><?= $proditems['model_name']; ?> (<?= $proditems['year']; ?>)</h6>
                                                <div><a href="./carmodel.php? data=<?= $proditems['serial_no']; ?>"><img src="<?= $proditems['image']; ?>.png" alt="Car Model Image"></a></div>
                                                <h6><?= $proditems['price']; ?>
                                                
                                                </div>
                                            </div>
                                        <?php
                                    endforeach;
                                }
                                }
                                
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
     
     </div>
   

  <?php require('./inc/footer.html'); ?>
  <style>
    img{
        max-width: 100%;
        max-height: 100%;
        display: block; /* remove extra space below image */
    }
    .box{
        width: 250px;        
        border: 5px solid black;
    }    
    .box.large{
        height: 300px;
    }
    .box.small{
        height: 100px;
    }
</style>