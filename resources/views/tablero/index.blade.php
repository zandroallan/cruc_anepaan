@extends('layouts.app_tablero')

@section('js')
<script src="{{ asset('public/js/tablero/index.js') }}"></script>
@endsection

@section('content')

<!-- Filtro Año -->
<div class="d-flex justify-content-end">
  <select id="yearFilter" class="form-select" aria-label="Filtro de año" onchange="updateDashboard(this.value)">
    <option selected value="2025">Año 2025</option>
    <option value="2024">Año 2024</option>
    <option value="2023">Año 2023</option>
  </select>
</div>

<!-- Indicadores Clave -->
<div class="row text-center mb-4">
  <div class="col-md-4 mb-3">
    <div class="card p-4">
      <h5 class="card-title">
        <i class="bi bi-people-fill"></i>
        CONTRATISTAS
      </h5>
      <p class="display-4"><span class="spContratistas">0</span></p>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card p-4">
      <h5 class="card-title">
        <i class="bi bi-building"></i>
        RTEC´S
      </h5>
      <p class="display-4"><span class="spRtec">0</span></p>
    </div>
  </div>
  <div class="col-md-4 mb-3">
    <div class="card p-4">
      <h5 class="card-title">
        <i class="bi bi-calculator-fill"></i>
        CONTADORES
      </h5>
      <p class="display-4"><span class="spContador">0</span></p>
    </div>
  </div>
</div>



<ul class="nav nav-tabs justify-content-center" id="modernTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">
      <i class="bi bi-people-fill"></i> Contratistas
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">
      <i class="bi bi-building"></i> RTEC´s
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">
      <i class="bi bi-calculator-fill"></i> Contadores
    </button>
  </li>
</ul>

