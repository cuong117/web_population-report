$(document).ready(function() {
    var imgPosition = $(".aspect-ratio-169 img").toArray();
    var imgContainer = $(".aspect-ratio-169");
    var dotItem = $(".dot").toArray();
    //console.log(dotItem[0]);

    let imgNumber = imgPosition.length;
    let index = 0;
    imgPosition.forEach(function(image, index) {
        //console.log(image, index);
        image.style.left = index * 100 + "%";
        $(dotItem[index]).click(function() {
            slider(index);
            console.log("an")
        })

    })

    function imgSlide() {
        index++;
        if (index >= imgNumber) {
            index = 0;
        }
        slider(index);
    }

    function slider(index) {
        imgContainer.css("left", "-" + index * 100 + "%");
        $(".dot-container").children("div").removeClass("active");
        //console.log(dotItem);
        $(dotItem[index]).addClass("active");
    }
    setInterval(imgSlide, 5000);


    /*----------------CARTEGORY------------*/
    $('.cartegory-find-li').click(function() {
            $(this).children('ul').slideToggle();
        })
        // const itemsliderbar = $(".cartegory-find-li").toArray();
        // console.log(itemsliderbar);
        // itemsliderbar.forEach(function(menu, index) {
        //     // console.log(menu, index)
        //     $(menu).click(function() {
        //             $(menu).toggleClass("block");
        //             //  console.log("ok")
        //         })
        //         //console.log(menu, index)
        // })

    // hiệu ứng backtop buttom

    $(window).scroll(function() {
        if ($(this).scrollTop()) {
            $('#backtop').fadeIn();
            console.log("dafa");
        } else {
            $('#backtop').fadeOut();
            console.log("dafa");
        }
    })
    $('#backtop').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 500);
    })

    /*--------------SiGN UP---------------*/
    $("#eyes").click(function() {
        $(this).toggleClass('open');
        $(this).children('i').toggleClass('fa-eye-slash fa-eye');
        console.log($(this).children('i').hasClass('fa-eye'));
        if ($(this).hasClass('open')) {
            $(this).next().attr('type', 'text');
        } else {
            $(this).next().attr('type', 'password');
        }
    });

    // đăng nhập
    $('#dangnhap').click(function() {
        $.ajax({
            url: '',
            method: post,
            data: $('#form-1').serialize(),
            success: function() {
                alert(res);
            }
        })
    })
})

function Validator(options) {
    function validate(inputElement, rule) {
        var errorElement = $(inputElement).next();
        var errorMessage = rule.test(inputElement.value);
        if (errorMessage) {
            errorElement.html(errorMessage);
            $(inputElement).addClass('invalid');
        } else {
            errorElement.html('');
            $(inputElement).removeClass('invalid');
        }
        return !errorMessage;
    }

    //lay element cua form can validate
    var formElement = document.querySelector(options.form);

    if (formElement) {

        formElement.onsubmit = function(e) {
            e.preventDefault();
            var isFormValid = true;
            //lặp qua từng rule và validate
            options.rule.forEach(function(rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });


            if (isFormValid) {
                //trường hợp submit với js
                if (typeof options.onSubmit === 'function') {
                    var enableInputs = formElement.querySelectorAll('[name]');
                    var formValues = Array.from(enableInputs).reduce(function(values, input) {
                        (values[input.name] = input.value)
                        return values;
                    }, {});
                    options.onSubmit(formValues);
                }
            }
            //trường hợp submit với hành vi mặc định
            else {
                formElement.submit();
            }

        }

        options.rule.forEach(function(rule) {
            var inputElement = formElement.querySelector(rule.selector);

            if (inputElement) {
                //xu ly truong hop blur khoi input
                inputElement.onblur = function() {
                        validate(inputElement, rule);
                    }
                    //Xu ly mi khi nguoi dung nhap input
                inputElement.oninput = function() {
                    var errorElement = $(inputElement).next();
                    errorElement.html('');
                    $(inputElement).removeClass('invalid');

                }
            }
        })
    }
}
//rules
Validator.isRequired = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            return value.trim() ? undefined : 'Vui long nhap '

        }
    }

}
Validator.isEmail = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : 'Truong nay phai la email'
        }
    }
}
Validator.minLength = function(selector, min) {
    return {
        selector: selector,
        test: function(value) {
            return value.length >= min ? undefined : `Mật khẩu phải có ít nhất ${min} ký tự  `;

        }
    }

}