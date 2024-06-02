// Obtém o modal
var modal = document.getElementById("updateCommentModal");

// Obtém o botão que abre o modal
var updateButtons = document.querySelectorAll(".update-btn");

// Obtém o <span> que fecha o modal
var span = document.getElementsByClassName("close")[0];

// Quando o usuário clica no botão, abre o modal 
updateButtons.forEach(button => {
    button.onclick = function() {
        var commentId = this.getAttribute("data-id");
        modal.style.display = "block";
        document.getElementById("id_comentario").value = commentId;
    }
});

// Quando o botão "Atualizar" é clicado, exibir o modal e definir o ID do comentário
$('.update-btn').click(function(){
    var commentId = $(this).data('id');
    $('#id_comentario').val(commentId); // Preenche o campo oculto com o ID do comentário
    $('#updateCommentModal').css("display", "block"); // Exibe o modal
});

// Quando o usuário clica no botão de fechar (X), feche o modal
$('.close').click(function(){
    $('#updateCommentModal').css("display", "none");
});

// Quando o usuário clica em qualquer lugar fora do modal, feche-o
window.onclick = function(event) {
    if (event.target == $('#updateCommentModal')[0]) {
        $('#updateCommentModal').css("display", "none");
    }
}// Quando o botão "Atualizar" é clicado, exibir o modal e definir o ID do comentário
$('.update-btn').click(function(){
    var commentId = $(this).data('id');
    $('#id_comentario').val(commentId); // Preenche o campo oculto com o ID do comentário
    $('#updateCommentModal').css("display", "block"); // Exibe o modal
});

// Quando o usuário clica no botão de fechar (X), feche o modal
$('.close').click(function(){
    $('#updateCommentModal').css("display", "none");
});

// Quando o usuário clica em qualquer lugar fora do modal, feche-o
window.onclick = function(event) {
    if (event.target == $('#updateCommentModal')[0]) {
        $('#updateCommentModal').css("display", "none");
    }
}


