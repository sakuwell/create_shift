<?php
writeStaffCsv(7,"櫻井大樹",1,3);

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
            $data = array($id, $name, $sex, $position);
            fputcsv($file, $data);
            echo "新規登録が完了しました";
        }
        fclose($file);
    } else {
        echo "ファイルを開けませんでした。";
    }
}
?>







    
