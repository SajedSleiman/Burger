<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Products</title>
   <link rel="stylesheet" href="../admin_styles.css">
   <script src="../js/jquery-3.1.1.js" type="text/javascript"> </script> 
   <script src="../js/jquery.js"></script>
   <script src="../js/myscript.js"></script> 
</head>
<body>
   <?php include '../components/admin_header.php';?>
   <section class="add-products">
      <form enctype="multipart/form-data">
         <h3>Add Product</h3>
         <input type="text" name="name" class="box" placeholder="Enter Product Name" required id="name"><p></p>
         <input type="text" name="discreption" id="discreption" class="box" placeholder="Enter Product Description" required><p></p>
         <input type="number" name="price" id="price" class="box" placeholder="Enter Product Price" required><p></p>
         <input type="file" name="img" id="img" class="box" accept="image/*" required><p></p>
        <input type="submit" id="insert" class="btn"><p></p>
      </form>
   </section>
   <div id="userTable"></div>
   <script src="../js/jquery-3.1.1.js"></script>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        showproducts();

        $(document).on('submit', 'form', function(e){
            e.preventDefault();

            if ($('#name').val()=="" || $('#discreption').val()=="" || $('#price').val()=="" || $('#img').val()==""){
                alert('Please input data first');
            } else {
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "insert_products.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        alert(response);
                        $('#name').val("");
                        $('#discreption').val("");
                        $('#price').val("");
                        $('#img').val("");
                        showproducts();
                    }
                });
            }
        });
        
        $(document).on('click', '.delete', function(){
            var name = $(this).val();
            $.ajax({
                type: "POST",
                url: "delet_products.php",
                data: { name: name },
                success: function(response){
                    alert(response);
                    showproducts();
                }
            });
        });
        
        $(document).on('click', '.edit', function(){
            var code = $(this).val();    
            var description = $('#discreption').val();
            $.ajax({
                type: "POST",
                url: "edit_products.php",
                data: { name: name, discreption: discreption,price:price,img:img, edit: 1 },
                success: function(){
                    
					$('#price').val()="";
                    showproducts();
                }
            });
        });
    });
    
    function showproducts(){
        $.ajax({
            url: 'show_products.php',
            type: 'POST',
            data: { show: 1 },
            success: function(response){
                $('#userTable').html(response);
            }
        });
    }
</script>
</html>
