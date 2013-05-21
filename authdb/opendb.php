<?php
$conn = mysql_connect ($dbhost, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ($dbname);
if (!function_exists(wrap_query)){
  function wrap_query($sql) {
    //pull all arguments to function into array
    $params = func_get_args();

    //throw out first param ($sql)
    array_shift($params);

    _wrap_query_callback($params, TRUE);
    $sql = preg_replace_callback('/(%d|%s|%%|%f|%b)/','_wrap_query_callback',$sql);

    return mysql_query($sql);
  }

  function _wrap_query_callback($params, $first = FALSE) {
      static $args = NULL;
      if ($first) {
        $args=$params;
        return;
      }

      switch ($params[1]) {
    case '%d':
      return (int) array_shift($args);
    case '%s':
      return mysql_real_escape_string(array_shift($args));
    case '%%':
      return '%';
    case '%f':
      return (float) array_shift($args);
    case '%b':
      return "'" . mysql_real_escape_string(array_shift($args)) . "'";
     }
  }
}
?>
