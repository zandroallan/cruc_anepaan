<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>  

    @yield('styles')
<style>
    body{
        background-color: #00838F;
    }

    .advanced{
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
    }


    .btn-secondary,
    .btn-secondary:focus,
    .btn-secondary:active
     {
        color: #fff;
        background-color: #00838f !important;
        border-color: #00838f !important;
        box-shadow: none;
    }

    .advanced{
        color: #00838f !important;
    }

    .form-control:focus{
        box-shadow: none;
        border: 1px solid #00838f;
    }

    .qr-code {
      max-width: 200px;
      margin: 10px;
    }
</style>
</head>
<body>
    @yield('content')  
  
 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @yield('js')      
        

    <script type="text/javascript">            
        var vuri = window.location.origin + '/sircse';

        $(document).ready(function () {
            @yield('script')      
        });
    </script>
</body>
</html>
