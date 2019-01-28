
<?php


//next example will insert new conversation
$service_url = 'https://vault-tech.omarsys.inet:8200/v1/secret_v2/data/test.com';
$curl = curl_init($service_url);
$curl_post_data = array(
    'priv_key' => $privkey,
    'csr' => $csr,

);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
var_export($decoded->response);



