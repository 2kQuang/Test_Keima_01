<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
include "../DB/data.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $role = $_POST['role'];

  if ($role === "admin") {
    if (isset($_SESSION['login_admin'])) {
      $index = $_SESSION['login_admin']['index'];

      $time = date('Y-m-d H:i:s');
      $data[$index]['logout_time'] = $time;
      $content = '<?php $data = ' . var_export($data, true) . ';';
      file_put_contents('../DB/data.php', $content);
      unset($_SESSION['login_admin']);
      echo json_encode(['success' => true, 'message' => 'Đăng Xuất thành công!', 'redirect' => 'login.php']);
    }
  }else{
    if (isset($_SESSION['login_user'])) {
      $index = $_SESSION['login_user']['index'];

      $time = date('Y-m-d H:i:s');
      $data[$index]['logout_time'] = $time;
      $content = '<?php $data = ' . var_export($data, true) . ';';
      file_put_contents('../DB/data.php', $content);
      unset($_SESSION['login_user']);
      echo json_encode(['success' => true, 'message' => 'Đăng Xuất thành công!', 'redirect' => 'login.php']);
    }
  }
}