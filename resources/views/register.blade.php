<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/styleregister.css">
</head>

<body>

<h2 style="text-align: center;">Đăng ký</h2>

<form action="register" style="border:1px solid #ccc" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="container">

    <label><b>Họ tên</b></label>
    <input type="text" placeholder="Nhập tên" name="name" required>

    <label><b>Email</b></label>
    <input type="text" placeholder="Nhập Email" name="email" required>

    <label><b>Mật khẩu</b></label>
    <input type="password" placeholder="Nhập mật khẩu" name="password" required>

    <label><b>Nhập lại mật khẩu</b></label>
    <input type="password" placeholder="Nhập lại mật khẩu" name="password-repeat" required>
    <input type="checkbox" checked="checked"> Remember me
    <p>Bạn đã có tài khoản? <a href="login">Đăng nhập</a> </p>
    <p>Bằng cách tạo một tài khoản bạn đồng ý với <a href="#">Điều khoản & Bảo mật </a>của chúng tôi.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Đăng ký</button>
    </div>
  </div>
</form>

</body>
</html>
