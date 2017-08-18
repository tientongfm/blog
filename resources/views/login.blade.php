<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="container">

<h2 style="text-align:center;">Đăng nhập</h2>

<form action="login" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="menu">

    <label><b>Email</b></label>
    <input type="text" placeholder="Nhập Email" name="email" required>

    <label><b>Mật khẩu</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit">Đăng nhập</button>
    <input type="checkbox" checked="checked"> Remember me
  </div>

  <div class="menu" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Quên <a href="#">mật khẩu?</a></span>
  </div>
</form>
</div>

</body>
</html>
