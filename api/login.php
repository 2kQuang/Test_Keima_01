<?php

session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include "../DB/data.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['user'];
  $password = $_POST['password'];
  $status = false;

  foreach ($data as $key => $item) {

    if ($user === $item['user'] && md5($password) === $item['password']) {

      $status = true;
      $index = $key;
      break;

    }
  }

  if ($status) {

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $time = date('Y-m-d H:i:s');
    $data[$index]['login_time'] = $time;
    $data[$index]['ip_address'] = $ip_address;
    $content = '<?php $data = ' . var_export($data, true) . ';';
    file_put_contents('../DB/data.php', $content);

    if ($data[$index]['role'] === "admin") {

      if (!isset($_SESSION['login_admin'])) {
        $_SESSION['login_admin'] = [];
      }

      $_SESSION['login_admin'] = [
        'index' => $index,
        'user' => $data[$index]['user'],
        'fullname' => $data[$index]['fullname'],
        'login_time' => $data[$index]['login_time'],
        'logout_time' => $data[$index]['logout_time'],
        'role' => $data[$index]['role'],
      ];

      echo json_encode(['success' => true, 'message' => 'Đăng nhập thành công!', 'redirect' => 'admin.php']);

    } else {

      if (!isset($_SESSION['login_user'])) {
        $_SESSION['login_user'] = [];
      }

      $_SESSION['login_user'] = [
        'index' => $index,
        'user' => $data[$index]['user'],
        'fullname' => $data[$index]['fullname'],
        'login_time' => $data[$index]['login_time'],
        'logout_time' => $data[$index]['logout_time'],
        'role' => $data[$index]['role'],
      ];

      echo json_encode(['success' => true, 'message' => 'Đăng nhập thành công!', 'redirect' => 'home.php']);

    }

  } else {
    echo json_encode(['success' => false, 'message' => 'Đăng nhập thất bại!']);
  }
}
