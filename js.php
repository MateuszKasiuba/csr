<script>
    function ModalActive(title, body) {
        $("#myModal .modal-title").html(title);
        $("#myModal .modal-body").html(body);
        $("#myModal").modal();
    }
    function UrlProcessing(url){
        var commonName = url;
        if(commonName.substring(0,7)=="http://"){
            commonName = commonName.substring(7);
        }
        if(commonName.substring(0,8)=="https://"){
            commonName = commonName.substring(8);
        }
        if(commonName.substring(0,4)=="www."){
            commonName = commonName.substring(4);
        }
        return commonName;
    }
    $('button#Submit').on('click',function(){
        $(this).attr('disabled', 'disabled');
        var commonName = $('input#commonName').val();
        var organizationName = $('input#organizationName').val();
        var organizationalUnitName = $('input#organizationalUnitName').val();
        var localityName = $('input#localityName').val();
        var stateOrProvinceName = $('input#stateOrProvinceName').val();
        var emailAddress = $('input#emailAddress').val();
        var countryName = $('select#countryName').val();
        // check if all exist
        if(!commonName || !organizationName || !organizationalUnitName || !localityName || !stateOrProvinceName || !emailAddress || !countryName ){
            var header_string = "Some required fields are empty";
            var body_string = "<p>Invalid Input!</p>";
            ModalActive(header_string,body_string);
        }
        else{
            // take away protocol and www
            commonName = UrlProcessing(commonName);
            // call api to do thing
            $.post('api.php',{
                commonName: commonName,
                organizationName: organizationName,
                organizationalUnitName: organizationalUnitName,
                localityName: localityName,
                stateOrProvinceName: stateOrProvinceName,
                emailAddress: emailAddress,
                countryName: countryName
            }, function(data){
                // check if blank
                ModalActive("Good job!", data.csr);
            }, 'json').fail(function(message) {
                ModalActive("ERROR", message.responseJSON[0]);
            });
        }
        $(this).removeAttr("disabled");
    });
</script>