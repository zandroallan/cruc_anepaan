function cargar_municipios_general(estado, municipio) {
    let id_estado = estado.value;
    let url = project_name + "/combos/municipios/" + id_estado;
    $.get(url, function (data, textStatus) {
        municipio.empty();
        $.each(data, function (i, valor) {
            municipio.append("<option value='" + i + "'>" + valor + "</option>");
        });
    }, "json");
}

function cargar_municipios_edit(estado, municipio, id_municipio=0) {   
    var string='';
    let url = project_name + "/combos/municipios/" + estado;
    $.get(url, function (data, textStatus) {  
        $.each(data, function (i, valor) {
            string+= '<option value='+ i +'>'+ valor +'</option>';   
        });

        $("#" + municipio).html(string);
        if(id_municipio!=0)
        	$("#" + municipio).val(id_municipio).trigger('change');
    }, "json");
}
