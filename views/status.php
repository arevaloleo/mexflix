<?php
    print ('<h2>GESTION DE STATUS</h2>');

$status_controller = new StatusController();
$status = $status_controller->get();


if (empty($status)) {
    print ('
        <div class="container">
            <p class="item error">No hay status</p>
        </div>    
    ');
}
else {
    $template_status = '
    <div class="item">
        <table>
            <tr>
                <th>Id</th>
                <th>Status</th>
                <th colspan="2">
                    <form method="POST">
                    <input type="hidden" name="r" value="status-add">
                    <input type="submit" class="button add" value="Agregar">
                    </form>
                </th>
            </tr>';
        for ($i = 0; $i < count($status); $i++){
            $template_status .= '<tr>
                                    <td>'.$status[$i]['status_id']. '</td>
                                    <td>'.$status[$i]['status']. '</td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="r" value="status-edit">
                                        <input type="hidden" name="status_id" value="'.$status[$i]['status_id'].'">
                                        <input type="submit" class="button edit" value="Editar">
                                    </form>
                                </td>
                                <td>
                                <form method="POST">
                                    <input type="hidden" name="r" value="status-delete">
                                    <input type="hidden" name="status_id" value="'.$status[$i]['status_id'].'">
                                    <input type="submit" class="button delete" value="Eliminar">
                                </form>
                            </td>
                                </tr>';
        }
    $template_status .= '
        </table>
    </div>
    ';
}

print($template_status);
