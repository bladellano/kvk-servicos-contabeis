$(function () {

    $('#contactForm').submit(function (e) {

        e.preventDefault();

        var data = $(this).serializeArray();

        var empty = false;

        data.forEach(el => {
            if (!el.value.length)
                empty = true;
        });

        if (empty) return swal("Alerta!", "Por favor, preencha todos os campos.", "error");

        var nameSaved = $(this).find('button').html();

        $.ajax({
            type: "POST",
            url: "./enviarEmail",
            data: data,
            dataType: "JSON",
            beforeSend: () => {
                $(this).find('button').html('Enviando, por favor aguarde...');
            },
            success: (r) => {
                if (r.success) {
                    swal("Sucesso!", r.msg, "success");
                    $(this)[0].reset();
                    $(this).find('button').html(nameSaved);
                } else {
                    swal("Erro!", r.msg, "error");
                }
            }
        });
    });

});