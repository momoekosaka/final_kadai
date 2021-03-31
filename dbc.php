<?php
function dbc()
{
    $host ="localhost";
    $dbname = "f_db";
    $user = "root";
    $pass ="root";
    $dns = "mysql:host=$host;
    dbname=$dbname;charset=utf8";
    $dbh = new PDO($dns, $user, $pass);
    // var_dump($dbh);
    try{
        $pdo = new PDO($dns, $user, $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
            // echo "成功";
            return $pdo;
    }catch(PDOException $e){
        exit('DbConnectError:'.$e->getMessage());
    }
}
// ファイルデータを保存
// @parem string $filename ファイル名
// @parem string $save_path 保存先のパス
// @parem string $caption 投稿の説明
// @return bool  $result
// データ登録sql作成
function fileSave($filename,$save_path,$caption)
{
    $result = False;
    $sql = "INSERT INTO file_table (file_name, file_path,
    description ) VALUE (?,?,?)";
    try{
    $stmt = dbc()->prepare($sql);
    $stmt->bindValue(1,$filename);
    $stmt->bindValue(2,$save_path);
    $stmt->bindValue(3,$caption);
    $result = $stmt->execute();
    return $result;
    } catch(\Exception $e) {
        echo $e->getMessage();
    }
}

// ファイルデータを取得
// 　return array　// $fileData
// データ登録sql作成
function getAllFile()
{
    $sql = "SELECT * FROM file_table";

    $fileData  = dbc()->query($sql);

    return $fileData;
}

getAllFile();
