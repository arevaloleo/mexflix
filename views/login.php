<?php

print ('
    <form class="item" method="post">
        <div class="p_25">
        <input type="text" name="user" placeholder="Usuario" required>
    </div>
        <div class="p_25">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="p_25">
            <input type="submit" value="enviar" class="button">
        </div>
</form>

');


if (isset($_GET['error'])) {
    $template = '
    <div class="contaniner">
        <p class="item error">%s</p>
    </div> 
    ';
    printf($template,$_GET['error']);
}