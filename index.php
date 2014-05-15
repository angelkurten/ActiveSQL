  <?php 
    require_once('core/active.php');

    $ac->cache = FALSE;
    $init = microtime_float();
    $ac->join('departamentos','departamentos.Cod_Dpto=personas.Cod_Dpto');
    $ac->join('ciudades','ciudades.Cod_Ciudad=personas.Cod_Ciudad');
    $user=$ac->get('personas')->object();
    $end = microtime_float();

    $time = $end - $init;
    echo $time;

    //var_dump($user);
    $ac->cache = TRUE;
    $init = microtime_float();
    $ac->join('departamentos','departamentos.Cod_Dpto=personas.Cod_Dpto');
    $ac->join('ciudades','ciudades.Cod_Ciudad=personas.Cod_Ciudad');
    $user=$ac->get('personas')->object();
    $end = microtime_float();

    $time = $end - $init;
    echo $time;
    
  ?>