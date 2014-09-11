  <?php 
    require_once('core/active.php');

    $ac->cache = FALSE;
    $init = microtime_float();
        $values = [0, 'Hola, Angel Kurten'];

        $ac->values($values);
        $result = $ac->save('mensajes');
    $end = microtime_float();

    $time = $end - $init;
    echo $time;
    
  ?>