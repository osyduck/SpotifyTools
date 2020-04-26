<?php
error_reporting(1);
require 'agent.php';

date_default_timezone_set('Asia/Jakarta');
echo "===============================================\n";
echo "           Spotify Account Creator  \n"; 
echo "               Github : Zeldriss    	\n";
echo "================================================\n";
echo "[+] Email : ";
$mail = trim(fgets(STDIN));
echo "[+] Password : ";
$pass = trim(fgets(STDIN));
echo "[+] Jumlah : ";
$jmlh = trim(fgets(STDIN));

for ($i = 0; $i < $jmlh ; $i++) {
	$ch = curl_init();
$email = $i.$mail."@gmail.com";
curl_setopt($ch, CURLOPT_URL, 'https://spclient.wg.spotify.com/signup/public/v1/account/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$email&password_repeat=$pass&password=$pass&key=142b583129b2df829de3656f9eb484e6&gender=male&platform=Android-ARM&creation_point=client_mobile&birth_day=12&birth_month=5&iagree=true&app_version=849800892&birth_year=1990&displayname=$name");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'User-Agent: '.$browser.'';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
$headers[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Cookie: sp_t=8f706ed1-82bb-4c42-8e00-b4cdcc0d26cc; sp_ab=%7B%222019_04_premium_menu%22%3A%22control%22%7D; spot=%7B%22t%22%3A1578755011%2C%22m%22%3A%22id%22%2C%22p%22%3Anull%7D; _gcl_au=1.1.2051991282.1578755951; _ga=GA1.1.1742774732.1578755952; _ga_0KW7E1R008=GS1.1.1578758236.2.0.1578758236.0; sp_adid=c642ad83-d54f-4b3e-9faf-67fb8243a24c; _derived_epik=dj0yJnU9RnJLZEtNRXplbEpMMFJwR01Ib2tYRGlBU3VKXzlVSVcmbj1VY01kSFk1QXFtYVFYSUotWVltdGhnJm09MSZ0PUFBQUFBRjRaNklzJnJtPTEmcnQ9QUFBQUFGNFo2SXM; _fbp=fb.1.1578755965827.1303124; _hjid=d13dfd8c-cb3f-40d2-a79b-d4f75f9da649; sp_dc=AQCgPuIra3SYcbfcg0w_DszveavEgJakOzN3YCszU7QTEfVUSOQmLKSqx1XS_DqNTqDc7FHfJ8p7mf2OPmrmd5ihxv-Hqcw_BxQfRiXh9Zo; sp_key=bad1f6e6-d1f7-4987-9d52-ad0f5ce8a00c; sp_phash=7d436328e5f5d4cbf930b1a209080006622fe27b; sp_gaid=0088fcf706dabb0503801c29277dbd79eb28da2769b8697d665a3c; _gaexp=GAX1.2.0cVDY3MuSLq08u7YwAeqBA.18364.2';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'Cache-Control: max-age=0, no-cache';
$headers[] = 'Te: Trailers';
$headers[] = 'Pragma: no-cache';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$json = json_decode($result);
if ($json->status == "20") {
	$msg = $json->errors->email;
	echo " $email $name=> $msg \n";
}else {
	if ($json->status == 1) {
		$date = date("D-M-Y h:i:s");
		echo "[-] Email: $email Pass: $pass => success \n";
		fwrite(fopen("spotify.txt", "a"), "$email|$pass\n");
	}
}
}

?>
