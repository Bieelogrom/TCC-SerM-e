$(document).ready(function() {
    $(document).on('click', '#boton', function() {
        var id = $('.id').val();
        var apelido = $('.Apelido').val();
        var tipo = $('div.input-group select').val();
        var salvarDados = 0;

        // alert(tipo)

        if(id !== ""){
            var dados = {
                id: id,
                apelido: apelido,
                tipo: tipo,
                salvarDados: salvarDados,
            }
        }

        $.post("../../../Controller/usuarioController.php", dados, function(retorna){
            $('#resultado').html(retorna);
            $('#resultado').css({'color': 'green', 'text-align': 'center', 'padding-top': '10px'});
            
        })

    })

    $(document).on('click', '#me-fecha', function (){
        var modal = $(this).attr('id');
        $(modal).toggleClass('hide');
        location.reload()

    })
})

// const closeModalButton = document.querySelector("#me-fecha");

// const toggleModal = () => {
//     modal.classList.toggle("hide");
//     fade.classList.toggle("hide");
//     location.reload()
  
//   };

// function adicionarArroba(input) {
//     if (input.value.charAt(0) !== '@') {
//       input.value = '@' + input.value;
//     }
//   }