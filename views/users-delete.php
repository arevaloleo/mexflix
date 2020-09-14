<?php
$user_controller = new UsersController();
if( $_POST['r'] == 'users-delete' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {
    $user = $user_controller->get($_POST['user']);
    if(empty($user)){
        $template = ' 
        <div class="container">
            <p class="item error">No existe el user <b>%s</b></p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("usuarios")
            }
        </script>
        
        ';
       printf($template,$_POST['user']);
    }
    else {
        $template_user = '
            <h2 class="p1">Eliminar Usuario</h2>
            <form method="POST" class="item">
                <div class="p1 f2">
                    ¿Estas seguro que deseas eliminar el Usuario: <mark class="p1">%s</mark>
                </div>
                <div class="p_25">
                    <input type="submit" class="button delete"  value="SI">
                    <input type="button" class="button add"  value="NO" onclick="history.back()">
                    <input type="hidden" name="user" value="%s">
                    <input type="hidden" name="r" value="users-delete">
                    <input type="hidden" name="crud" value="del">
                </div>
            </form>
        ';
        printf($template_user,
            $user[0]['user'],
            $user[0]['user']
    );
    }
}
else if( $_POST['r'] == 'users-delete' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'del') {
    //insercion
    
    $usuarios = $user_controller -> del($_POST['user']);
    $template = '

    <div class="container"> 
        <p class="item add">Usuario <b>%s</b> Eliminado </p>
    </div>
<script>
    window.onload = function() {
        reloadPage("usuarios")
    }
</script>
';

printf($template, $_POST['usuario']);

} 
else {
    $controller = new ViewController();
    $controller->load_view('error401'); 
}

