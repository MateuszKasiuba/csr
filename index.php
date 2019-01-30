<?php
include 'config.php';
include 'country_code.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?> <?php echo $subtitle; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo $bootstrap_cdn; ?>/3.3.5/css/bootstrap.min.css">
    <script src="<?php echo $jquery_cdn; ?>/1.11.3/jquery.min.js"></script>
    <script src="<?php echo $bootstrap_cdn; ?>/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="include/custom.css">
</head>

<body>
<div class="container">
    <div class="page-header text-center">
        <h1><?php echo $title ?></h1>
    </div><!-- /page-header -->
</div><!-- /container -->

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3" role="main">
            <div class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="control-label col-sm-5 col-xs-5" for="commonName">Common Name:*</label>
                    <div class="col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="commonName" placeholder="example: omarsys.com(must be your domain name!)" required>


                        <html>


                        <body>

                        <div id="main">
                            <input type="button" id="btAdd" value="Add Element" class="bt" />
                            <input type="button" id="btRemove" value="Remove Element" class="bt" />
                        </div>
                        </body>

                        <script>
                            $(document).ready(function() {

                                var iCnt = 0;
                                // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
                                var container = $(document.createElement('div')).css({
                                    padding: '5px', margin: '20px', width: '170px', border: '1px dashed',
                                    borderTopColor: '#999', borderBottomColor: '#999',
                                    borderLeftColor: '#999', borderRightColor: '#999'
                                });

                                $('#btAdd').click(function() {
                                    if (iCnt <= 19) {

                                        iCnt = iCnt + 1;

                                        // ADD TEXTBOX.
                                        $(container).append('<input type=text class="input" id=tb' + iCnt + ' ' +
                                            'value="Text Element ' + iCnt + '" />');

                                        // SHOW SUBMIT BUTTON IF ATLEAST "1" ELEMENT HAS BEEN CREATED.
                                        if (iCnt == 1) {
                                            var divSubmit = $(document.createElement('div'));
                                            $(divSubmit).append('<input type=button class="bt"' +
                                                'onclick="GetTextValue()"' +
                                                'id=btSubmit value=Submit />');
                                        }

                                        // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                                        $('#main').after(container);
                                    }
                                    // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON.
                                    // (20 IS THE LIMIT WE HAVE SET)
                                    else {
                                        $(container).append('<label>Reached the limit</label>');
                                        $('#btAdd').attr('class', 'bt-disable');
                                        $('#btAdd').attr('disabled', 'disabled');
                                    }
                                });

                                // REMOVE ONE ELEMENT PER CLICK.
                                $('#btRemove').click(function() {
                                    if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }

                                    if (iCnt == 0) {
                                        $(container)
                                            .empty()
                                            .remove();


                                        $('#btAdd')
                                            .removeAttr('disabled')
                                            .attr('class', 'bt');
                                    }
                                });

                                });


                        </script>
                        </html>
                    </div>




                <div class="form-group">
                    <label class="control-label col-sm-5 col-xs-5" for="organizationName">Organization Name:*</label>
                    <div class="col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="organizationName" placeholder="example: XCaliber" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-xs-5" for="organizationalUnitName">Department:*</label>
                    <div class="col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="organizationalUnitName" placeholder="example: IT Dept" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-xs-5" for="localityName">City:*</label>
                    <div class="col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="localityName" placeholder="example: Valetta" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-xs-5" for="stateOrProvinceName">State:</label>
                    <div class="col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="stateOrProvinceName" placeholder="example: Valetta">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-xs-5" for="emailAddress">Email:*</label>
                    <div class="col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="emailAddress" placeholder="example: admin@xcaliber.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-5 col-xs-5" for="countryName">Country:*</label>
                    <div class="col-sm-7 col-xs-7">
                        <select class="form-control" id="countryName" required>
                            <?php foreach ($country as $key => $value) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php } ?>
                        </select>

                        <label class="control-label col-sm-150 col-xs-13" for="key_size">Key Size:*</label>
                        <input type="radio" name="key_value" value="zero">2048
                        <input type="radio" name="key_value" value="disable">4096

                    </div>
                </div>





                <div class="col-sm-30 col-sm-offset-4 col-xs-6 col-xs-offset-3">
                    <button class="btn btn-lg btn-primary btn-block" type="button" id="Submit">Generate CSR</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<?php include 'js.php'; ?>
</body>
</html>