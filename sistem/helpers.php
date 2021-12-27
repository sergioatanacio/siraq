<?php
/**
 * Permite realizar una operación pero de manera funcional y recursiva. El primer 
 * valor es un string con el valor de un operador.
 */
function operation(string $operator, array $values, $result = null)
{
    if($values === [])
    {
        return $result;
    }
    else
    {
        if ($result === null) 
        {
            $values = array_reverse($values);
            $result = lastElement($values);
            $values = popArray($values);
        }
            $sendEvalResult = eval('return '.$result.' '.$operator.' '.lastElement($values).';');
            return operation($operator, popArray($values), $sendEvalResult);
    }
}

/**
 * Permite crear una variable a la que no puede cambiarse el valor al estilo de los 
 * simbolos en el paradigma funcional.
 */
function def(&$symbol, $value)
{
    if(isset($symbol))
    {
        die('No se puede cambiar el valor "' . $symbol().'". El programa se ha detenido en este punto.');
    } else
    {
        $symbol = $value;
    }
}

/**
 * Permite usar un if ternario de manera funciónal, y el resultado se va a retornar para poder 
 * ser asignado a una variable.
 */
function iffn($condition, $true, $false = null)
{
    if($condition())
    {
        return $true();
    }
    elseif($false !== null)
    {
        return $false();
    }
    else
    {
        return null;
    }
}

/**
 * Convierte el resultado de una consulta SQL en un array.
 */
if(! function_exists('assocQuery'))
{
    function assocQuery($query, $index = null)
    {   
        if ($query != null) {
            $result = [];
            while ($elements = $query->fetch(\PDO::FETCH_ASSOC))
            {
                $result[] = ($index != null) ? $elements[$index] : $elements;
            }
        } else {
            $result = null;
        }
        
        return $result;
    }
}

/**
 * Agrega un elemento al ultimo lugar de un array.
 */
if(! function_exists('joinArrangement'))
{
    function joinArrangement($array, $newItem = null) : array
    {
        /*
        def($fixReturned, 
            iffn(fn()=>is_array($array),
                fn()=>$array,
                iffn(fn()=>$array == null || $array == '',
                    fn()=>[],
                    fn()=>
                )
            )
        );
        */


        if (is_array($array)) {
            $fixReturned = $array;
        } elseif ($array == null || $array == '') {
            $fixReturned = [];
        } else {
            $fixReturned[] = $array;
        }
        
        if (isset($newItem) && $newItem != []) {
            $fixReturned[] = $newItem;
        }
        
        return $fixReturned;
    }
}

/**
 * Recive un array y lo devuelve eliminado su último elemento.
 */
if(! function_exists('popArray')) 
{
    function popArray($popFunction)
    {
        array_pop($popFunction);
        return $popFunction;
    }
}

/**
 * Recibe un array y retorna su último elemento.
 */
if(! function_exists('lastElement')) 
{
    function lastElement($lastElement): array
    {
        if(!is_array($lastElement) || $lastElement == []){
            return  [];
        } else{
            return $lastElement[count($lastElement) - 1];
        }
    }
}

/**
 * Se trae una ruta como si fuera un string, ese es el valor de retorno.
 */
if(! function_exists('response')) 
{
    function response($resourse) : string
    {
        return __DIR__.'/../resourses/'.$resourse;
        #return file_get_contents(__DIR__.'/../resourses/'.$resourse);
    };
}

/**
 * Se le pone una ruta y esta función se trae la ruta con un requiere, lo que 
 * hace que lo obtenido se imprima en el lugar en que se trajo.
 */
if(! function_exists('response_require'))
{
    function response_require($resourse_require) : string
    {
        return require response($resourse_require);
    };
}

if(! function_exists('domain_return')) 
{
    function domain_return($domain)
    {
        return(domain.'/'.$domain);
        #return file_get_contents(__DIR__.'/../resourses/'.$resourse);
    };
}

