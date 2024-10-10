<?php
$data_file = '../DB/data.csv';
$data = [];
$status = false;

$key = isset($_GET['key']) ? $_GET['key'] : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$check = trim($key);
if (empty($check) || $key == null) {
  $status = false;
} else {
  $status = true;

  if (($handle = fopen($data_file, 'r')) !== false) {
    $header = fgetcsv($handle);

    while (($row = fgetcsv($handle)) !== false) {
      $data[] = array_combine($header, $row);
    }
    fclose($handle);
  }
  $data_new = array_filter($data, function ($row) use ($key) {
    return stripos($row['name'], $key) !== false;
  });

  $totalProduct = count($data_new);
  usort($data_new, function ($a, $b) {
    return $b['id'] <=> $a['id'];
  });
  $limit = 3;
  $offset = ($page - 1) * $limit;
  $current_data = array_slice($data_new, $offset, $limit);
  $itemPagination = ceil($totalProduct / 3);

}

?>
<?php if ($status) { ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Tên</th>
        <th scope="col">Số lượng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($current_data as $k => $v) { ?>
        <tr>
          <td><?= $v['id'] ?></td>
          <td><?= $v['name'] ?></td>
          <td><?= $v['quantity'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <div class="pagination" class="mt-3">
    <?php for ($i = 1; $i < $itemPagination + 1; $i++) { ?>
      <a class="js-button-paginationSearch btn btn-link <?= ($i == $page) ? "btn-success text-white" : "" ?>"
        data-page="<?= $i ?>" data-key="<?= $key ?>"><?= $i ?></a>
    <?php } ?>
  </div>
<?php } else { ?>
  <p class="text-success">Nhập dữ liệu</p>
<?php } ?>