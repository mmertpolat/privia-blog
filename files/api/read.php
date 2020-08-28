<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/yazilar.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Yazilar($db);

    $stmt = $items->yazilariGetir();
    $iceriksay = $stmt->rowCount();

    if($iceriksay > 0){
        
        $postArray = array();
        $postArray["body"] = array();
        $postArray["count"] = $iceriksay;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "baslik" => $baslik,
                "icerik" => $icerik,
                "tarih" => $tarih,
            );

            array_push($postArray["body"], $e);
        }
        echo json_encode($postArray, JSON_UNESCAPED_UNICODE);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Herhangi bir yazı bulunamadı.")
        );
    }
?>