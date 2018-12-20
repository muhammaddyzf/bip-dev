<!DOCTYPE html>
<html class="transition-navbar-scroll top-navbar-xlarge bottom-footer" lang="{{ app()->getLocale() }}">

<head>
  <meta name="google-site-verification" content="3ZYqCBF93YR6L1NGEmZkCXeL8hL9HU2IKL56_yPhFsM" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>BIP - @yield('title')</title>

  <!-- Vendor CSS BUNDLE
    Includes styling for all of the 3rd party libraries used with this module, such as Bootstrap, Font Awesome and others.
    TIP: Using bundles will improve performance by reducing the number of network requests the client needs to make when loading the page. -->
  {{-- <link href="css/vendor/all.css" rel="stylesheet"> --}}

  <!-- Vendor CSS Standalone Libraries
        NOTE: Some of these may have been customized (for example, Bootstrap).
        See: src/less/themes/{theme_name}/vendor/ directory -->
  <link href="{{ URL::asset('css/vendor/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/font-awesome.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/picto.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/material-design-iconic-font.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/datepicker3.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/jquery.minicolors.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/railscasts.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/owl.carousel.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/slick.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/daterangepicker-bs3.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/jquery.bootstrap-touchspin.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/select2.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/jquery.countdown.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/vendor/star-rating.css') }}" rel="stylesheet">

  <!-- Include the CSS file to use the plugin default themes and loaders -->
  <link href="{{ URL::asset('vendor/jquery-loading/jquery.loading.css') }}" rel="stylesheet">
   @stack('styles-vendor')
  <!-- CSS CDN Reference -->

  <!-- APP CSS BUNDLE [css/app/app.css]
INCLUDES:
    - The APP CSS CORE styling required by the "html" module, also available with main.css - see below;
    - The APP CSS STANDALONE modules required by the "html" module;
NOTE:
    - This bundle may NOT include ALL of the available APP CSS STANDALONE modules;
      It was optimised to load only what is actually used by the "html" module;
      Other APP CSS STANDALONE modules may be available in addition to what's included with this bundle.
      See src/less/themes/html/app.less
TIP:
    - Using bundles will improve performance by greatly reducing the number of network requests the client needs to make when loading the page. -->
  {{-- <link href="css/app/app.css" rel="stylesheet"> --}}

  <!-- App CSS CORE
This variant is to be used when loading the separate styling modules -->
  <link href="{{ URL::asset('css/app/main.css') }}" rel="stylesheet">

  <!-- App CSS Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL modules are 100% compatible -->

  <link href="{{ URL::asset('css/app/essentials.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/material.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/layout.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/sidebar.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/sidebar-skins.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/navbar.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/messages.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/media.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/charts.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/maps.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/colors-alerts.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/colors-background.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/colors-buttons.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/colors-text.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('css/app/custom-style.css') }}" rel="stylesheet" />

      
  
  <!-- Style CDN -->
  <!-- Style Video Player plyr -->
  <link rel="stylesheet" href="https://cdn.plyr.io/3.3.23/plyr.css">  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
  <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  <style type="text/css">
    .form-control-material.has-danger{
      border-bottom: 1px solid #bd362f;
    }
    .form-control-material.has-danger label{
      color: #bd362f !important;
    }
  </style>
  @stack('styles')

  @php
  $clientKey = 'SB-Mid-client-QprN7L7gTaE3pU-t';
  @endphp
  
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{$clientKey}}"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 
</head>

  @hasSection('navbar')
<body>
  @include('components.navbar')    
  @else
