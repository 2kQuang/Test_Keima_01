<?php
$data_file = '../DB/data.csv';
$data = [];

if (($handle = fopen($data_file, 'r')) !== false) {
  $header = fgetcsv($handle);

  while (($row = fgetcsv($handle)) !== false) {
    $data[] = array_combine($header, $row);
  }
  fclose($handle);
}

$totalProduct = count($data);

$limit = 3;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$current_data = array_slice($data, $offset, $limit);

$itemPagination = ceil($totalProduct / 3);

$start = ($page - 1) * $limit + 1;
$end = min($start + $limit - 1, 20);
?>

<div class="counter">Hiển thị từ <?= $start ?> - <?= $end ?> / <?= $totalProduct ?> sản phẩm</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Tên</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Chức năng</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($current_data as $k => $v) { ?>
      <tr>
        <td><?= $v['id'] ?></td>
        <td><?= $v['name'] ?></td>
        <td><?= $v['quantity'] ?></td>
        <td>
          <div class="btn btn-danger js-button-delete" data-id="<?= $v['id'] ?>" data-page="<?= $page ?>">Xoá</div>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<div class="pagination" class="mt-3">
  <?php for ($i = 1; $i < $itemPagination + 1; $i++) { ?>
    <a class="js-button-pagination btn btn-link <?= ($i == $page) ? "btn-success text-white" : "" ?>" data-page="<?= $i ?>"><?= $i ?></a>
  <?php } ?>
</div>