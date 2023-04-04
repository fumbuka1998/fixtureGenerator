<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../../assets/css/dataTables.bootstrap5.min.css" />
    {{-- <link rel="stylesheet" href="css/style.css" /> --}}
    <link rel="stylesheet" href="../../assets/css/style2.css" />
    <title>FixtureGen</title>
  </head>
  <body>
    <!-- <img src="images/11cc.png" style="width: 100px" alt="..." /> -->
    {{-- including the admin navbar from the admin folder --}}
    @include('admin.navbar')
   
    {{-- including the sidebbar from the admin folder --}}

    {{-- @include('admin.sidebar') --}}


    {{-- @include('admin.maincards') --}}
          
    {{-- @include('admin.scripts') --}}

    
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="../../assets/js/jquery-3.5.1.js"></script>
    <script src="../../assets/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../assets/js/script2.js"></script>
  </body>
</html>
