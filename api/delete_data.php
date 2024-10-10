<?php
$data_file = '../DB/data.csv';
$data = [];

$id = $_GET['id'];

if (($handle = fopen($data_file, 'r')) !== false) {
  $header = fgetcsv($handle);

  while (($row = fgetcsv($handle)) !== false) {
    $data[] = array_combine($header, $row);
  }
  fclose($handle);
}

$data = array_filter($data, function($row) use ($id) {
  return $row['id'] != $id;
});

if (($handle = fopen($data_file, 'w')) !== false) {
  fputcsv($handle, $header);
  foreach ($data as $item) {
      fputcsv($handle, $item);
  }
  fclose($handle);
} 