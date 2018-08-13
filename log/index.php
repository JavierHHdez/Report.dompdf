<?php
        
        /*function callback($value){

            return ($value * $value * $value); 

        }

        $array = [1,2,3,4,5];

        $resut = array_map("callback", $array);

        print_r($resut);*/

        //Array map

        /*$callback = function($value){
            return $value * 2;
        };

        print_r(array_map($callback, range(1, 5)));*/

        

        //Array merge recursive

        /*$m1 = array("color" => array("favorito" => "rojo"), 5);
        $m2 = array(10, "color" => array("favorito" => "verde", "azul"));
        $resultado = array_merge_recursive($m1, $m2);

        print_r($resultado);*/


        
        //Array merge

        /*$arrar1 = [0 => 'Manzana', 1 => 'Piña', 2 => 'Planato', 3 => 'Otro_a'];
        $arrar2 = [3 => 'Otro_b', 4 => 'Durazno', 5 => 'Pera', 6 => 'Ciruelass'];

        print_r(array_merge($arrar1, $arrar2));*/




        //Array change key case

        /*$array = ['Firts' => 1, 'Second' => 2];

        print_r(array_change_key_case($array, CASE_LOWER));
        */


        /*$input_array = array('a', 'b', 'c', 'd', 'e');
        print_r(array_chunk($input_array, 2));
        print_r(array_chunk($input_array, 2, true));

        Array ( 
            [0] => Array ( [0] => a [1] => b ) 
            [1] => Array ( [0] => c [1] => d ) 
            [2] => Array ( [0] => e ) 
        ) 


        Array ( 
            [0] => Array ( [0] => a [1] => b ) 
            [1] => Array ( [2] => c [3] => d ) 
            [2] => Array ( [4] => e ) 
        )*/

       /* $entrada = array("a", "b", "c", "d", "e");

        $salida = array_slice($entrada, 2);      // devuelve "c", "d", y "e"
        $salida = array_slice($entrada, -2, 1);  // devuelve "d"
        $salida = array_slice($entrada, 0, 3);   // devuelve "a", "b", y "c"

        // observe las diferencias en las claves de los arrays
        print_r(array_slice($entrada, 2, -1));
        print_r(array_slice($entrada, 2, -1, true));

        Array ( [0] => c [1] => d ) 
        Array ( [2] => c [3] => d )*/

        /*$stack = array("naranja", "plátano", "manzana", "frambuesa");
        $fruit = array_pop($stack);
        print_r($fruit);*/

        // $entrada = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
        // $claves_aleatorias = array_rand($entrada, 2);
        // echo $entrada[$claves_aleatorias[0]] . "\n";
        // echo $entrada[$claves_aleatorias[1]] . "\n";


       /* $numero = 5;

        echo "Fcatorial de ". $numero;

        function calcularFacturial($numero){

            $total = 1;

            for ($i = $numero; $i >= 1 ; $i--) {
                $total = $total * $i;
            }

            return $total;
        }
        
        echo "<br>"; //* Esto es un salto de linea

        echo "Resultado". calcularFacturial($numero);


        echo "<br>Por metodo Recursivo";


        function factorial($num){

            $total = 1;

            if( $num  == 1)
                return 1;
            else 
                return $num * factorial($num - 1);   
        }

        $numero = 892.9823;

        echo "Numero ". number_format($numero, 2);
        
        echo "<br>Resultado ". factorial(8);*/
?>