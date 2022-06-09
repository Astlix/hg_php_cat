<?php

class Mainmodel{

########################################################################
    #                             Conexion a DB                            #
    ########################################################################
    public function conectar(){
        try{
          
          $ini = '../config.ini';
          $set = parse_ini_file($ini, TRUE);
          
          switch ($set["configuracion"]["driver_db"]) {
            case "sql":
              $link = new PDO($set['sqlsrv']['driver'].':Server='.$set['sqlsrv']['server'].'; Database='.$set['sqlsrv']['dbn']);
              $link -> exec("SET CHARACTER SET utf8");
              break;
            case "mysql":
              $link = new PDO($set['mysql']['driver'].":host=".$set['mysql']['server']."; charset=UTF8; dbname=".$set['mysql']['dbn'], $set['mysql']['db_user'], $set['mysql']['db_pass']);          
              break;
          }
        } catch (PDOException $e){
          echo $e;
        }
        return $link;
      }
    public function conectar2(){
        try{
          
          $ini = './config.ini';
          $set = parse_ini_file($ini, TRUE);
          
          switch ($set["configuracion"]["driver_db"]) {
            case "sql":
              $link = new PDO($set['sqlsrv']['driver'].':Server='.$set['sqlsrv']['server'].'; Database='.$set['sqlsrv']['dbn']);
              $link -> exec("SET CHARACTER SET utf8");
              break;
            case "mysql":
              $link = new PDO($set['mysql']['driver'].":host=".$set['mysql']['server']."; charset=UTF8; dbname=".$set['mysql']['dbn'], $set['mysql']['db_user'], $set['mysql']['db_pass']);          
              break;
          }
        } catch (PDOException $e){
          echo $e;
        }
        return $link;
      }
      // ========================== Conexion a DB ========================= //

 // ========================== ENCRIPTAR CADENA ========================= //
      public static function encryption($string){
        $output=FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
      }
       // ========================== DESENCRIPTAR CADENA========================= //
      protected static function decryption($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
      }
       // ========================== LIMPIAR CADENAS========================= //
      protected static function limpiar_cadena($cadena){
        $cadena=trim($cadena); //quitamos espacios
        $cadena=stripslashes($cadena);
        $cadena=str_ireplace('<script>','',$cadena);
        $cadena=str_ireplace('</script>','',$cadena);
        $cadena=str_ireplace('<script src','',$cadena);
        $cadena=str_ireplace('<script type=','',$cadena);
        $cadena=str_ireplace('SELECT * FROM','',$cadena);
        $cadena=str_ireplace('DELETE FROM','',$cadena);
        $cadena=str_ireplace('INSERT INTO','',$cadena);
        $cadena=str_ireplace('DROP TABLE','',$cadena);
        $cadena=str_ireplace('TRUNCATE TABLE','',$cadena);
        $cadena=str_ireplace('SHOW TABLES','',$cadena);
        $cadena=str_ireplace('SHOW DATATABLES','',$cadena);
        $cadena=str_ireplace('<?php','',$cadena);
        $cadena=str_ireplace('?>','',$cadena);
        $cadena=str_ireplace('--','',$cadena);
        $cadena=str_ireplace('>','',$cadena);
        $cadena=str_ireplace('<','',$cadena);
        $cadena=str_ireplace('{','',$cadena);
        $cadena=str_ireplace('}','',$cadena);
        $cadena=str_ireplace('[','',$cadena);
        $cadena=str_ireplace(']','',$cadena);
        $cadena=str_ireplace('==','',$cadena);
        $cadena=str_ireplace(';','',$cadena);
        $cadena=str_ireplace('::','',$cadena);
        $cadena=stripslashes($cadena);
        $cadena=trim($cadena);
        return $cadena;
      }
       // ========================== VERIFICAR DATOS========================= //

      protected static function verificar_datos($filtro,$cadena){
        if (preg_match("/^" . $filtro . "$/",$cadena)) {
          return false; //que no tiene errores
        } else {
          return true; //si tiene errores
        }        
      }

       // ========================== VERIFICAR FECHA========================= //

       protected static function verificar_fechas($fecha){
        $valores = explode('-',$fecha);
        if (count($valores)==3 && checkdate($valores[1],$valores[2],$valores[0])) {
          return false; //no tiene errores
        } else {
          return true; //tiene errores
        }        
       }

       // ========================== VERIFICAR FECHA========================= //
       public static function ejecutar_cosulta_simple($consulta){
         $sql=self::conectar()->prepare($consulta);
         $sql->execute();
         return $sql->fetch();
         $sql->close();
       }

      
  
  }

