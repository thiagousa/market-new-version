let mix = require('laravel-mix');


    
    // ADMIN
mix.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/slick.min.css',
    'resources/assets/css/slick-theme.min.css',
    'resources/assets/css/bootstrap-fileupload.css',
    'resources/assets/css/cropper.css'
],
'public/assets/css/vendor.css');

mix.styles(['resources/assets/js/plugins/datatables/jquery.dataTables.min.css'], 'public/assets/js/plugins/datatables/jquery.dataTables.min.css');
mix.styles(['resources/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css'], 'public/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css');
mix.styles(['resources/assets/js/plugins/bootstrap-select/bootstrap-select.min.css'], 'public/assets/js/plugins/bootstrap-select/bootstrap-select.min.css');

mix.less('resources/assets/less/main.less', 'public/assets/css/main.css');

mix.copy("resources/assets/_uploads/**", "public/assets/_uploads");
mix.copy("resources/assets/settings/**", "public/assets/settings");
mix.copy("resources/assets/img/**", "public/assets/img");
mix.copy("resources/assets/json/**", "public/assets/json");

mix.scripts([
    'resources/assets/js/core/jquery.min.js',
    'resources/assets/js/core/bootstrap.min.js',
    'resources/assets/js/core/jquery.slimscroll.min.js',
    'resources/assets/js/core/jquery.scrollLock.min.js',
    'resources/assets/js/core/jquery.appear.min.js',
    'resources/assets/js/core/jquery.countTo.min.js',
    'resources/assets/js/core/jquery.placeholder.min.js',
    'resources/assets/js/core/js.cookie.min.js',
    'resources/assets/js/core/slick.min.js',
    'resources/assets/js/core/jquery.validate.min.js',
    'resources/assets/js/plugins/bootbox/bootbox.min.js',
    'resources/assets/js/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
    'resources/assets/js/plugins/cropper/cropper.js',
    'resources/assets/js/core/custom.js'
],
'public/assets/js/vendor.js');

mix.scripts(['resources/assets/js/app.js'], 'public/assets/js/app.js');
mix.scripts(['resources/assets/js/pages/base_tables_datatables.js'], 'public/assets/js/pages/base_tables_datatables.js');
mix.scripts(['resources/assets/js/plugins/datatables/jquery.dataTables.min.js'], 'public/assets/js/plugins/datatables/jquery.dataTables.min.js');
mix.scripts(['resources/assets/js/plugins/datatables/jquery.dataUk.js'], 'public/assets/js/plugins/datatables/jquery.dataUk.min.js');
mix.scripts(['resources/assets/js/plugins/jquery-ui/jquery-ui.min.js'], 'public/assets/js/plugins/jquery-ui/jquery-ui.min.js');

mix.scripts(['resources/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js'], 'public/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js');
mix.scripts(['resources/assets/js/plugins/bootstrap-select/bootstrap-select.min.js'], 'public/assets/js/plugins/bootstrap-select/bootstrap-select.min.js');
mix.scripts(['resources/assets/js/plugins/bootstrap-typeahead/bootstrap-typeahead.min.js'], 'public/assets/js/plugins/bootstrap-typeahead/bootstrap-typeahead.min.js');
mix.scripts(['resources/assets/js/core/jquery.mask.min.js'], 'public/assets/js/plugins/masked-inputs/jquery.maskedinput.min.js');
mix.scripts(['resources/assets/js/core/jquery.maskmoney.js'], 'public/assets/js/jquery.maskmoney.js');
