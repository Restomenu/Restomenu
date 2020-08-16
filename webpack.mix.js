const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
//************************ front **************************/
mix.js("resources/assets/front/js/app.js", "public/front/js")
    .sass("resources/assets/front/sass/app.scss", "public/front/css")
    .copyDirectory(["resources/assets/front/images"], "public/front/images")
    .copyDirectory(["resources/assets/front/fonts"], "public/front/fonts")
    .copyDirectory(
        ["resources/assets/front/vendor/font-awesome/fonts"],
        "public/front/css/fonts"
    )
    .copyDirectory(
        ["resources/assets/front/menu/images"],
        "public/front/menu/images"
    )
    .copyDirectory(
        ["resources/assets/front/menu/js/*"],
        "public/front/menu/js"
    );

mix.styles(
    ["resources/assets/front/menu/css/menu.css"],
    "public/front/menu/css/menu.css"
);
mix.styles(
    ["resources/assets/front/menu/css/custom.css"],
    "public/front/menu/css/custom.css"
);

mix.combine(
    [
        "resources/assets/front/vendor/animate/animate.css",
        "resources/assets/front/css/style.css",
        // 'resources/assets/front/vendor/datatables/datatables.min.css',
        // 'resources/assets/front/vendor/datatables/responsive.dataTables.min.css',
        "resources/assets/front/vendor/font-awesome/font-awesome.css",
        "resources/assets/front/vendor/sweetalert2/sweetalert2.min.css",
        "resources/assets/front/vendor/toastr/toastr.min.css",
        "resources/assets/front/vendor/select2/select2.min.css",
        "resources/assets/front/vendor/star-rating/star-rating-svg.css"
    ],
    "public/front/css/vendor.css"
);

mix.combine(
    [
        // 'resources/assets/front/vendor/jquery/jquery-3.1.1.min.js',
        "resources/assets/front/vendor/slimscroll/jquery.slimscroll.min.js",
        "resources/assets/front/vendor/metisMenu/jquery-metisMenu.js",
        "resources/assets/front/vendor/popper/popper.min.js",
        // 'resources/assets/front/vendor/datatables/datatables.min.js',
        // 'resources/assets/front/vendor/datatables/dataTables.bootstrap4.min.js',
        // 'resources/assets/front/vendor/datatables/dataTables.responsive.min.js',
        "resources/assets/front/vendor/jquery-validation/jquery-validate.min.js",
        "resources/assets/front/vendor/jquery-validation/additional-methods.min.js",
        "resources/assets/front/vendor/pace/pace.min.js",
        "resources/assets/front/vendor/sweetalert2/es6-promise.auto.min.js",
        "resources/assets/front/vendor/sweetalert2/sweetalert2.min.js",
        "resources/assets/front/vendor/toastr/toastr.min.js",
        "resources/assets/front/vendor/select2/select2.full.min.js",
        "resources/assets/front/vendor/star-rating/jquery.star-rating-svg.js"
        // 'resources/assets/front/js/inspinia.js'
    ],
    "public/front/js/vendor.js"
);

//************************ admin **************************/
mix.js("resources/assets/admin/js/app.js", "public/admin/js");
mix.js(
    "resources/assets/admin/vendor/jquery/jquery-3.1.1.min.js",
    "public/admin/js"
);
mix.js(
    "resources/assets/admin/vendor/jquery-ui/jquery-ui.js",
    "public/admin/js"
);
mix.sass("resources/assets/admin/scss/app.scss", "public/admin/css").options({
    processCssUrls: false
});

mix.combine(
    [
        "resources/assets/admin/vendor/animate/animate.css",
        "resources/assets/admin/css/style.css",
        "resources/assets/admin/vendor/datatables/datatables.min.css",
        "resources/assets/admin/vendor/datatables/responsive.dataTables.min.css",
        "resources/assets/admin/vendor/font-awesome/font-awesome.css",
        "resources/assets/admin/vendor/sweetalert2/sweetalert2.min.css",
        "resources/assets/admin/vendor/toastr/toastr.min.css",
        "resources/assets/admin/vendor/select2/select2.min.css",
        "resources/assets/admin/vendor/image-picker/image-picker.css"
    ],
    "public/admin/css/vendor.css"
);

mix.combine(
    ["resources/assets/admin/css/custom.css"],
    "public/admin/css/custom.css"
);

mix.combine(
    [
        "resources/assets/admin/vendor/slimscroll/jquery.slimscroll.min.js",
        "resources/assets/admin/vendor/metisMenu/jquery-metisMenu.js",
        "resources/assets/admin/vendor/popper/popper.min.js",
        "resources/assets/admin/vendor/datatables/datatables.min.js",
        "resources/assets/admin/vendor/datatables/dataTables.bootstrap4.min.js",
        "resources/assets/admin/vendor/datatables/dataTables.responsive.min.js",
        "resources/assets/admin/vendor/jquery-validation/jquery-validate.min.js",
        "resources/assets/admin/vendor/jquery-validation/additional-methods.min.js",
        "resources/assets/admin/vendor/pace/pace.min.js",
        "resources/assets/admin/vendor/sweetalert2/es6-promise.auto.min.js",
        "resources/assets/admin/vendor/sweetalert2/sweetalert2.min.js",
        "resources/assets/admin/vendor/toastr/toastr.min.js",
        "resources/assets/admin/vendor/select2/select2.full.min.js",
        "resources/assets/admin/vendor/image-picker/image-picker.js",
        "resources/assets/admin/vendor/clipboard-js/clipboard-js.min.js",
        "resources/assets/admin/js/inspinia.js"
    ],
    "public/admin/js/vendor.js"
);

