<?php
    require("db/config.php");
    if(isset($_POST["re"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $us = $_POST["us"];
        $pa = sha1($_POST["pa"]);
        $sql_check = "select * from tbl_user where user_name = '$us'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Tên đăng nhập đã tồn tại')</script>";
        }
        else{
            $sql_check = "select * from tbl_user where email = '$email'";
            $result = mysqli_query($conn, $sql_check);
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Email đã được đăng ký trên tài khoản khác')</script>";
            }
            else{
                $sql = "INSERT INTO tbl_user (name, email, phone, user_name, password)
                VALUES (N'$name', '$email','$phone','$us','$pa')";

                if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Đăng ký thành công')</script>";
                } 
                else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
        <script>
            function check_pass(){
                var pa1 = document.getElementById("pa1").value;
                var pa2 = document.getElementById("pa2").value;
                if(pa1!=pa2){
                    document.getElementById("check").innerHTML = "Mật khẩu chưa khớp";
                }
                else{
                    document.getElementById("check").innerHTML = "";
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <form action="re.php" class="col-6" method="post">
                    <h3 style="text-align:center">Trang dang ky thanh vien</h3>
                    Nhap vao ho ten:
                    <input class="form-control" type="text" name="name" id="" required value="<?php if(isset($_POST['name']) && $_POST['name'] != NULL){ echo $_POST['name']; } ?>">
                    Nhap vao email:
                    <input class="form-control" type="email" name="email" id="" require value="<?php if(isset($_POST['email']) && $_POST['email'] != NULL){ echo $_POST['email']; } ?>">
                    Nhap vao so dien thoai:
                    <input class="form-control" type="number" name="phone" id="" required value="<?php if(isset($_POST['phone']) && $_POST['phone'] != NULL){ echo $_POST['phone']; } ?>">
                    Nhap vao ten dang nhap:
                    <input class="form-control" type="text" name="us" id="" required value="<?php if(isset($_POST['us']) && $_POST['us'] != NULL){ echo $_POST['us']; } ?>">

                    Nhap vao mat khau:
                    <input class="form-control" type="password" name="pa" minlength="8" id="pa1" required value="<?php if(isset($_POST['pa']) && $_POST['pa'] != NULL){ echo $_POST['pa']; } ?>">
                    <button class="btn btn-outline-secondary" type="button" id="btnPassword1">
                        <span class="fas fa-eye"></span>
                    </button>
                    <br>
                    Nhap lai mat khau:
                    <input onkeyup="check_pass();" class="form-control" minlength="8" type="password" name="pa2" id="pa2" required value="<?php if(isset($_POST['pa2']) && $_POST['pa2'] != NULL){ echo $_POST['pa2']; } ?>">
                    <button class="btn btn-outline-secondary" type="button" id="btnPassword2">
                        <span class="fas fa-eye"></span>
                    </button>
                    <br>
                    <span id="check"></span>
                    <br>
                    <input class="btn btn-danger" type="submit" value="Dang ky" name ="re">
                </form>
            </div>
        </div>
        
    </body>
</html>
<script>
    const ipnElement = document.querySelector('#pa1')
    const btnElement = document.querySelector('#btnPassword1')
    btnElement.addEventListener('click', function() {
        console.log("Vừa click vào ẩn hiên mk 1")
        const currentType = ipnElement.getAttribute('type')
        ipnElement.setAttribute('type',currentType === 'password' ? 'text' : 'password')
    })
</script>