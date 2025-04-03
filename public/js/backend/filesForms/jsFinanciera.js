
function get_capital_contable()
 {
	$.ajax({
        type: "GET",
        url: vuri + '/financiero/capital/contable',
        success: function(json) {
           
        },
        error: function(json) {
           
        }
    });
 }

function get_estados_financieros()
 {
	$.ajax({
        type: "GET",
        url: vuri + '/financiero/estados/financieros',
        success: function(json) {
           
        },
        error: function(json) {
           
        }
    });
 }