mix.copyDirectory(["resources/assets/admin/images"], "public/admin/images");
mix.copyDirectory(["resources/assets/admin/fonts"], "public/admin/fonts");
mix.copyDirectory(
    ["resources/assets/admin/vendor/font-awesome/fonts"],
    "public/admin/css/fonts"
);
mix.copyDirectory(["resources/assets/admin/uploads"], "public/admin/uploads");

//************************ restaurant **************************/
mix.js("resources/assets/restaurant/js/app.js", "public/restaurant/js");
mix.sass(
    "resources/assets/restaurant/scss/app.scss",
    "public/restaurant/css"
).options({
    processCssUrls: false
});

mix.combine(
    [
        "resources/assets/restaurant/vendor/animate/animate.css",
        "resources/assets/restaurant/css/style.css",
        "resources/assets/restaurant/vendor/datatables/datatables.min.css",
        "resources/assets/restaurant/vendor/datatables/responsive.dataTables.min.css",
        "resources/assets/restaurant/vendor/font-awesome/font-awesome.css",
        "resources/assets/restaurant/vendor/sweetalert2/sweetalert2.min.css",
        "resources/assets/restaurant/vendor/toastr/toastr.min.css",
        "resources/assets/restaurant/vendor/select2/select2.min.css",
        "resources/assets/restaurant/vendor/image-picker/image-picker.css"
    ],
    "public/restaurant/css/vendor.css"
);

mix.combine(
    ["resources/assets/restaurant/css/custom.css"],
    "public/restaurant/css/custom.css"
);

mix.combine(
    [
        "resources/assets/restaurant/vendor/jquery/jquery-3.1.1.min.js",
        "resources/assets/restaurant/vendor/jquery-ui/jquery-ui.js",
        "resources/assets/restaurant/vendor/slimscroll/jquery.slimscroll.min.js",
        "resources/assets/restaurant/vendor/metisMenu/jquery-metisMenu.js",
        "resources/assets/restaurant/vendor/popper/popper.min.js",
        "resources/assets/restaurant/vendor/datatables/datatables.min.js",
        "resources/assets/restaurant/vendor/datatables/dataTables.bootstrap4.min.js",
        "resources/assets/restaurant/vendor/datatables/dataTables.responsive.min.js",
        "resources/assets/restaurant/vendor/jquery-validation/jquery-validate.min.js",
        "resources/assets/restaurant/vendor/jquery-validation/additional-methods.min.js",
        "resources/assets/restaurant/vendor/pace/pace.min.js",
        "resources/assets/restaurant/vendor/sweetalert2/es6-promise.auto.min.js",
        "resources/assets/restaurant/vendor/sweetalert2/sweetalert2.min.js",
        "resources/assets/restaurant/vendor/toastr/toastr.min.js",
        "resources/assets/restaurant/vendor/select2/select2.full.min.js",
        "resources/assets/restaurant/vendor/image-picker/image-picker.js",
        "resources/assets/restaurant/js/inspinia.js"
    ],
    "public/restaurant/js/vendor.js"
);

mix.copyDirectory(
    ["resources/assets/restaurant/images"],
    "public/restaurant/images"
);
mix.copyDirectory(
    ["resources/assets/restaurant/fonts"],
    "public/restaurant/fonts"
);

mix.copyDirectory(
    ["resources/assets/restaurant/vendor/font-awesome/fonts"],
    "public/restaurant/css/fonts"
);

//************************ restaurant new **************************/
mix.js("resources/assets/restaurant-new/js/app.js", "public/restaurant-new/js")
    .js(
        "resources/assets/restaurant-new/js/template.js",
        "public/restaurant-new/js"
    )
    .sass(
        "resources/assets/restaurant-new/sass/app.scss",
        "public/restaurant-new/css"
    )
    .sourceMaps(true, "source-maps");

mix.copyDirectory(
    ["resources/assets/restaurant-new/fonts"],
    "public/restaurant-new/fonts"
);
mix.copyDirectory(
    ["resources/assets/restaurant-new/plugins/@mdi/fonts"],
    "public/restaurant-new/fonts"
);
mix.copyDirectory(
    ["resources/assets/restaurant-new/plugins/font-awesome/fonts"],
    "public/restaurant-new/fonts"
);
mix.copyDirectory(
    ["resources/assets/restaurant-new/plugins/dropify/fonts"],
    "public/restaurant-new/fonts"
);

mix.copyDirectory(
    ["resources/assets/restaurant-new/images"],
    "public/restaurant-new/images"
);

