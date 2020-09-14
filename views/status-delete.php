<?php
$status_controller = new StatusController();
if( $_POST['r'] == 'status-delete' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ) {
    $status = $status_controller->get($_POST['status_id']);
    if(empty($status)){
        $template = ' 
        <div class="container">
            <p class="item error">No existe el status_id <b>%s</b></p>
        </div>
        <script>
            window.onload = function () {
                reloadPage("status")
            }
        </script>
        
        ';
       printf($template,$_POST['status_id']);
    }
    else {
        $template_status = '
            <h2 class="p1">Eliminar Status</h2>
            <form method="POST" class="item">
                <div class="p1 f2">
                    ¿Estas seguro que deseas eliminar el Status: <mark class="p1">%s</mark>
                </div>
                <div class="p_25">
                    <input type="submit" class="button delete"  value="SI">
                    <input type="button" class="button add"  value="NO" onclick="history.back()">
                    <input type="hidden" name="status_id" value="%s">
                    <input type="hidden" name="r" value="status-delete">
                    <input type="hidden" name="crud" value="del">
                </div>
            </form>
        ';
        printf($template_status,
            $status[0]['status'],
            $status[0]['status_id']
    );
    }
}
else if( $_POST['r'] == 'status-delete' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'del') {
    //insercion
    
    $status = $status_controller -> del($_POST['status_id']);
    $template = '

    <div class="container"> 
        <p class="item add">Status <b>%s</b> Eliminado </p>
    </div>
<script>
    window.onload = function() {
        reloadPage("status")
    }
</script>
';

printf($template, $_POST['status_id']);

} 
else {
    $controller = new ViewController();
    $controller->load_view('error401'); 
}

