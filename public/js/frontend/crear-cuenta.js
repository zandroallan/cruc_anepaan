var dt_defaultt;

function tipo_persona(valor) {
    let t_persona = valor;
    if (t_persona == 1) {
        $('.moral').addClass('d-none');
        $('.fisica').removeClass('d-none');
    }
    if (t_persona == 2) {
        $('.moral').removeClass('d-none');
        $('.fisica').addClass('d-none');
    }
}