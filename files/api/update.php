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

    if(!empty($data->id) && !empty($data->baslik) && !empty($data->icerik) && !empty($data->tarih)){
    
    // Gönderi bilgileri
    $item->id = $data->id;
    $item->baslik = $data->baslik;
    $item->icerik = $data->icerik;
    $item->tarih = $data->tarih;

    // Böyle bir gönderi var mı kontrol edelim

    $stmt=$db->prepare("SELECT baslik FROM yazilar WHERE id = '$item->id'");
    $stmt->execute();
    $varmi = $stmt->rowCount();

    if($varmi == 0){
        echo "Post ID geçersiz.";
        exit;
    } 

    // Kontrol bitişi

    // Class dosyamızdan fonksiyonu çağırarak güncelleme işlemini yapalım
    
    if($item->yaziGuncelle()){
        echo json_encode("Yazı güncellendi.");
    } else{
        echo json_encode("Yazı güncellenemedi.");
    }
} else {
    echo "Eksik post verisi gönderildi.";
}
?>