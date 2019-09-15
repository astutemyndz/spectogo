$(window).bind("load", function () {
    window.setTimeout(function () {
        $("#flashdata").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
});

function swal_success(txt) {
    swal({
        text: txt,
        type: "success",
        buttons: true,
        confirmButtonColor: "#48cab2",
        buttons: 'OK',
        closeModal: false
    });
}

function swal_success_then(txt, btn, url) {
    swal({
        title: "Success !!!",
        text: txt,
        type: "success",
        showCancelButton: false,
        confirmButtonColor: "#48cab2",
        confirmButtonText: btn,
        closeOnConfirm: false
    }).then(function () {
        window.location = url;
    });
}

function swal_confirm_then(txt, btn, url) {
    swal({
        title: "Confirmation",
        text: txt,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: btn,
        closeOnConfirm: false
    }).then(function () {
        window.location = url;
    });
}

function swal_warning(txt) {
    swal({
        text: txt,
        type: "warning",
        buttons: true,
        confirmButtonColor: "#DD6B55",
        buttons: 'OK',
        closeModal: false
    });
}

function common_form_checking(flag, msgbox = '') {
    $('.requiredCheck').each(function () {
        if ($.trim($(this).val()) == '') {
            var txt = $(this).attr('data-check') + ' is mandatory !!!';
            if (msgbox != '') {
                $("." + msgbox).text(txt);
            } else {
                swal_warning(txt);
            }
            flag = 'false';
            return false;
        } else {
            if ($(this).attr('data-check') == 'Email') {
                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                if (reg.test($.trim($(this).val())) == false) {
                    var txt = 'Enter valid Email address !!!';
                    if (msgbox != '') {
                        $("." + msgbox).text(txt);
                    } else {
                        swal_warning(txt);
                    }
                    flag = 'false';
                    return false;
                }
            }
            if ($(this).attr('data-check') == 'Phone') {
                if ($.trim($(this).val()).length != 10) {
                    var txt = 'Enter 10 digit phone number !!!';
                    if (msgbox != '') {
                        $("." + msgbox).text(txt);
                    } else {
                        swal_warning(txt);
                    }
                    flag = 'false';
                    return false;
                }
            }
            if ($(this).attr('data-check') == 'Zip') {
                if ($.trim($(this).val()).length != 6) {
                    var txt = 'Enter 6 digit Postcode !!!';
                    if (msgbox != '') {
                        $("." + msgbox).text(txt);
                    } else {
                        swal_warning(txt);
                    }
                    flag = 'false';
                    return false;
                }
            }
        }
    });
    return flag;
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        if (charCode == 43 || charCode == 45 || charCode == 46) {
            return true;
        }
        return false;
    }
    return true;
}

function isChar(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode >= 65 && charCode <= 122) || charCode == 32 || charCode == 0) {
        return true;
    }
    return false;
}

$(document).on('keyup', '.restrictSpecial', function () {
    var yourInput = $(this).val();
    var re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    var isSplChar = re.test(yourInput);
    if (isSplChar) {
        var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
        $(this).val(no_spl_char);
    }
});
$(document).on('click', '.change-status', function () {
    var module = this;
    var id = $(this).attr('id');
    var table = $(this).attr('data-table');
    var table = $(this).attr('data-table');
    if (id && table) {
        $.ajax({
            type: 'POST',
            url: base_url + $(this).attr('data-url'),
            data: {
                id: id,
                table: table
            },
            success: function (resultData) {
                $(module).html(resultData);
                swal_success("Status Successfully Changed !!!");
            }
        });
    }
});
$(document).on('keyup', '.chkPrice', function () {
    if ($('#productPrice').val() != '' && $('#productSellPrice').val() == '') {
        $('#productDiscount').val('0');
    } else if ($('#productPrice').val() == '' && $('#productSellPrice').val() != '') {
        $('#productDiscount').val('0');
    } else {
        if (parseFloat($('#productSellPrice').val()) > parseFloat($('#productPrice').val())) {
            swal_warning("Product Sell Price must be Less than or Equals to Product Price  !!!");
            $('#productSellPrice').val('0');
            $('#productDiscount').val('0');
        } else {
            $('#productDiscount').val((((parseFloat($('#productPrice').val()) - parseFloat($('#productSellPrice').val())) / parseFloat($('#productPrice').val())) * parseInt(100)).toFixed(2));
        }
    }
});

function delete_banner(id, image) {
    swal({
        title: "Confirmation",
        text: "Are you sure want to delete banner?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes !!!",
        closeOnConfirm: false
    }).then(function () {
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/delete-banner',
            data: {
                id: id,
                image: image
            },
            success: function (resultData) {
                $('.banner' + id).remove();
                swal_success("Banner Successfully Deleted !!!");
            }
        });
    });
}

