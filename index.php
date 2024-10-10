<?php
if (!isset($_GET['page'])) {
  header('Location:views/index.php');
} else {
  if ($_GET['page'] == 'list') {
    header('Location:views/list.php');
  }
  if ($_GET['page'] == 'login') {
    header('Location:views/login.php');
  }
}