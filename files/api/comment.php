<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/yazilar.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Yazilar($db);

    $data = json_decode(file_get_contents("php://input"));

    if(empty($data)){
        echo "Post verisi gönderilmedi.";
        exit;
    }

    if(!empty($data->email) && !empty($data->yorum) && !empty($data->hangiposta)){

    $item->email = $data->email;
    $item->yorum = $data->yorum;
    $item->hangiposta = $data->hangiposta;
    
    if($item->yorumYap()){
        echo 'Yorum eklendi.';
    } else{
        echo 'Yorum eklenemedi.';
    }

} else {
    echo "Eksik post verisi gönderildi.";
}
?>