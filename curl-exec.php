<?php
function sendToVault($csr, $privkey) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://vault-tech.omarsys.inet:8200/v1/secret_v2/data/test2.com');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    $headers = array();
    $headers[] = 'X-Vault-Token: 573e0470-63c5-8ddc-6f76-a1367249231d';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'data' => [
            'csr' => $csr,
            'key' => $privkey
        ]
    ]));

    $result = curl_exec($ch);
    if (!$result) {
        throw new Exception('Error:' . curl_error($ch));
    }
    curl_close ($ch);
}


