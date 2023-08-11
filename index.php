<?php

// 書き込むデータの配列
$data = array(
    array('John Doe', 'john@example.com'),
    array('Jane Smith', 'jane@example.com'),
    array('Bob Johnson', 'bob@example.com')
);

// 書き込むCSVファイルのパス
$csvFilePath = 'csv/staff.csv';

// ファイルを開いて書き込む
$file = fopen($csvFilePath, 'w');
foreach ($data as $row) {
    fputcsv($file, $row);
}
fclose($file);

echo "CSVファイルに書き込みが完了しました。";
?>
