<!DOCTYPE html>
<html lang="en" dir="">
   @include('backend.layouts.head')

<link rel="shortcut icon" href="{{url('assets/backend')}}/images/favicon.ico">

<link href="{{url('assets/backend')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{{url('assets/backend')}}/css/icons.css" rel="stylesheet" type="text/css">
<link href="{{url('assets/backend')}}/css/style.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<!-- DataTables -->
<link href="{{url('assets/backend/')}}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/backend/')}}/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{url('assets/backend/')}}/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="{{url('assets/backend/')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{{url('assets/backend/')}}/css/icons.css" rel="stylesheet" type="text/css">
<link href="{{url('assets/backend/')}}/css/style.css" rel="stylesheet" type="text/css">

   <body class="fixed-left">
         @include('backend.layouts.header')
         @include('backend.layouts.sidebar')
            @include('backend.layouts.flash-message')
            

            @yield('main-container')

            
            @include('backend.layouts.footer')
      <!-- @include('backend.layouts.headerSearchBar') -->
      <!-- script js -->
      
   </body>
</html>
