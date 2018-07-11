function elimina(id){
    if(confirm("Seguro que desea eliminar el usuario?")){
        $.ajax({
            type: "get",
            url: "deleteUser.php",
            data: {id},
            success: function(res){
                if(res == "Usuario eliminado con exito"){
                    $("#" + id).remove();
                }
            },
        });
    }
}