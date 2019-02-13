<!DOCTYPE html>
<html class="st-layout ls-top-navbar-large ls-bottom-footer show-sidebar sidebar-l3" lang="{{ app()->getLocale() }}">

<head>
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
  <link href="{{ asset('css/vendor/all.css') }}" rel="stylesheet">

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
  <link href="{{asset('css/app/app.css')}}" rel="stylesheet">

  {{-- yajra datatable --}}
{{--   <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

    <!-- Style Video Player plyr -->
  <link rel="stylesheet" href="https://cdn.plyr.io/3.3.23/plyr.css">  

  <!-- Daterangepicker -->
    
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- App CSS CORE
This variant is to be used when loading the separate styling modules -->
  {{-- <link href="{{ URL::asset('css/app/main.css') }}" rel="stylesheet"> --}}

  <!-- App CSS Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL modules are 100% compatible -->
  
  <!-- Style CDN -->
  <!-- Style Video Player plyr -->
  {{-- <link rel="stylesheet" href="https://cdn.plyr.io/3.3.23/plyr.css"> --}}
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

    .breadcrumb { background-color: #ffffff}
  </style>

  <style type="text/css">
            .swal-title {
                font-size: 18px;
                font-weight: 600;
            }
        </style>
  @stack('styles')

  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- DataTables -->
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>


<!--   Daterangepicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
 

{{--  Vue Js --}}{{-- 
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
</head>
<body>
<!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    @include('components.navbar-admin') 

    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    @include('components.sidebar-admin')

    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-none">

          <div class="container-fluid" id="app">

            @yield('content')

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
    <footer class="footer">
      <strong>Banten Information Product </a></strong>by <a href="#">Dinas Perindustrian dan Perdagangan Provinsi Banten</a> &copy; Copyright 2018
    </footer>
    <!-- // Footer -->

  </div>
  <!-- /st-container -->

    <!-- Video Player Plyr -->
  <script src="https://cdn.plyr.io/3.3.23/plyr.js"></script>

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
  @stack('scripts-vendor')
  <script src="{{ URL::asset('vendor/jquery-loading/jquery.loading.js') }}"></script>
{{--   <script src="{{ URL::asset('vendor/owl-thumb/owl.carousel2.thumbs.js') }}"></script> --}}
  <script src="{{ URL::asset('js/vendor/ratting/star-rating.js') }}"></script>
  
  <script src="{{ URL::asset('js/app/essentials.js') }}"></script>
  <script src="{{ URL::asset('js/app/material.js') }}"></script>
  <script src="{{ URL::asset('js/app/layout.js') }}"></script>
  <script src="{{ URL::asset('js/app/sidebar.js') }}"></script>
  <script src="{{ URL::asset('js/app/media.js') }}"></script>
  <script src="{{ URL::asset('js/app/messages.js') }}"></script>
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
  {{-- <script src="https://cdn.plyr.io/3.3.23/plyr.js"></script> --}}

{{--   <script type="text/javascript" src="/js/app.js"></script> --}}

  @stack('scripts')
  <script>
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
  </script>
  
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
          dangerMode: false,
        })
        .then((action) => {
          if (action) {
            window.location.href = "{{url('admin/logout')}}";
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
          dangerMode: false,
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
          dangerMode: false,
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

    function actionButton(l)
    {
      $('.st-container').loading();
      var id    = $(l).attr('data-id');
      var href  = $(l).attr('data-href');

      window.location.href = href+'/'+id;
    }

    function markAsRead(l)
    { 
      var id          = $(l).attr('id');
      var uid         = $(l).attr('uid');
      var href        = $(l).attr('data-href');

      $.ajax({
        url : '{{url('admin/mark-as-read')}}',
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

  <script type="text/javascript">
    $(function() {
        $('select[name=provinsi]').change(function() {
            $('body').loading();
            var url = '{{ url('admin/provinsi') }}'+'/'+ $(this).val() + '/kabkot/';

            $.get(url, function(data) {
               console.log(data);
                var select = $('form select[name= kabkot]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
            $('body').loading('stop');
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('select[name=kabkot]').change(function() {
            $('body').loading();
            var url = '{{ url('admin/kabkot') }}'+'/'+ $(this).val() + '/kecamatan/';

            $.get(url, function(data) {
                var select = $('form select[name= kecamatan]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
            $('body').loading('stop');
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('select[name=kecamatan]').change(function() {
            $('body').loading();
            var url = '{{ url('admin/kecamatan') }}'+'/'+ $(this).val() + '/desa/';

            $.get(url, function(data) {
                var select = $('form select[name= desa]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            });
            $('body').loading('stop');
        });
    });
</script>

  @if(session()->has('message'))
  <script type="text/javascript">
      swal({
        title: "Transaction Success",
        icon: "success",
        button: "OK",
      });
  </script>
  @elseif(session()->has('message-failed'))
  <script type="text/javascript">
      swal({
        title: "Transaction Failed",
        icon: "warning",
        button: "OK",
      });
  </script>
  @endif
</body>

</html>