<body class="login">
  @endif

  @yield('content')  
  
  @hasSection('footer')
  @include('components.footer')    
  @endif

  <!-- Footer -->
  <footer class="footer">
    <strong>Banten Information Product </a></strong>by <a href="#">Dinas Perindustrian dan Perdagangan Provinsi Banten</a> &copy; Copyright 2018
  </footer>
  <!-- // Footer -->

  <!-- Inline Script for colors and config objects; used by various external scripts; -->

  <script type='text/javascript'>
      function isNumberKey(evt)
      {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))
          
          return false;
          return true;
      }
      
      function FormatCurrency(objNum)
      {
         var num = objNum.value
         var ent, dec;
         if (num != '' && num != objNum.oldvalue)
         {
         num = HapusTitik(num);
         if (isNaN(num))
         {
           objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
         } else {
           var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
           if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
           {
           alert(num.split('.')[1]);
           objNum.value = TambahTitik(num.split('.')[0])+'.'+num.split('.')[1];
           }
           else
           {
           objNum.value = TambahTitik(num.split('.')[0]);
           }
           objNum.oldvalue = objNum.value;
         }
         }
      }
      function HapusTitik(num)
      {
         return (num.replace(/\./g, ''));
      }

      function TambahTitik(num)
      {
         numArr=new String(num).split('').reverse();
         for (i=3;i<numArr.length;i+=3)
         {
         numArr[i]+='.';
         }
         return numArr.reverse().join('');
      } 
          
      function formatCurrency(num) {
         num = num.toString().replace(/\$|\./g,'');
         if(isNaN(num))
         num = "0";
         sign = (num == (num = Math.abs(num)));
         num = Math.floor(num*100+0.50000000001);
         cents = num0;
         num = Math.floor(num/100).toString();
         for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
         num = num.substring(0,num.length-(4*i+3))+'.'+
         num.substring(num.length-(4*i+3));
         return (((sign)?'':'-') + num);
      }
    </script>


  <script>
    var colors = {
      "danger-color": "#e74c3c",
      "success-color": "#81b53e",
      "warning-color": "#f0ad4e",
      "inverse-color": "#2c3e50",
      "info-color": "#2d7cb5",
      "default-color": "#6e7882",
      "default-light-color": "#cfd9db",
      "purple-color": "#9D8AC7",
      "mustard-color": "#d4d171",
      "lightred-color": "#e15258",
      "body-bg": "#f6f6f6"
    };
    var config = {
      theme: "html",
      skins: {
        "default": {
          "primary-color": "#42a5f5"
        }
      }
    };
  </script>

  <!-- Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->
  <script src="{{ URL::asset('js/vendor/all.js') }}"></script>

  <!-- Vendor Scripts Standalone Libraries -->
  {{-- <script src="js/vendor/core/all.js"></script>
  <script src="js/vendor/core/jquery.js"></script>
  <script src="js/vendor/core/bootstrap.js"></script>
  <script src="js/vendor/core/breakpoints.js"></script>
  <script src="js/vendor/core/jquery.nicescroll.js"></script>
  <script src="js/vendor/core/isotope.pkgd.js"></script>
  <script src="js/vendor/core/packery-mode.pkgd.js"></script>
  <script src="js/vendor/core/jquery.grid-a-licious.js"></script>
  <script src="js/vendor/core/jquery.cookie.js"></script>
  <script src="js/vendor/core/jquery-ui.custom.js"></script>
  <script src="js/vendor/core/jquery.hotkeys.js"></script>
  <script src="js/vendor/core/handlebars.js"></script>
  <script src="js/vendor/core/jquery.hotkeys.js"></script>
  <script src="js/vendor/core/load_image.js"></script>
  <script src="js/vendor/core/jquery.debouncedresize.js"></script>
  <script src="js/vendor/core/modernizr.js"></script>
  <script src="js/vendor/core/velocity.js"></script>
  <script src="js/vendor/tables/all.js"></script>
  <script src="js/vendor/forms/all.js"></script>
  <script src="js/vendor/media/slick.js"></script>
  <script src="js/vendor/charts/flot/all.js"></script>
  <script src="js/vendor/nestable/jquery.nestable.js"></script>
  <script src="js/vendor/countdown/all.js"></script> 
  <script src="js/vendor/angular/all.js"></script> 
  --}}
  @stack('scripts-vendor')
  <!-- App Scripts Bundle
    Includes Custom Application JavaScript used for the current theme/module;
    Do not use it simultaneously with the standalone modules below. -->
  {{-- <script src="js/app/app.js"></script> --}}

  <!-- App Scripts Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL the modules are 100% compatible -->
  <script src="{{ URL::asset('vendor/jquery-loading/jquery.loading.js') }}"></script>
  <script src="{{ URL::asset('vendor/jquery.timeago.js') }}"></script>
{{--   <script src="{{ URL::asset('vendor/owl-thumb/owl.carousel2.thumbs.js') }}"></script> --}}
  <script src="{{ URL::asset('js/vendor/ratting/star-rating.js') }}"></script>
  
  <script src="{{ URL::asset('js/app/essentials.js') }}"></script>
  <script src="{{ URL::asset('js/app/material.js') }}"></script>
  <script src="{{ URL::asset('js/app/layout.js') }}"></script>
  <script src="{{ URL::asset('js/app/sidebar.js') }}"></script>
  <script src="{{ URL::asset('js/app/media.js') }}"></script>
  <script src="{{ URL::asset('js/app/messages.js') }}"></script>
  {{-- <script src="js/app/maps.js"></script> --}}
  <script src="{{ URL::asset('js/app/charts.js') }}"></script>

  <!-- App Scripts CORE [html]:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        app.js already includes main.js so this should be loaded
        ONLY when using the standalone modules; -->
  <script src="{{ URL::asset('js/app/main.js') }}"></script>
  
  <!-- JavaScript CDN Reference-->
  <!-- SweetAlertJS -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Video Player Plyr -->
  <script src="https://cdn.plyr.io/3.3.23/plyr.js"></script>

  @stack('scripts')
  <script type="text/javascript">
    $(function(){
      $(document).find('.form-control-material .form-control').each(function () {
          $(this).tkFormControlMaterial();

          if ($(this).val())
            $(this).addClass('used');
          else
            $(this).removeClass('used');
      });

      $(document).find('.form-control-material select.form-control').each(function () {
          if ($(this).text())
            $(this).addClass('used');
          else
            $(this).removeClass('used');
      });

      $('.logout').on('click',function () {
        swal({
          title: "Are you sure?",
          text: "You will leave this page!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((action) => {
          if (action) {
            window.location.href = "{{url('logout')}}";
          } else {
            return false;
          }
        });
      })
    });


    function confirmLink(el)
    {
      var url = $(el).attr('data-href');
      var textConfrim = $(el).attr('data-text');
      swal({
          title: "Are you sure?",
          text: textConfrim,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((action) => {
          if (action) {
            window.location.href = url;
          } else {
            return false;
          }
        });
      return el.preventDefault();
    }

    function confirmStore(btnId,formId,messages){
      $formTarget = $('#'+formId);
      $btnTrigger = $('#'+btnId);

      $btnTrigger.click(function(){
        swal({
          title: "Are you sure?",
          text: messages,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((action) => {
          if (action) {
            $formTarget.submit();
          } else {
            return false;
          }
        });

      });
    }

    function markAsRead(l)
    { 
      var id          = $(l).attr('id');
      var uid         = $(l).attr('uid');
      var href        = $(l).attr('data-href');

      $.ajax({
        url : '{{url('student/mark-as-read')}}',
        type: 'post',
        dataType : 'json',
        data  : {idNotice : id},
        headers  : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              success:function(data)
              {
                window.location.href = href+'/'+uid;
                // location.reload(true);
              }
      });
    }
  </script>
  @if(session()->has('message'))
  <script type="text/javascript">
      swal({
        title: "Transaction Success",
        icon: "success",
        button: "OK",
      });
  </script>
  @endif

  <script type="text/javascript">
    function jumlahKlik(l)
    {
        var table = $(l).attr('target-table');
        var id    = $(l).attr('id-target');

        $.ajax({
            url     : '{{url('jumlah-klik')}}',
            type    : 'post',
            dataType: 'json',
            data    : {table : table, id : id},
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              success:function(data){

              }

        })
    
    }
  </script>
</body>

</html>