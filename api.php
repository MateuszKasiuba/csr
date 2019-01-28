<?php
include "config.php";
include "curl-exec.php";

$dn = array(
    "countryName" => "",
    "stateOrProvinceName" => "",
    "localityName" => "",
    "organizationName" => "",
    "organizationalUnitName" => "",
    "commonName" => "",
    "emailAddress" => ""
);

if (isset($_POST["countryName"]))
    $dn["countryName"] = $_POST["countryName"];
if (isset($_POST["stateOrProvinceName"]))
    $dn["stateOrProvinceName"] = $_POST["stateOrProvinceName"];
if (isset($_POST["localityName"]))
    $dn["localityName"] = $_POST["localityName"];
if (isset($_POST["organizationName"]))
    $dn["organizationName"] = $_POST["organizationName"];
if (isset($_POST["organizationalUnitName"]))
    $dn["organizationalUnitName"] = $_POST["organizationalUnitName"];
if (isset($_POST["commonName"]))
    $dn["commonName"] = $_POST["commonName"];
if (isset($_POST["emailAddress"]))
    $dn["emailAddress"] = $_POST["emailAddress"];

//if empty string is not in array
//then valid to generate csr

if (!in_array("", $dn)) {
    // Generate a new private key
    $privkey = openssl_pkey_new($openssl_config);

}
// Get private key value
$privkey = openssl_pkey_export($privkey, $privkey_out);


// Generate a certificate signing request
$csr = openssl_csr_new($dn, $privkey, $openssl_config);

// Get csr value
openssl_csr_export($csr, $csr_out);


$arr = array('status' => $status, 'private_key' => $privkey_out, 'csr' => $csr_out);

// Output Json
echo json_encode($arr);