<div class="tab-content mt-1" id="modernTabContent">

  <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">    

    <div class="contratista-header-box">
      <div class="contratista-header-icon-wrapper">
        <div class="contratista-header-icon">
          <i class="bi bi-person-badge-fill"></i>
        </div>
      </div>
      <div class="contratista-header-text">
        <h2 class="contratista-header-title">Estadísticas de contratistas por Tipo de Persona</h2>
        <p class="contratista-header-desc">
          isualiza datos consolidados y comparativos de contratistas, clasificados en personas físicas y morales, ofreciendo una perspectiva clara para el análisis institucional y la toma de decisiones estratégicas.
        </p>
      </div>
    </div>


    <div class="row g-4 mb-4">
      <!-- Card Personas Físicas -->
      <div class="col-md-6 fade-in-up">
        <div class="card shadow-sm border-0 rounded-4 px-4 py-3 h-100">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="d-flex align-items-center">
              <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                <i class="bi bi-person-vcard-fill text-dark fs-4"></i>
              </div>
              <h5 class="mb-0 fw-semibold text-dark-emphasis">Personas Físicas</h5>
            </div>

            <div class="text-end">
              <div class="badge bg-secondary-subtle text-dark-emphasis px-3 py-2 rounded-pill d-inline-flex align-items-center shadow-sm">
                <i class="bi bi-calculator me-1"></i>
                <span class="fw-bold">Total: <span class="spTotalFisica">0</span></span>
              </div>
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">En proceso <span class="badge badge-proceso rounded-pill spProcesoF">0</span></li>
            <li class="list-group-item">Completado <span class="badge badge-completado rounded-pill spCompletadoF">0</span></li>
            <li class="list-group-item">Negado <span class="badge badge-negado rounded-pill spNegadoF">0</span></li>
            <li class="list-group-item">Observado <span class="badge badge-observado rounded-pill spObervadoF">0</span></li>
            <li class="list-group-item">Solventado <span class="badge badge-solventado rounded-pill spSolventadoF">0</span></li>
          </ul>
        </div>
      </div>

      <!-- Card Personas Morales -->
      <div class="col-md-6 fade-in-up" style="animation-delay: 0.1s;">
        <div class="card shadow-sm border-0 rounded-4 px-4 py-3 h-100"> 
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="d-flex align-items-center">
              <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                <i class="bi bi-buildings-fill text-dark fs-4"></i>
              </div>
              <h5 class="mb-0 fw-semibold text-dark-emphasis">Personas Morales</h5>
            </div>

            <div class="text-end">
              <div class="badge bg-secondary-subtle text-dark-emphasis px-3 py-2 rounded-pill d-inline-flex align-items-center shadow-sm">
                <i class="bi bi-calculator me-1"></i>
                <span class="fw-bold">Total: <span class="spTotalMoral">0</span></span>
              </div>
            </div>
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">En proceso <span class="badge badge-proceso rounded-pill spProcesoM">0</span></li>
            <li class="list-group-item">Completado <span class="badge badge-completado rounded-pill spCompletadoM">0</span></li>
            <li class="list-group-item">Negado <span class="badge badge-negado rounded-pill spNegadoM">0</span></li>
            <li class="list-group-item">Observado <span class="badge badge-observado rounded-pill spObervadoM">0</span></li>
            <li class="list-group-item">Solventado <span class="badge badge-solventado rounded-pill spSolventadoM">0</span></li>
          </ul>
        </div>
      </div>
    </div>


    <!-- Gráficos -->
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card p-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title d-flex align-items-center mb-0">
              <i class="bi bi-bar-chart me-2"></i>
              Gráfica por Tipo de Persona
            </h5>
          </div>
          <canvas id="barChart"></canvas>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card p-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title d-flex align-items-center mb-0">
              <i class="bi bi-pie-chart me-2"></i> <!-- Ícono de gráfico de pastel -->
              Gráfica global
            </h5>
          </div>
          <canvas id="pieChart" style="max-width: 285px; max-height: 285px; margin: 0 auto;"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
    <div class="rtec-header-box">
      <div class="rtec-header-icon-wrapper">
        <div class="rtec-header-icon">
          <i class="bi bi-building"></i>
        </div>
      </div>
      <div class="rtec-header-text">
        <h2 class="rtec-header-title">Estadísticas de RTEC's</h2>
        <p class="rtec-header-desc">
          Estadísticas comparativas de las constancias RTEC emitidas por los colegios, clasificadas según su estatus: en proceso, concluidas o canceladas.
        </p>
      </div>
    </div>

    <div class="row g-3 justify-content-center">
      <!-- En Proceso -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="cp-mini-tile cp-tile-warning">
          <i class="bi bi-hourglass-split cp-tile-bg-icon"></i>
          <div class="cp-tile-data">
            <p class="cp-tile-number"><span class="spRtecProceso">0</span></p>
            <p class="cp-tile-label">En Proceso</p>
          </div>
        </div>
      </div>

      <!-- Concluidos -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="cp-mini-tile cp-tile-success">
          <i class="bi bi-check2-circle cp-tile-bg-icon"></i>
          <div class="cp-tile-data">
            <p class="cp-tile-number"><span class="spRtecConcluidos">0</span></p>
            <p class="cp-tile-label">Concluidos</p>
          </div>
        </div>
      </div>

      <!-- Cancelados -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="cp-mini-tile cp-tile-danger">
          <i class="bi bi-x-octagon cp-tile-bg-icon"></i>
          <div class="cp-tile-data">
            <p class="cp-tile-number"><span class="spRtecCancelados">0</span></p>
            <p class="cp-tile-label">Cancelados</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-2 justify-content-center pt-4">
      <div class="rtec-table-wrapper">
        <table class="rtec-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre Colegio</th>
              <th>Proceso</th>
              <th>Concluido</th>
              <th>Cancelado</th>
            </tr>
          </thead>
          <tbody id="contentRtec">           
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">

    <div class="cp-header-box">
      <div class="cp-header-icon-wrapper">
        <div class="cp-header-icon">
          <i class="bi bi-calculator-fill"></i>
        </div>
      </div>
      <div class="cp-header-text">
        <h2 class="cp-header-title">Contadores Públicos</h2>
        <p class="cp-header-desc">
          Estadísticas comparativas de las constancias emitidas a contadores públicos certificados, clasificadas según su estatus: en proceso, concluidas o canceladas.
        </p>
      </div>
    </div>

    <div class="row g-3 justify-content-center">
      <!-- En Proceso -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="cp-mini-tile cp-tile-warning">
          <i class="bi bi-hourglass-split cp-tile-bg-icon"></i>
          <div class="cp-tile-data">
            <p class="cp-tile-number"><span class="spCPProceso">0</span></p>
            <p class="cp-tile-label">En Proceso</p>
          </div>
        </div>
      </div>

      <!-- Concluidos -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="cp-mini-tile cp-tile-success">
          <i class="bi bi-check2-circle cp-tile-bg-icon"></i>
          <div class="cp-tile-data">
            <p class="cp-tile-number"><span class="spCPConcluidos">0</span></p>
            <p class="cp-tile-label">Concluidos</p>
          </div>
        </div>
      </div>

      <!-- Cancelados -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="cp-mini-tile cp-tile-danger">
          <i class="bi bi-x-octagon cp-tile-bg-icon"></i>
          <div class="cp-tile-data">
            <p class="cp-tile-number"><span class="spCPCancelados">0</span></p>
            <p class="cp-tile-label">Cancelados</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-2 justify-content-center pt-4">
      <div class="cp-table-wrapper">
        <table class="cp-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre Colegio</th>
              <th>Proceso</th>
              <th>Concluido</th>
              <th>Cancelado</th>
            </tr>
          </thead>
          <tbody id="contentCP">           
          </tbody>
        </table>
      </div>
    </div>

  </div>


</div>








@endsection