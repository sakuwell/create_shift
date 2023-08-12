<?php

// スタッフ新規登録
function writeStaffCsv($id, $name, $sex, $position){
    $csvFilePath = 'csv/staff.csv';
    $file = fopen($csvFilePath, 'r');
    $existId = false;
    if ($file) {
        while (($row = fgetcsv($file)) !== false) {
            if($id == $row[0]) {
                echo "同じIDが存在します";
                $existId = true;
                break;
            }
        }
        if($existId == false){
            $file = fopen($csvFilePath, 'a');
            $data = [$id, $name, $sex, $position];
            fputcsv($file, $data);
            echo "新規登録が完了しました";
        }
        fclose($file);
    } else {
        echo "ファイルを開けませんでした。";
    }
}

// スタッフ一覧読み込み
function allStaffCsv(){
    $csvFilePath = 'csv/staff.csv';
    $file = fopen($csvFilePath, 'r');
    $staffData = [];
    if($file){
        while(($row = fgetcsv($file)) !== false){
            $row = [$row[0],$row[1],$row[2],$row[3]];
            $staffData[] = $row;
        }
        fclose($file);
        return $staffData;
    } else {
        echo "ファイルを開けませんでした。";
    }
}

$staffData[] = allStaffCsv();
foreach($staffData as $row){
    foreach($row as $data){
        echo("ID: ". $data[0] . "\t" . "名前: " . $data[1] . "\t" . "性別: " . $data[2] . "\t" . "階級: " . $data[3]."\n");
    }
}