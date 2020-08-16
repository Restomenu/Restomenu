<script>
    $(document).ready(function() {
        $('#preload-loader').css('display', 'none');
        // $('button').css('width', '100%');
        $('button').css('background-image', 'linear-gradient(to right, rgb(153, 202, 60), rgb(7, 153, 72));');
        $(".order-quantity-number").filter(function() {
            return $(this).text().trim() === "0";
        }).hide();
        // $('.order-quantity').css('border-bottom', '1px dotted lightgray');
        $('.order-quantity').css('box-sizing', 'border-box');
        $('.order-quantity').css('max-width', '100%');
        $('.order-quantity').css('pointer-events', 'auto');
        $('.order-quantity').css('background-color', 'white');
        $('.order-quantity').css('justify-content', 'flex-end');
        $('.order-quantity').css('padding-right', '20px');
        $('.order-quantity').css('margin-bottom', '1px');
        $('.menu-block').css('border-bottom', '0px');
        $('.menu-block').css('margin-bottom', '0px');
        $('.special-tag-container p').css('color', 'black');
        $('.special-tag-container p').css('font-size', '14px');
        $('.special-tag-container p').css('font-weight', '400');
        $('.special-tag-container').css('margin-top', '20px');
        $('.special-tag-container p').css('margin-bottom', '10px');
        $('.special-tag-container p').css('margin-top', '10px');
        $('.special-tag-container-first').css('border-top', '0px');
        $('.circle-divider-enhanced').css('display', 'none');
        $('.circle-divider-enhanced-gray').css('display', 'none');
        $(".item-box-enhanced").each(function() {
            if ($(this).next().hasClass("minor-item")) {
                $(this).css('border-bottom', '0px');
                $(this).css('margin-bottom', '0px');
            }
        });
        $(".minor-item").each(function() {
            if ($(this).next().hasClass("order-quantity")) {
                $(this).css('border-bottom', '0px');
                $(this).css('padding-top', '20px');
            }
            if ($(this).next().hasClass("menu-block")) {
                $(this).css('margin-bottom', '1px');
            }
        });
        $(".menu-block").each(function() {
            if ($(this).next().hasClass("order-options")) {
                $(this).css('border-bottom', '0px');
            }
        });
        // $('.sortable').railsSortable({
        //     // var disabled = $( ".item-box" ).sortable( "option", "disabled" );
        //     placeholder: "move",
        //     forcePlaceholderSize: true,
        //     // cancel: 'not-sortable',
        //     // items: '>.item-box:not(.not-sortable)',
        //     items: ".item-box-enhanced:not(.not-sortable)",
        //     // revert: true,
        //     handle: '.handle',
        //     scroll: true,
        //     scrollSpeed: 200,
        //     // scrollSensitivity: 80000,
        //     stop: function(event, ui) {
        //         // $('.sortable .drink-item-box').removeClass('first-drink');
        //         // $('.sortable .drink-item-box:first').addClass('first-drink');
        //         // // $('.sortable .item-box').removeClass('greyed-out');
        //         // $('.sortable .item-box').removeClass('not-sortable');
        //     }
        // });

        $('.menu-header').css('border-bottom', '0px');
        // $('.menu-category-jump').css('font-size', '10px');
        // CLICK ON IMAGE
        $('#cart').append('<a href="/orders/new"><img src="" /></a>');
        $('#cart img').css('display', 'none');
        $('.remove-from-cart-button').hide();
        $(".add-to-cart-button").on('click', function() {
            $('#cart').animate({
                backgroundColor: '#008d36'
            }, 800);

            // ('background-image', 'linear-gradient(to right, rgb(153, 202, 60), rgb(7, 153, 72))');
            $('#cart').css('border-radius', '10px');

            $("#cart").html(
                '<img style="width: 400px;height: 32px;" src="loading_dots.gif" />');

            function currencyFormat(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }

            $(".add-to-cart-button").css('pointer-events', 'none');
            $('.remove-from-cart-button').css('pointer-events', 'none');
            $(this).closest('.order-quantity').find('.remove-from-cart-button').show();
            $(this).closest('.order-quantity').find('.order-quantity-number').show();
            // console.log('click', $(this).closest('.order-quantity').find('.order-quantity-number').text());
            var count = $(this).closest('.order-quantity').find('.order-quantity-number').text();
            count++;
            $(this).closest('.order-quantity').find('.order-quantity-number').text(count);

            setTimeout(function() {

                // remove this block compulsory start
                $(".add-to-cart-button").css(
                    'pointer-events', 'auto');

                $('.remove-from-cart-button').css(
                    'pointer-events', 'auto');

                // remove this block compulsory end

                // $.ajax({
                //     url: "/order_rows/new",
                //     success: function (result) {
                //         $.ajax({
                //             url: "/order_rows/cart",
                //             success: function (result) {

                //                 $('#cart').animate({
                //                     backgroundColor: '#3c3c3b'
                //                 }, 800);

                //                 $('#cart').css('border-radius', '10px');
                //                 $("#cart").html(currencyFormat(result));
                //                 $('#cart').append(
                //                     '<div class="cart-filler"</div>');
                //                 $('#cart').append(
                //                     '<a href="/orders/new/en"><img src="https://menulingua.com/arrow_forward.svg" /></a>'
                //                 );
                //                 $('#cart').prepend('€');

                //                 $(".add-to-cart-button").css(
                //                     'pointer-events', 'auto');

                //                 $('.multiple-selection-order-button')
                //                     .css('pointer-events', 'none');
                //                 $('.remove-from-cart-button').css(
                //                     'pointer-events', 'auto');


                //             }
                //         });
                //     }
                // });

            }, 1000);

        });

        $(".remove-from-cart-button").on('click', function() {
            $('#cart').animate({
                backgroundColor: '#be1e2d'
            }, 800);
            $('#cart').css('border-radius', '10px');

            $("#cart").html(
                '<img style="width: 400px;height: 32px;" src="loading_dots.gif" />');

            function currencyFormat(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }

            $(".add-to-cart-button").css('pointer-events', 'none');
            $('.remove-from-cart-button').css('pointer-events', 'none');

            var itemId = ($(this).attr('id'));

            setTimeout(
                function() {
                    // remove this block compulsory start
                    $(".add-to-cart-button").css(
                        'pointer-events', 'auto');

                    $('.remove-from-cart-button').css(
                        'pointer-events', 'auto');

                    // remove this block compulsory end

                    //do something special
                    // $.ajax({
                    //     url: "/order_rows/cart",
                    //     success: function(result) {
                    //         $('#cart').animate({
                    //             backgroundColor: '#3c3c3b'
                    //         }, 800);
                    //         $('#cart').css('border-radius', '10px');
                    //         $("#cart").html(currencyFormat(result));
                    //         $('#cart').append('<div class="cart-filler"</div>');
                    //         $('#cart').append(
                    //             '<a href="/orders/new/en"><img src="https://menulingua.com/arrow_forward.svg" /></a>'
                    //         );
                    //         $('#cart').prepend('€');

                    //         $(".add-to-cart-button").css('pointer-events', 'auto');
                    //         $('.remove-from-cart-button').css('pointer-events', 'auto');
                    //     }
                    // });

                }, 1000);

            var count = $(this).closest('.order-quantity').find('.order-quantity-number').text();
            count--;
            $(this).closest('.order-quantity').find('.order-quantity-number').text(count);

            $(".order-quantity-number").filter(function() {
                return $(this).text().trim() === "0";
            }).hide();

            if (count == 0) {
                $(this).closest('.remove-from-cart-button').hide();
            }
        });

        $('.hidden-item').parent().parent().parent().css('background-color', '#f1f1f1');

        function showOrHideFullFoodView() {
            var foodBox = $(this).closest('.menu-block');
            var description = $(this).closest('.item-description');
            var divider = $(this).closest('.circle-divider-enhanced');
            var descriptionTargetLanguage = $(this).closest('.item-dynamic-description');
            if ($(this).hasClass('.more-selections-button')) {
                var foodBox = $(this).parent().prev().closest('.menu-block');
                var description = $(this).parent().prev().closest('.item-description');
            }

            foodBox.toggleClass('box-expanded');
            if (foodBox.hasClass('box-expanded')) {
                foodBox.find('.circle-divider-enhanced').css('display', 'flex');
                foodBox.addClass('menu-clicked');
                foodBox.find('.circle-divider-enhanced-gray').css('display', 'flex');
                foodBox.find('.price-container-enhanced').css('margin-top', '20px');
                foodBox.find('.descriptor-toggle-enhanced').html(
                    '<img style="width: 20px;" src="" />');

                foodBox.find('.descriptor-toggle-enhance img').css('width', '15px');
                foodBox.find('.descriptor-toggle-enhanced img').css('margin-bottom', '0px');

            } else {
                foodBox.find('.circle-divider-enhanced').css('display', 'none');
                foodBox.find('.item-description').hide();
                foodBox.find('.item-dynamic-description').hide();
                foodBox.removeClass('menu-clicked');
                foodBox.find('.circle-divider-enhanced-gray').css('display', 'none');
                foodBox.find('.price-container-enhanced').css('margin-top', '0px');
                foodBox.find('.descriptor-toggle-enhanced').html('<img src="" />');
            }
        }
        $('.descriptor-toggle-enhanced').click(showOrHideFullFoodView);
        $('.food-image-enhanced').click(showOrHideFullFoodView);
        // $('.more-selections-button').click(showOrHideFullFoodView);

        // $('.more-selections-button').click(function() {

        // 	$(this).parent().prev(showOrHideFullFoodView);

        // });

        $('.sold-out-button').css('pointer-events', 'auto');
        $('.item-text-enhanced h5').each(function() {
            var translatedText = $(this).closest('.item-text-enhanced').find('h4').text();
            if ($(this).text().toLowerCase() == translatedText.toLowerCase()) {
                $(this).css('color', 'red');
                $(this).empty();
            }
        });
        // SCRIPT FOR CLICKING ON RADIO BUTTONS
        $('.selection-category div').on('click', function() {
            // var selectionsArray = [];
            $(this).closest('.selection-category').find('.radio-button').removeClass(
                'radio-button-selected');
            $(this).closest('.selection-category div').find('.radio-button').toggleClass(
                'radio-button-selected');
            var selectedItem = $('.radio-button-selected');
            $('.radio-button-selected').each(function() {
                selectionArray = []
                $(this).closest('.more-selections-for-item').find('.radio-button-selected').each(
                    function() {
                        selectionArray.push($(this).parent().attr('id'));
                        console.log(selectionArray);
                        ($(this).closest('.more-selections-for-item').find(
                            ".hidden-selections-array").text(selectionArray));
                        $(this).closest('.more-selections-for-item').find(
                            '.hidden-selections-array').val(selectionArray);
                    });
            });

            var categoryCount = $(this).closest('.more-selections-for-item').find('.selection-category')
                .length;
            var numberSelected = $(this).closest('.more-selections-for-item').find(
                '.radio-button-selected').length;

            if (categoryCount == numberSelected) {
                $(this).closest('.more-selections-for-item').find('.multiple-selection-order-button')
                    .css('pointer-events', 'auto');
            }
        });

        $('.more-selections-for-item').hide();
        $(".more-selections-button").on('click', function() {
            // $(this).closest('.order-quantity').prev().find('.item-dynamic-description').toggle();
            $(this).closest('.order-quantity').css('flex-wrap', 'wrap');
            $(this).closest('.order-quantity').css('height', 'auto');
            $(this).closest('.order-quantity').find('.more-selections-for-item').fadeToggle(200);
            $(this).closest('.order-quantity').find('.remove-from-cart-button').hide();
            $(this).closest('.order-quantity').find('.order-quantity-number').hide();
            $(this).hide();
            $(this).closest()

            var foodBox = $(this).parent().prev().closest('.menu-block');
            foodBox.find('.circle-divider-enhanced').css('display', 'flex');
            foodBox.addClass('menu-clicked');
            foodBox.find('.price-container-enhanced').css('margin-top', '20px');
            foodBox.find('.descriptor-toggle-enhanced').html(
                '<img style="width: 20px;" src="" />');

            foodBox.find('.descriptor-toggle-enhance img').css('width', '15px');
            foodBox.find('.descriptor-toggle-enhanced img').css('margin-bottom', '0px');
            var categoryCount = $(this).closest('.order-quantity').find('.selection-category').length;
            var numberSelected = $(this).closest('.order-quantity').find('.radio-button-selected')
                .length;


            if (categoryCount > numberSelected) {
                $(this).closest('.order-quantity').find('.multiple-selection-order-button').css(
                    'pointer-events', 'none');
            }
        });

        $('.multiple-selection-order-button').on('click', function() {
            $(this).closest('.order-quantity').css('flex-wrap', 'no-wrap');
            $(this).closest('.order-quantity').css('height', '40px');
            $(this).closest('.order-quantity').find('.more-selections-for-item').hide();
            $(this).closest('.order-quantity').find('.more-selections-button').show();
            $(this).closest('.order-quantity').find('.radio-button').removeClass(
                'radio-button-selected');
            $('.multiple-selection-order-button').css('pointer-events', 'none');
        });
    });

    $('.menu-header h2').each(function() {
        var menuSecondaryName = $(this).closest('.menu-header').find('h1').text();
        if ($(this).text().toLowerCase() == menuSecondaryName.toLowerCase()) {
            $(this).css('color', 'red');
            $(this).empty();
        }
    });

    $(document).ready(function() {
        $('.item-dynamic-description').show();
        $('.descriptor-toggle-enhanced').hide();
        $('.major-category-header-block h5').css('font-weight', '800');
        $('.major-category-header-block h5').css('margin-top', '20px');
        $('.menu-block').css('position', 'relative');
        $('.major-category-header-block').css('position', 'relative');
        $('.major-category-header-block').css('flex-direction', 'column');
        $(window).scroll(function() {
            $('#back-button').toggleClass('relative', $(window).scrollTop() + $(window).height() > $(
                document).height() - $('#mini-footer-mobile').height());
        });
        $('.hidden-item').parent().parent().parent().css('display', 'none');
        $('.major-category-header-block').next().css('border-radius', '10px 10px 0px 0px');

        $('.menu-block').each(function() {
            if ($(this).next().hasClass('major-category-header-block')) {
                $(this).css('border-radius', '0px 0px 10px 10px');
                $(this).css('border-bottom', '0px');
            }
        });

        $('.minor-item').each(function() {
            if ($(this).next().hasClass('major-category-header-block')) {
                $(this).css('border-radius', '0px 0px 10px 10px');
                $(this).css('border-bottom', '0px');
            }
        });

        $('.major-category-header-block img').each(function() {
            if ($(this).parent().prev().hasClass('menu-block')) {
                //$(this).css('margin-top', '-10px');
            }
        });

        $('.order-quantity').each(function() {
            if ($(this).next().hasClass('major-category-header-block')) {
                $(this).css('border-radius', '0px 0px 10px 10px');
                $(this).css('border-bottom', '0px');
            }
        });

        $('.menu-container-enhanced').css('padding-bottom', '30px');
        $('.menu-block').css('z-index', '5');
        $('.menu-block').last().css('border-radius', '0px 0px 10px 10px');
        $('.sortable').css('margin-top', '30px');
        $('.item-box-enhanced').first().css('border-radius', '10px 10px 0px 0px');
        $('.category-header-block .item-description').hide();
        $('.category-header-block .item-dynamic-description').css('margin-top', '10px');
        $('.major-category-header-block .item-description').hide();
        // $('.special-tag-container-first').hide();

        $('.close-image-instructions').hide();
        $('.close-image-container').hide();
        // $('.menu-header').css("pointer-events", "none");
        $('.menu-header').css("padding-top", "20px");
        $('.handle').addClass("invisible");
        $('.new-buttons').addClass("invisible");
        $('.sortable').css("pointer-events", "none");
        $('.more-info-button-mobile').css("pointer-events", "auto");
        $('.description-wrapper').css("pointer-events", "auto");
        $('.more-info-button-mobile').css("margin-right", "10px");
        $('.more-info-button-mobile').css("margin-left", "0px");
        $('.menu-wrapper').css("margin-top", "-20px");
        $('.delete-button2-mobile').hide();
        $('.upload-prompt').hide();
        $('.new-buttons-category-box').hide();
        $('.special-tag-container p').css('user-select', 'none');
        $('.description-wrapper').css('user-select', 'none');
        $('#categories-top-box p').css('width', '150px');
        $('#categories-top-box p').css('min-width', '150px');
        $('#categories-top-box p').css('max-width', '150px');
        $('.menu-category-jump').css('justify-content', 'center');

        // CLICK TO ENLARGE IMAGE 
        $('.menu-image').on('click', function(event) {
            var image = $(this).closest('img');
            var originalDiv = $(this).closest('.item-box')
            $('#backdrop').fadeToggle(200);
            image.clone().addClass('enlarged-image').appendTo('#backdrop');
            $('#categories-top-box').fadeToggle(200);
            $('.close-image-container').toggle();
            $('.close-image-instructions').toggle();
        });

        $('#backdrop').on('click', function(event) {
            $('#backdrop').fadeToggle(200);
            $('#categories-top-box').fadeToggle(200);
            $('.close-image-instructions').toggle();
            $('.close-image-container').toggle();
        })

        $('body').css('background-color', '#f4f4f4');
        $('.drink-item-box:first').css('border-top', '40px solid #f4f4f4');
        $('.initial-prompt').hide();
        $('.notice').hide();
        $('.alert').hide();
        $('.delete-button3').hide();

        // MENU category jump
        $(".menu-category-jump").click(function(event) {
            $('html, body').animate({
                scrollTop: $("#Food_" + event.target.id).offset().top - 50
            });
        });

        // $('#clickable-categories-filler-for-scroll').hide();
        function fixDiv() {
            var menuHeader = $('.menu-header').height();
            var $cache = $('#categories-top-box');
            if ($(window).scrollTop() > menuHeader) {
                $cache.css({
                    'position': 'fixed',
                    'top': '0px',
                    'width': '100%',
                    'max-width': '900px',
                    'box-shadow': '1px 2px 1px 0px rgba(0, 0, 0, 0.1)'
                })
                $('.sortable').addClass('top-filler');

            } else {
                $cache.css({
                    'position': 'relative',
                    'top': 'auto',
                    'box-shadow': 'none'
                })
                $('.sortable').removeClass('top-filler');

            }
            // $('.sortable').removeClass('top-filler');
        }

        function highlightCategory() {
            var primaryColor = '#90922e';
            var numberOfCategories = $('.menu-category-jump').length;

            $(window).bind('scroll', function() {
                // $('#categories-top-box').scrollLeft(0);
                $('.category-header-block, .major-category-header-block').each(function() {

                    if (!$(this).hasClass("hidden-from-top")) {

                        var category = $(this);
                        var position = category.position().top - $(window).scrollTop();
                        var itemId = category.attr('id');

                        if (position < 100) {

                            $('.menu-category-jump').each(function() {

                                if ($(this).hasClass(itemId)) {

                                    $(this).addClass('selected');

                                    $(this).css('color', 'white');

                                    var thisCategoryHeader = ($(
                                        '#categories-top-box .menu-category-jump.selected'
                                    ).index() + 1);

                                    var calculatedHeaderPosition = thisCategoryHeader *
                                        150

                                    if ($(window).width() > $('.menu-header').width()) {
                                        $('#categories-top-box').scrollLeft(
                                            calculatedHeaderPosition - $(window)
                                            .width() + $('#categories-top-box')
                                            .offset().left * 2);
                                    } else {
                                        $('#categories-top-box').scrollLeft(
                                            calculatedHeaderPosition - $(window)
                                            .width());
                                    }
                                } else {
                                    $(this).removeClass('selected');
                                    $(this).css('color', primaryColor);
                                }
                            });

                        }

                    }
                });
            });
        }

        function addFiller() {}
        $(window).scroll(fixDiv);
        fixDiv();
        highlightCategory();
    });
</script>