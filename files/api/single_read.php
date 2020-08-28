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

    $item->id = isset($_GET['id']) ? $_GET['id'] : die("ID verisi boş.");
  
    // Böyle bir gönderi var mı kontrol edelim

    $stmt=$db->prepare("SELECT baslik FROM yazilar WHERE id = '$item->id'");
    $stmt->execute();
    $varmi = $stmt->rowCount(); 

    // Kontrol bitişi

    if($varmi == 0){
        echo "Post ID geçersiz.";
        exit;
    }

    // Class dosyamızdan fonksiyonu çağırarak güncelleme işlemini yapalım

    $item->tekYaziGetir();

    if($item->baslik != null){
        // diziye atayalım
        $emp_arr = array(
            "id" =>  $item->id,
            "baslik" => $item->baslik,
            "icerik" => $item->icerik,
            "tarih" => $item->tarih
        );
      
        http_response_code(200);
        echo json_encode($emp_arr, JSON_UNESCAPED_UNICODE);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Yazı bulunamadı.", JSON_UNESCAPED_UNICODE);
    }

?>