<?php

// スタッフデータ新規登録
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
        return false;
    }
}

// スタッフデータ一覧読み込み
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
        return false;
    }
}

//1件のデータ呼び出し
function targetStaffCsv($id){
    // CSVファイルのパス
    $csvFilePath = 'csv/staff.csv';

    // ファイルを読み込む
    $file = fopen($csvFilePath, 'r');
    if ($file) {
        while (($row = fgetcsv($file)) !== false) {
            if ($row[0] == $id) {
                // 目的の行のデータを取得
                $targetStaffData = $row;
                break;
            }
        }
        fclose($file);

        if (isset($targetStaffData)) {
            // $targetRowDataに目的の行のデータが格納されています
            return $targetStaffData;
        } else {
            echo "指定した行が見つかりませんでした。";
            return false;
        }
    } else {
        echo "ファイルを開けませんでした。";
        return false;
    }

}




// $s[] = targetStaffCsv(2);
// foreach($s as $data){
//     echo ($data[0].$data[1].$data[2].$data[3]);
// }

// $staffData[] = allStaffCsv();
// foreach($staffData as $row){
//     foreach($row as $data){
//         echo("ID: ". $data[0] . "\t" . "名前: " . $data[1] . "\t" . "性別: " . $data[2] . "\t" . "階級: " . $data[3]."\n");
//     }
// }

