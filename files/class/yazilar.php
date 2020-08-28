<?php
    class Yazilar{

        // Veritabanı bağlantı
        private $conn;

        // Tabloya eriş
        private $db_table = "yazilar";

        // Sütunlar
        public $id;
        public $baslik;
        public $icerik;
        public $tarih;

        // Veritabanına bağlan
        public function __construct($db){
            $this->conn = $db;
        }

        // Tüm yazıları çek
        public function yazilariGetir(){
            $sqlQuery = "SELECT id, baslik, icerik, tarih FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // Yazı Oluştur
        public function yaziOlustur(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        baslik = :baslik, 
                        icerik = :icerik, 
                        tarih = :tarih";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            
            $this->baslik=htmlspecialchars(strip_tags($this->baslik));
            $this->icerik=htmlspecialchars(strip_tags($this->icerik));
            $this->tarih=htmlspecialchars(strip_tags($this->tarih));
        
            
            $stmt->bindParam(":baslik", $this->baslik);
            $stmt->bindParam(":icerik", $this->icerik);
            $stmt->bindParam(":tarih", $this->tarih);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Tekil yazı oku
        public function tekYaziGetir(){
            $sqlQuery = "SELECT
                        id, 
                        baslik, 
                        icerik, 
                        tarih
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            $this->baslik = $dataRow['baslik'];
            $this->icerik = $dataRow['icerik'];
            $this->tarih = $dataRow['tarih'];
        }        

        // Yazı Güncelle
        public function yaziGuncelle(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        baslik = :baslik, 
                        icerik = :icerik, 
                        tarih = :tarih
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->baslik=htmlspecialchars(strip_tags($this->baslik));
            $this->icerik=htmlspecialchars(strip_tags($this->icerik));
            $this->tarih=htmlspecialchars(strip_tags($this->tarih));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(":baslik", $this->baslik);
            $stmt->bindParam(":icerik", $this->icerik);
            $stmt->bindParam(":tarih", $this->tarih);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Yazı Sil
        function yaziSil(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // Yorum Yap
        public function yorumYap(){
            $sqlQuery = "INSERT INTO
                        yorumlar
                    SET
                        email = :email, 
                        yorum = :yorum, 
                        hangiposta = :hangiposta";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->yorum=htmlspecialchars(strip_tags($this->yorum));
            $this->hangiposta=htmlspecialchars(strip_tags($this->hangiposta));
        
            
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":yorum", $this->yorum);
            $stmt->bindParam(":hangiposta", $this->hangiposta);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Yorum sil
        public function yorumSil(){
            
            $sqlQuery = "DELETE FROM
                        yorumlar
                    WHERE
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

    }
?>