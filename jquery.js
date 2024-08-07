$(document).ready(function() {
    $("form").validate({
        rules: {
            Nombre: "required",
            email: {
                required: true,
                email: true
            },
            sexo: "required",
            Area: "required",
            descripcion: "required",
            'roles[]': {
                required: true,
                minlength: 1
            }
        },
        messages: {
            Nombre: "Por favor ingrese su nombre completo",
            email: {
                required: "Por favor ingrese su correo electrónico",
                email: "Por favor ingrese un correo electrónico válido"
            },
            sexo: "Por favor seleccione su sexo",
            Area: "Por favor seleccione su área",
            descripcion: "Por favor ingrese una descripción",
            'roles[]': "Por favor seleccione al menos un rol"
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "sexo") {
                error.insertAfter(element.closest('.input'));
            } else if (element.attr("name") == "roles[]") {
                error.insertAfter(element.closest('.input'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});