mix.copyDirectory(
    ["resources/assets/restaurant-new/plugins/flag-icon-css/flags"],
    "public/restaurant-new/flags"
);

mix.copyDirectory(["resources/assets/errors/404.svg"], "public/errors");

mix.copyDirectory(["resources/assets/mails"], "public/mails");

mix.combine(
    [
        "resources/assets/restaurant-new/plugins/toastr/toastr.min.css",
        "resources/assets/restaurant-new/plugins/perfect-scrollbar/perfect-scrollbar.css",
        "resources/assets/restaurant-new/plugins/flag-icon-css/css/flag-icon.css",
        "resources/assets/restaurant-new/plugins/@mdi/css/materialdesignicons.css",
        "resources/assets/restaurant-new/plugins/animate-css/animate.min.css",
        "resources/assets/restaurant-new/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css",
        "resources/assets/restaurant-new/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css",
        "resources/assets/restaurant-new/plugins/cropperjs/cropper.min.css",
        "resources/assets/restaurant-new/plugins/datatables-net/buttons.dataTables.min.css",
        "resources/assets/restaurant-new/plugins/datatables-net/dataTables.bootstrap4.css",
        "resources/assets/restaurant-new/plugins/datatables-net/responsive.dataTables.min.css",
        "resources/assets/restaurant-new/plugins/dropify/css/dropify.min.css",
        "resources/assets/restaurant-new/plugins/dropzone/dropzone.min.css",
        "resources/assets/restaurant-new/plugins/font-awesome/css/font-awesome.css",
        "resources/assets/restaurant-new/plugins/image-picker/image-picker.css",
        "resources/assets/restaurant-new/plugins/jquery-steps/jquery.steps.css",
        "resources/assets/restaurant-new/plugins/jquery-tags-input/jquery.tagsinput.min.css",
        "resources/assets/restaurant-new/plugins/select2/select2.min.css",
        "resources/assets/restaurant-new/plugins/sweetalert2/sweetalert2.min.css",
        "resources/assets/restaurant-new/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css",
        "resources/assets/restaurant-new/plugins/star-rating/star-rating-svg.css"
    ],
    "public/restaurant-new/css/vendor.css"
);

mix.combine(
    [
        // "resources/assets/restaurant-new/plugins/apexcharts/apexcharts.min.js",
        "resources/assets/restaurant-new/plugins/jquery-ui-dist/jquery-ui.min.js",
        "resources/assets/restaurant-new/plugins/toastr/toastr.min.js",
        "resources/assets/restaurant-new/plugins/feather-icons/feather.min.js",
        "resources/assets/restaurant-new/plugins/perfect-scrollbar/perfect-scrollbar.min.js",
        "resources/assets/restaurant-new/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js",
        "resources/assets/restaurant-new/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js",
        "resources/assets/restaurant-new/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js",
        "resources/assets/restaurant-new/plugins/chartjs/Chart.min.js",
        "resources/assets/restaurant-new/plugins/clipboard/clipboard.min.js",
        "resources/assets/restaurant-new/plugins/cropperjs/cropper.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/jquery.dataTables.js",
        "resources/assets/restaurant-new/plugins/datatables-net/buttons.colVis.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net-bs4/dataTables.bootstrap4.js",
        "resources/assets/restaurant-new/plugins/datatables-net/dataTables.responsive.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/dataTables.buttons.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/buttons.flash.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/buttons.html5.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/buttons.print.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/jszip.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/pdfmake.min.js",
        "resources/assets/restaurant-new/plugins/datatables-net/vfs_fonts.js",
        "resources/assets/restaurant-new/plugins/dropify/js/dropify.min.js",
        "resources/assets/restaurant-new/plugins/dropzone/dropzone.min.js",
        // "resources/assets/restaurant-new/plugins/flot-curvedlines/curvedLines.js",
        "resources/assets/restaurant-new/plugins/inputmask/jquery.inputmask.bundle.min.js",
        "resources/assets/restaurant-new/plugins/image-picker/image-picker.js",
        "resources/assets/restaurant-new/plugins/jquery-steps/jquery.steps.min.js",
        "resources/assets/restaurant-new/plugins/jquery-tags-input/jquery.tagsinput.min.js",
        "resources/assets/restaurant-new/plugins/jquery-validation/jquery.validate.min.js",
        "resources/assets/restaurant-new/plugins/moment/moment.min.js",
        "resources/assets/restaurant-new/plugins/progressbar-js/progressbar.min.js",
        "resources/assets/restaurant-new/plugins/select2/select2.min.js",
        "resources/assets/restaurant-new/plugins/sweetalert2/sweetalert2.min.js",
        "resources/assets/restaurant-new/plugins/promise-polyfill/polyfill.min.js",
        "resources/assets/restaurant-new/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js",
        "resources/assets/restaurant-new/plugins/star-rating/jquery.star-rating-svg.js"
        // "resources/assets/restaurant-new/plugins/typeahead-js/typeahead.bundle.min.js"
    ],
    "public/restaurant-new/js/vendor.js"
);
