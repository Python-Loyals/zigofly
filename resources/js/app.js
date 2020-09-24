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

    $('.avatar-form').on('change', function () {
        this.submit();
    });
    $('[data-toggle="tooltip"]').tooltip();

    $('.active-variant-color').text($('.btn.variant.active').data('color'));

    let variant_id = $('.btn.variant.active').data('id');

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
            activeProduct.asin = variant.asin
            activeProduct.url = variant.link
            activeProduct.price = parseFloat(variant.price ? variant.price.trim().replace('$', '') : product.price.current_price)
            activeProduct.images = [
                {link: variant.images[0].large}
            ];
            activeProduct.total_reviews = product.reviews.total_reviews
            activeProduct.rating = parseFloat(product.reviews.rating)
            activeProduct.item_available = product.item_available ? 1 : 0
            activeProduct.options = {
                color: variant.title,
                quantity: 1
            }

            console.log(activeProduct)

            $.ajax({
                type: 'POST',
                headers: {'x-csrf-token': $('meta[name="csrf-token"]').attr('content')},
                url: '/product/store',
                data: {...activeProduct},
                success: function (data) {
                    console.log(data)
                },
                error: function (data) {
                    console.log(data)
                }
            })

        }
    })

})(jQuery);

