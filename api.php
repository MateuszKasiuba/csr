<?php
include "config.php";

if (!($debug_mode)) {
    header('Content-Type: application/json');
}
$dn = array(
    "countryName" => "",
    "stateOrProvinceName" => "",
    "localityName" => "",
    "organizationName" => "",
    "organizationalUnitName" => "",
    "commonName" => "",
    "emailAddress" => ""
);
$status = 0;
// 0 -> failed to generate
// 1 -> failed to mail
// 2 -> success
if (isset($_GET["countryName"]))
    $dn["countryName"] = $_GET["countryName"];
if (isset($_GET["stateOrProvinceName"]))
    $dn["stateOrProvinceName"] = $_GET["stateOrProvinceName"];
if (isset($_GET["localityName"]))
    $dn["localityName"] = $_GET["localityName"];
if (isset($_GET["organizationName"]))
    $dn["organizationName"] = $_GET["organizationName"];
if (isset($_GET["organizationalUnitName"]))
    $dn["organizationalUnitName"] = $_GET["organizationalUnitName"];
if (isset($_GET["commonName"]))
    $dn["commonName"] = $_GET["commonName"];
if (isset($_GET["emailAddress"]))
    $dn["emailAddress"] = $_GET["emailAddress"];
//if empty string is not in array
//then valid to generate csr
if (!in_array("", $dn)) {
    // Generate a new private key
    $privkey = openssl_pkey_new($openssl_config);
    // Show any errors that occurred here


}
// Get private key value
openssl_pkey_export($privkey, $privkey_out);

// Generate a certificate signing request
$csr = openssl_csr_new($dn, $privkey, $openssl_config);
// Show any errors that occurred here
if ($debug_mode) {
    if (!($csr)) {
        while (($e = openssl_error_string()) !== false) {
            $e . "\n";
        }
        exit(-1);
    }
}
// Get csr value
openssl_csr_export($csr, $csr_out);






$arr = array('status' => $status, 'private_key' => $privkey_out, 'csr' => $csr_out);


// Output Json
echo json_encode($arr);

