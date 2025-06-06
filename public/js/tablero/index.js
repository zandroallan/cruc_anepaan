let _contratistas = 0;
let _rtecs = 0;
let _contadores = 0;
  
$(document).ready(function() 
 {
 	const _anio = new Date().getFullYear();

    // Cargar datos iniciales (2023)
    updateDashboard(_anio);
    updateBarChartFromAPI(_anio);

 });

// Función para actualizar los datos en el tablero
function updateDashboard(year) {

	dataContratistas(year);
	dataRtec();
	dataContadores();
	dataTableRtec();
	dataTableContadores();

	// Cargar la gráfica inicial
	updateBarChartFromAPI(year);

	let data = {
	  contratistas: _contratistas,
	  rtec: _rtecs,
	  contadores: _contadores
	};

	initPieChart(data);
}

function dataContratistas(anio)
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/api/estadisticas/' + anio,
        dataType: "JSON",
        async:false,        
        success: function(vresponse, vtextStatus, vjqXHR) {
            //var vrespuesta=vresponse.respuesta; 
            if(vresponse.codigo==1)
            {
            	var totalF = parseInt(vresponse.fisica.negado) + parseInt(vresponse.fisica.observado) + parseInt(vresponse.fisica.proceso) + parseInt(vresponse.fisica.solventacion) + parseInt(vresponse.fisica.terminado);
            	var totalM = parseInt(vresponse.moral.negado) + parseInt(vresponse.moral.observado) + parseInt(vresponse.moral.proceso) + parseInt(vresponse.moral.solventacion) + parseInt(vresponse.moral.terminado);
            	$('.spContratistas').html(parseInt(totalF) + parseInt(totalM));

            	$('.spProcesoF').html(vresponse.fisica.proceso);
				$('.spCompletadoF').html(vresponse.fisica.terminado);
				$('.spNegadoF').html(vresponse.fisica.negado);
				$('.spObervadoF').html(vresponse.fisica.observado);
				$('.spSolventadoF').html(vresponse.fisica.solventacion);

				$('.spProcesoM').html(vresponse.moral.proceso);
				$('.spCompletadoM').html(vresponse.moral.terminado);
				$('.spNegadoM').html(vresponse.moral.negado);
				$('.spObervadoM').html(vresponse.moral.observado);
				$('.spSolventadoM').html(vresponse.moral.solventacion);

				_contratistas = parseInt(totalF) + parseInt(totalM);

				$('.spTotalFisica').html(totalF);
				$('.spTotalMoral').html(totalM);
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }

function dataRtec()
 {
    $.ajax({
        type: 'GET',
        url: 'https://apps.anticorrupcionybg.gob.mx/rtec/api/estadisticas',
        dataType: "JSON",  
        async:false,       
        success: function(vresponse, vtextStatus, vjqXHR) {            
            if(vresponse.codigo==1)
            {
            	var total = parseInt(vresponse.proceso) + parseInt(vresponse.concluidos) + parseInt(vresponse.cancelados);
            	$('.spRtec').html(parseInt(total));

            	$('.spRtecProceso').html(vresponse.proceso);
            	$('.spRtecConcluidos').html(vresponse.concluidos);
            	$('.spRtecCancelados').html(vresponse.cancelados);

            	_rtecs = total;
            }           
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }

function dataContadores()
 {
    $.ajax({
        type: 'GET',
        url: 'https://apps.anticorrupcionybg.gob.mx/contadores/api/estadisticas',
        dataType: "JSON",
        async:false,     
        success: function(vresponse, vtextStatus, vjqXHR) {            
            if(vresponse.codigo==1)
            {
            	var total = parseInt(vresponse.proceso) + parseInt(vresponse.concluidos) + parseInt(vresponse.cancelados);
            	$('.spContador').html(parseInt(total));

            	$('.spCPProceso').html(vresponse.proceso);
            	$('.spCPConcluidos').html(vresponse.concluidos);
            	$('.spCPCancelados').html(vresponse.cancelados);

            	_contadores = parseInt(total);
            }           
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }

function dataTableRtec()
 {
 	$('.rtec-table tbody').empty();
    $.ajax({
        type: 'GET',
        url: 'https://apps.anticorrupcionybg.gob.mx/rtec/api/tablero-estadisticas',
        dataType: "JSON",  
        async:false,       
        success: function(vresponse, vtextStatus, vjqXHR) {   
        	var vhtml=''; 
        	var vrespuesta=vresponse.data;   
        	var i=0;     
            if(vresponse.codigo==1)
            {
            	for(vi=0; vi<vrespuesta.length; vi++){
            		i++;
	            	vhtml+='<tr>';
		            vhtml+='    <td>'+ i +'</td>';
		            vhtml+='    <td>'+ vrespuesta[vi].name +'</td>';
		            vhtml+='    <td class="rtec-status-proceso">'+ vrespuesta[vi].proceso +'</td>';
		            vhtml+='    <td class="rtec-status-concluido">'+ vrespuesta[vi].concluido +'</td>';
		            vhtml+='    <td class="rtec-status-cancelado">'+ vrespuesta[vi].cancelado +'</td>';
		            vhtml+='</tr>';
		        }

		        $('#contentRtec').append(vhtml);
            }           
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }

function dataTableContadores()
 {
 	$('.cp-table tbody').empty();
    $.ajax({
        type: 'GET',
        url: 'https://apps.anticorrupcionybg.gob.mx/contadores/api/tablero-estadisticas',
        dataType: "JSON",  
        async:false,       
        success: function(vresponse, vtextStatus, vjqXHR) {   
        	var vhtml=''; 
        	var vrespuesta=vresponse.data;   
        	var i=0;     
            if(vresponse.codigo==1)
            {
            	for(vi=0; vi<vrespuesta.length; vi++){
            		i++;
	            	vhtml+='<tr>';
		            vhtml+='    <td>'+ i +'</td>';
		            vhtml+='    <td>'+ vrespuesta[vi].name +'</td>';
		            vhtml+='    <td class="cp-status-proceso">'+ vrespuesta[vi].proceso +'</td>';
		            vhtml+='    <td class="cp-status-concluido">'+ vrespuesta[vi].concluidos +'</td>';
		            vhtml+='    <td class="cp-status-cancelado">'+ vrespuesta[vi].cancelados +'</td>';
		            vhtml+='</tr>';
		        }

		        $('#contentCP').append(vhtml);
            }           
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }

/*seccion graficas*/
const ctxBar = document.getElementById('barChart').getContext('2d');

const barChart = new Chart(ctxBar, {
  type: 'bar',
  data: {
    labels: ['En proceso', 'Completado', 'Negado', 'Observado', 'Solventado'],
    datasets: []
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom'
      }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

function updateBarChartFromAPI(year) {
  fetch(`https://apps.anticorrupcionybg.gob.mx/cruc_balam/api/estadisticas/${year}`)
    .then(response => response.json())
    .then(data => {
      if (data.codigo !== 1) {
        alert('Error al obtener los datos');
        return;
      }

      const fisica = data.fisica;
      const moral = data.moral;

      barChart.data.datasets = [
        {
          label: 'Persona Física',
          data: [
            fisica.proceso,
            fisica.terminado,
            fisica.negado,
            fisica.observado,
            fisica.solventacion
          ],
          backgroundColor: 'rgba(74, 74, 74, 0.7)',
          borderRadius: 5
        },
        {
          label: 'Persona Moral',
          data: [
            moral.proceso,
            moral.terminado,
            moral.negado,
            moral.observado,
            moral.solventacion
          ],
          backgroundColor: 'rgba(150, 150, 150, 0.7)',
          borderRadius: 5
        }
      ];

      barChart.update();
    })
    .catch(error => {
      console.error('Error al consumir la API:', error);
    });
}

let pieChart;

function initPieChart(data) {
    const ctxPie = document.getElementById('pieChart').getContext('2d');

    if (pieChart) pieChart.destroy(); // Destruye el anterior si existe

    pieChart = new Chart(ctxPie, {
      type: 'pie',
      data: {
        labels: ['Contratistas', 'RTEC\'s', 'Contadores'],
        datasets: [{
          label: 'Padron total: ',
          data: [data.contratistas, data.rtec, data.contadores],
          backgroundColor: ['#C90166','#D3C2B4', '#AE1922'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              font: { family: 'Montserrat, sans-serif', size: 14 },
              color: '#2C2C2C'
            }
          }
        }
      }
    });
}