if(! function_exists('domain_print')) 
{
    function domain_print($domain)
    {
        echo(domain_return($domain));
        #return(domain.'/'.$domain);
        #return file_get_contents(__DIR__.'/../resourses/'.$resourse);
    };
}


if(! function_exists('getAnItem'))
{
    function getAnItem(array $array, string $index = null, array $result = [])
    {
        if (!is_array($array) || $array == []) {
            return $result;
        } else {
            $lastElement = lastElement($array);
            $resultingElement = $lastElement[$index];
            return getAnItem(popArray($array), $index, joinArrangement($result, $resultingElement));
        }
    }
}



/**
 * Permite debuguear una variable en php.
 */
if(! function_exists('pre'))
{
    function pre($pre)
    {
        echo '<pre>';
        var_dump($pre);
        echo '</pre>';
    }
}

/**
 * Permite imprimir el dominio del sitio web, usando las constantes del archivo env.
 */
if(! function_exists('domain')) 
{
    function domain($route) {
        return domain . '/' . $route;
    }
}

/**
 * Inicia la sesión de una persona.
 */
function sessionStarted()
{
    if(!isset($_SESSION)){ session_start();}
    $_SESSION['session'] = true;
}

/**
 * Hace que las personas que accedan al recurso en cuestión deban tener la sesión iniciada.
 */
function activeSession()
{
    if(!isset($_SESSION)){ session_start();}
    $sessionStarted = (!isset($_SESSION['session'])) ? false : $_SESSION['session'] ;

    if ($sessionStarted == false) {
        // echo "Debes iniciar sesión.";
        header("Location:" . domain("user"));
        #header("Location: /");
        die();
    }
}

/**
 * La ejecución de esta función cierra la sesión de una persona.
 */
function sessionEnded(){
    if(!isset($_SESSION)){ session_start();}
    $_SESSION['session'] = false;
}

/**
 * Es una función que sirve para traerse una plantilla y ponerle algo dentro, si se pone el 
 * valor "data" entonces se puede enviar elementos a la plantilla. Así si se pone solo un 
 * string, entonces ese estring para que se vea dentro de la plantilla, solo se ejecuta la 
 * función contend, donde se va a ver lo que se le envía, pero si la plantilla tiene elementos 
 * donde se introducen varias cosasentonces lo que se hace es enviar en el contend_insert un 
 * array, y en la plantilla, se ejecuta la función y como va a retornar el array, entonces 
 * se pone el índice del array y se ejecuta esa función, y todo eso se hace dentro de la 
 * función printFunction();
 */
function template($template_require, $contend_insert, $string = null)
{
    def($contend, iffn(fn()=>$string === 'data', 
        fn()=>  fn()=>  $contend_insert,
        fn()=>  fn()=>  require response($contend_insert)
    )); 
    return require response($template_require);
}

/**
 * Permite imprimir el string de una función y elimina el 1 que sale si es que eso sale al final.
 */
function printFunction($printFunction)
{
    echo(rtrim($printFunction, '1'));
}

/**
 * Permite insertar código no funcional para no tener que hacer toda una cópia de cada elemento
 * y para no tener que cambiar el valor de una variable de manera no funcional en el scope global.
 */
function edit($data, $edit)
{
    return $edit($data);
}
/*
Este es un ejemplo de uso
$persona = ['nombre' => null, 'nombre_dos' => null];
$persona2 = edit($persona, function($dato)
{
   $dato['nombre'] = true;
   return $dato;
});
var_dump($persona); var_dump($persona2);
*/


/**
 * Permite cambiar el valor de una variable eligiendolo por el indice.
 */
function editIndex($data, $index, $insert)
{
    $data[$index] = $insert;
    return $data;
}
/*
$persona = [ 
    'datos_personales'    => [
            'nombre'    => 'julio',
            'apellido'  => 'quispe'
        ]
];
$persona2 = editIndex($persona, 'datos_personales',
    editIndex($persona['datos_personales'], 'nombre', ['mauro', 'bernardo'])
);
var_dump($persona); var_dump($persona2);
*/