function addImageRow() {
    $('.moreImgDiv').append('<div class="form-group more' + $('#imgCount').val() + '">\
                                <label for="lefticon" class="col-sm-2 control-label">Product Related Image </label>\
                                <div class="col-sm-9">\
                                    <span class="input-with-icon">\
                                        <input type="file" class="form-control" name="moreImage[]" aria-required="true">\
                                        <p>SIZE 250 X 70</p>\
                                    </span>\
                                </div>\
                                <div class="col-sm-1">\
                                    <button type="button" onclick="removeImageRow(\'' + $('#imgCount').val() + '\')" class="btn">Remove</button>\
                                </div>\
                            </div>');
    $('#imgCount').val(parseInt($('#imgCount').val()) + parseInt(1));
}

function removeImageRow(row) {
    $('.more' + row).remove();
}

function removeImage(id, img) {
    swal({
        title: "Confirmation",
        text: "Are you sure want to delete image?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes !!!",
        closeOnConfirm: false
    }).then(function () {
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/delete-rel-image',
            data: {
                id: id,
                image: img
            },
            success: function (resultData) {
                $('.relImg' + id).remove();
                var imgCnt = 0;
                $(".imgCnt").each(function () {
                    imgCnt++;
                });
                if (imgCnt == 0) {
                    $('.moreImgDiv').append('<div class="form-group">\
                                                <label for="lefticon" class="col-sm-2 control-label">Product Related Image </label>\
                                                <div class="col-sm-10">\
                                                    <span class="input-with-icon">\
                                                        <input type="file" class="form-control" name="moreImage[]" aria-required="true" required>\
                                                        <p>SIZE 250 X 70</p>\
                                                    </span>\
                                                </div>\
                                            </div>');
                }
                swal_success("Image Successfully Deleted !!!");
            }
        });
    });
}
$(document).on('change', '#oldAttributes', function () {
    if ($(this).val() != '') {
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/get-attribute-details',
            data: {
                atr_id: $(this).val()
            },
            success: function (resultData) {
                var res = resultData.split('~~');
                $('.atrDetDiv').html('');
                $('.atrDetDiv').html(res[0]);
                $('#productColor').val(res[1]);
                $('#productColor').css("background-color", "#" + res[1]);
                $('#old_productColor').val(res[1]);
                $('#product_attribute_id').val(res[2]);
            }
        });
    } else {
        $('.atrDetDiv').html('');
        $('.atrDetDiv').html('<div class="form-group">\
                                    <label for="lefticon" class="col-sm-2 control-label">Product Color Name *</label>\
                                    <div class="col-sm-10">\
                                        <span class="input-with-icon">\
                                            <input type="text" class="form-control" name="productColorName" id="productColorName" required aria-required="true">\
                                        </span>\
                                    </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="lefticon" class="col-sm-2 control-label">Product Price *</label>\
                                    <div class="col-sm-10">\
                                        <span class="input-with-icon">\
                                            <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" name="productPrice" id="productPrice" required aria-required="true">\
                                        </span>\
                                    </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="lefticon" class="col-sm-2 control-label">Product Sell Price *</label>\
                                    <div class="col-sm-10">\
                                        <span class="input-with-icon">\
                                            <input type="text" class="form-control chkPrice" onkeypress="return isNumber(this.event)" name="productSellPrice" id="productSellPrice" required aria-required="true">\
                                        </span>\
                                    </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="lefticon" class="col-sm-2 control-label">Product Discount *</label>\
                                    <div class="col-sm-10">\
                                        <span class="input-with-icon">\
                                            <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productDiscount" id="productDiscount" required aria-required="true" readonly>\
                                        </span>\
                                    </div>\
                                </div>\
                                <div class="form-group">\
                                    <label for="lefticon" class="col-sm-2 control-label">Product Stock *</label>\
                                    <div class="col-sm-10">\
                                        <span class="input-with-icon">\
                                            <input type="text" class="form-control" onkeypress="return isNumber(this.event)" name="productStock" id="productStock" required aria-required="true">\
                                        </span>\
                                    </div>\
                                </div>\
                                <div class="moreImgDiv">\
                                    <div class="form-group">\
                                        <label for="lefticon" class="col-sm-2 control-label">Product Related Image </label>\
                                        <div class="col-sm-10">\
                                            <span class="input-with-icon">\
                                                <input type="file" class="form-control" name="moreImage[]" aria-required="true" required>\
                                                <p>SIZE 250 X 70</p>\
                                            </span>\
                                        </div>\
                                    </div>\
                                </div>');
        $('#productColor').val('FFFFFF');
        $('#productColor').css("background-color", "#FFFFFF");
        $('#old_productColor').val('');
        $('#product_attribute_id').val('');
    }
});
