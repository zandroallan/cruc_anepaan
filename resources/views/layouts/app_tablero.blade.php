<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tablero Estadístico - Cruc_Balam</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts: Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link rel="stylesheet" href="{{asset('public/css/cssTablero.css')}}">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg text-center">
    <div class="container-fluid">
      <a class="navbar-brand mx-auto" href="#">
        <span class="titulo-escritorio">Tablero Estadístico - CRUC BALAM</span>
        <span class="titulo-movil">CRUC BALAM</span>
      </a>
    </div>
  </nav>

  <div class="container my-4">
    @yield('content') 
  </div>

  <footer class="footer-gov bg-dark text-white py-3">
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Logo -->
            <div>
                <img src="{{ asset('public/img/logo_pie.png') }}" alt="Logo" style="max-height: 150px;">
            </div>

            <!-- Textos -->
            <div class="text-center text-md-end mt-3 mt-md-0">
                <p class="mb-1 mb-md-0">&copy; 2025 Secretaría Anticorrupción y Buen Gobierno</p>
                
                <!-- Unidades -->
                <small class="d-block fw-bold">Unidad de Informática y Desarrollo Digital</small>
                <small class="d-block fw-bold">Área de Desarrollo de Sistemas</small>
                
                <!-- Aviso -->
                <small>Todos los derechos reservados. 
                    <a href="#" class="text-white text-decoration-underline">Aviso de privacidad</a>
                </small>
            </div>
        </div>
    </div>
</footer>





  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>

  @yield('js')

  <script>
    var vuri = window.location.origin + '/cruc_balam';

    $(document).ready(
      function () {
          @yield('script')
      }
    );
  </script>

</body>
</html>
