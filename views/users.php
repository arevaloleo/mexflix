<?php
    print ('<h2>GESTION DE USUARIOS</h2>');

$users_controller = new UsersController();
$users = $users_controller->get();


if (empty($users)) {
    print ('
        <div class="container">
            <p class="item error">No hay Usuarios</p>
        </div>    
    ');
}
else {
    $template_users = '
    <div class="item">
        <table>
            <tr>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Cumpleaños</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th colspan="2">
                    <form method="POST">
                    <input type="hidden" name="r" value="users-add">
                    <input type="submit" class="button add" value="Agregar">
                    </form>
                </th>
            </tr>';
        for ($i = 0; $i < count($users); $i++){
            $template_users .= '<tr>
                                    <td>'.$users[$i]['user']. '</td>
                                    <td>'.$users[$i]['email']. '</td>
                                    <td>'.$users[$i]['name']. '</td>
                                    <td>'.$users[$i]['birthday']. '</td>
                                    <td>'.$users[$i]['pass']. '</td>
                                    <td>'.$users[$i]['role']. '</td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="r" value="users-edit">
                                        <input type="hidden" name="user" value="'.$users[$i]['user'].'">
                                        <input type="submit" class="button edit" value="Editar">
                                    </form>
                                </td>
                                <td>
                                <form method="POST">
                                    <input type="hidden" name="r" value="users-delete">
                                    <input type="hidden" name="user" value="'.$users[$i]['user'].'">
                                    <input type="submit" class="button delete" value="Eliminar">
                                </form>
                            </td>
                                </tr>';
        }
    $template_users .= '
        </table>
    </div>
    ';
}

print($template_users);
