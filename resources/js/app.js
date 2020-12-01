require('./bootstrap');

(function ($) {
    "use strict";

    /*==================================================================
    [ Focus input ]*/
    $('input.input100').each(function(){
        if($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).on('focusin',function(){
            hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }

    });

    $('.au-btn-search').on('click', function (e) {
        e.preventDefault();
        const q = $(this).prev().val()
        if (q){
            $('.search-form').submit()
        }
    })

    $('.avatar-form').on('change', function () {
        this.submit();
    });
    $('[data-toggle="tooltip"]').tooltip();

    let variant_id = $('.btn.variant.active').data('id');

    if (variant_id){
        $('.active-variant-color').text($('.btn.variant.active').data('color')).parent().removeClass('d-none');
    }


    $(document).on('click','.btn.variant:not(.active)', function () {
        //change price
        if ($(this).find('.variant-price').text().trim()){
            $('h3 .variation-price').text($(this).find('.variant-price').text().trim())
        }
        //add active class
        $('.btn.variant.active').removeClass('active');
        $('.active-variant-color').text($(this).data('color'));
        $(this).addClass('active');
        //change variant
        variant_id = $(this).data('id')
        $('.my-variant.active').removeClass('active:').addClass('d-none')
        $(`.my-variant#v-${variant_id}`).addClass('active').removeClass('d-none')
    });

    $('.add-to-cart').on('click', function (e) {
        let activeProduct = {};
        if (window.product){
            let product = JSON.parse(window.product)
            const variant = product.variants[variant_id];
            activeProduct.title = product.title
            activeProduct.asin = variant ? variant.asin : product.asin
            activeProduct.url = variant ? variant.link : product.url
            activeProduct.price = parseFloat(variant ? variant.price.trim().replace('$', '') : product.price.current_price)
            activeProduct.images = [
                {link: variant ? variant.images[0].large : product.images[0]}
            ];
            activeProduct.total_reviews = product.reviews.total_reviews
            activeProduct.rating = parseFloat(product.reviews.rating)
            activeProduct.item_available = product.item_available ? 1 : 0
            activeProduct.options = {
                quantity: 1
            }
            if (variant){
                activeProduct.options.color =  variant.title
            }

            console.log(activeProduct)

            $.ajax({
                type: 'POST',
                headers: {'x-csrf-token': $('meta[name="csrf-token"]').attr('content')},
                url: '/cart/add',
                data: {...activeProduct},
                success: function (data) {
                    if (data.count) {
                        $('.cart-count').text(data.count)
                    }
                    toastr.options = {
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "positionClass": "toast-bottom-left",
                    }
                    toastr.success(data.message);
                    if (data.cart){
                        $('.show-on-add').removeClass('d-none')
                        const cart = data.cart
                        $('.cart-body').html('');
                        for (const [key, value] of Object.entries(cart)){
                            const item = `\
                            <div class="mess__item">
                                <div class="image img-cir img-40">
                                    <img src="${data.images[key]}" class="img-40 img-thumbnail" alt="SAMSUNG GALAXY" />
                                </div>
                                <div class="content">
                                    <h6  class="cart-item-title">${value.model.title}</h6>
                                    <p class="mt-1">Quantity: ${value.qty}</p>
                                    <span class="time">${value.model.price}</span>
                                </div>
                            </div>`;
                            $('.cart-body').append(item);
                        }
                    }
                },
                error: function (data) {
                    console.log(data)
                }
            })

        }
    });

    let inputNumber = function(el) {

        var min = el.attr('min') || false;
        var max = el.attr('max') || false;

        var els = {};

        els.dec = el.prev();
        els.inc = el.next();


        els.dec.on('click', decrement)
        els.inc.on('click', increment)

        function decrement() {
            var value = $(this).next().val();
            value--;
            if (!min || value >= min) {
                $(this).next().val(value);
                let myEl = $(this).parent().parent().parent().find('.product-subtotal')[0]
                let price = $(this).parent().data('price')
                $(myEl).text(`$${(parseFloat(price)*value).toFixed(2)}`)
                updateQuantity(value, $(this))
            }
        }

        function increment() {
            var value = $(this).prev().val();
            value++;
            if (!max || value <= max) {
                $(this).prev().val(value);
                let myEl = $(this).parent().parent().parent().find('.product-subtotal')[0]
                let price = $(this).parent().data('price')
                $(myEl).text(`$${(parseFloat(price)*value).toFixed(2)}`)
                updateQuantity(value, $(this))
            }
        }

        function updateQuantity(value, el) {
            let data = {
                quantity: value,
                rowId: el.parents('.effects').data('rowid'),
                _method: 'PUT',
            }
            $.ajax({
                type: 'POST',
                headers: {'x-csrf-token': $('meta[name="csrf-token"]').attr('content')},
                url: el.parent().data('href'),
                data: {...data},
                success: function (data) {
                    console.log(data)
                    if (data.count) {
                        $('.cart-count').text(data.count)
                    }
                    toastr.options = {
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "positionClass": "toast-bottom-left",
                        "preventDuplicates": true,
                        "preventOpenDuplicates": true
                    }
                    toastr.success(data.message);
                },
                error: function (data) {
                    console.log(data)
                }
            })
        }
    }

    inputNumber($('.input-number'));

    //INIT SMOOTH SCROLLBAR
    console.log(Scrollbar)
    window.Scrollbar.default.initAll();

    $('.card, div').on('click', function () {
        if ($(this).data('href')){
            window.location.href = $(this).data('href')
        }
    })

    $('#btn-add-row').on('click', function (){
        let tr = $('#quote-form tbody>tr:last').clone(true);
        $('#quote-form tbody>tr>td:last').after('<div class="dropdown-divider"></div>');
        tr.insertAfter('#quote-form tbody>tr:last');
        $(this).removeAttr('id').addClass('btn-minus-row').html('<i class="fa fa-minus"></i>').off('click');
    })

    $(document).on('click', '.btn-minus-row', function (){
        $(this).off('click').closest('tr').remove();
    })

    $('.quote .checkbox').click(function(){
        $('.checkbox').each(function(){
            $(this).prop('checked', false);
        });
        $(this).prop('checked', true);
    });

    //custom file upload
    $('.quote input[type="file"]').each(function () {
        // get label text
        var label = $(this).parents(".my-form-group").find("label").html();
        label = label ? label : "Upload File";

        // wrap the file input
        $(this).wrap('<div class="input-file"></div>');
        // display label
        $(this).before('<span class="btn">' + label + "</span>");
        // we will display selected file here
        $(this).before('<span class="file-selected"></span>');

        // file input change listener
        $(this).change(function (e) {
            // Get this file input value
            var val = $(this).val();

            // Let's only show filename.
            // By default file input value is a fullpath, something like
            // C:\fakepath\Nuriootpa1.jpg depending on your browser.
            var filename = val.replace(/^.*[\\\/]/, "");

            // Display the filename
            $(this).siblings(".file-selected").text(filename);
        });
    });

// Open the file browser when our custom button is clicked.
    $(".input-file .btn").click(function () {
        $(this).siblings('input[type="file"]').trigger("click");
    });


    const observer = window.lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();

})(jQuery);

