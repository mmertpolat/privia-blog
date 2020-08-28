<?php 

// Gönderilecek POST verilerini belirleyelim

$data = array(
    'email' => 'muhammetmert.polat@gmail.com',
    'yorum' => 'bu yorum api ile yapıldı.',
    'hangiposta'   => 1
);
 
$payload = json_encode($data);
 
// cURL için hedef URL belirleyelim
$ch = curl_init('http://localhost/blog/api/comment.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 
// Request için header bilgisi ekleyelim
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload))
);
 
// İsteği gönderelim
$result = curl_exec($ch);

print_r($result);
 
// cURL kapatalım
curl_close($ch);

?>