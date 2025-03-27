function tipo_persona(valor) {
    let t_persona = valor;
    if (t_persona == 1) {
        $('.moral').addClass('d-none');
        $('.fisica').removeClass('d-none');
        $('#vnavSocioLegal').hide();
        $('#vnavAreaLegal').hide();
        $('#vtabSocioLegal').hide();
        $('#vtabAreaLegal').hide();
    }
    if (t_persona == 2) {
        $('.moral').removeClass('d-none');
        $('.fisica').addClass('d-none');
        $('#vnavSocioLegal').show();
        $('#vnavAreaLegal').show();
        $('#vtabSocioLegal').show();
        $('#vtabAreaLegal').show();
    }
}