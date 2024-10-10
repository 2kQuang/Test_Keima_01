<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="form-login w-50 mx-auto mt-5">
      <form class="js-form-login" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Tài khoản</label>
          <input type="text" class="form-control user" id="name" placeholder="Tài khoản:">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control password" id="password" placeholder="Password">
        </div>
        <div class="message py-3"></div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="../assets/app.js"></script>
</body>
</body>

</html>