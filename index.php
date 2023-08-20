<?php

// スタッフデータ新規登録
function registerNewStaff($id, $name, $sex, $position){
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
function readAllStaffData(){
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

//1件のスタッフデータ呼び出し
function readTargetStaffData($id){
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

// スタッフデータの編集
function editStaffData($newData){
    // CSVファイルのパス
    $csvFilePath = 'csv/staff.csv';

    // ファイルを読み込みモードで開く
    $file = fopen($csvFilePath, 'r');
    if ($file) {
        $rows = array();
        while (($row = fgetcsv($file)) !== false) {
            $rows[] = $row;
        }
        fclose($file);

        // IDを基に行を探して編集
        $found = false;
        foreach ($rows as $row) {
            if ($row[0] == $newData[0]) { // 仮定: IDは行の最初の列にあるとする
                $row = $newData;
                $found = true;
                break;
            }
        }
        // var_dump($rows);

        if ($found) {
            // ファイルを書き込みモードで開いてデータを書き込む
            $file = fopen($csvFilePath, 'w');
            foreach ($rows as $row) {
                fputcsv($file, $row);
                // var_dump ($row);
            }
            fclose($file);

            echo "ID $newData[0] の情報を編集しました。";
        } else {
            echo "指定したIDが見つかりませんでした。";
        }
    } else {
        echo "ファイルを開けませんでした。";
    }
}

// スタッフデータの削除
function deleteStaffData($id){

}

$editData = ["5","櫻井幸助","1","4"];
editStaffData($editData);

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

