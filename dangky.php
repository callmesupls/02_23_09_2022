<?php
    require("db/config.php");
    if(isset($_POST["re"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $us = $_POST["us"];
        $pa = $_POST["pa"];
        $sql_check = "select * from user where User_Name = '$us'";
        $result = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result) > 0) {
            echo "Ten dang nhap da ton tai, can nhap ten dang nhap moi";
        }
        else {
            $sql = "INSERT INTO user (Name, Email, Phone, User_Name,Pass_Word)
                VALUES (N'$name', '$email','$phone','$us','$pa')";

            if (mysqli_query($conn, $sql)) {
            echo "Dang ky thanh cong";
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
?>
<html>
    <head>
      <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   
</head>

    <body>
        <div class="container">
            <div class="row">
                <form action="re.php" class="col-6" method="post">
                    <h3 style="text-align:center">Trang dang ky thanh vien</h3>
                    Nhap vao ho ten:
                    <input class="form-control" type="text" name="name" id="" required> (*)
                    Nhap vao email:
                    <input class="form-control" type="email" name="email" id="" require>
                    Nhap vao so dien thoai:
                    <input class="form-control" type="number" name="phone" id="" required>
                    Nhap vao ten dang nhap:
                    <input class="form-control" type="text" name="us" id="" required>
                    Nhap vao mat khau:
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" id="ipnPassword" />
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btnPassword">
                        <span class="fas fa-eye"></span>
                        </button>
                       </div>
                     </div>
                     Nhap lai mat khau:
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" id="ipnPassword2" />
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btnPassword2">
                        <span class="fas fa-eye"></span>
                        </button>
                       </div>
                     </div>
                    <input class="btn btn-danger" type="submit" value="Dang ky" name ="re">
                </form>
            </div>
        </div>
        
    </body>
    <script>
 // step 1
const ipnElement = document.querySelector('#ipnPassword')
const btnElement = document.querySelector('#btnPassword')

// step 2
btnElement.addEventListener('click', function() {
  // step 3
  const currentType = ipnElement.getAttribute('type')
  // step 4
  ipnElement.setAttribute(
    'type',
    currentType === 'password' ? 'text' : 'password'
  )
}) 
 // step 1
 const ipnElement1 = document.querySelector('#ipnPassword2')
const btnElement1 = document.querySelector('#btnPassword2')

// step 2
btnElement1.addEventListener('click', function() {
  // step 3
  const currentType1 = ipnElement1.getAttribute('type')
  // step 4
  ipnElement1.setAttribute(
    'type',
    currentType1 === 'password' ? 'text' : 'password'
  )
}) </script>
</html>