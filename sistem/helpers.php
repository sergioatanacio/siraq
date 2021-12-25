<?php

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

if(! function_exists('joinArrangement'))
{
    function joinArrangement($array, $newItem = null) : array
    {
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


if(! function_exists('popArray')) 
{
    function popArray($popFunction)
    {
        array_pop($popFunction);
        return $popFunction;
    }
}

if(! function_exists('lastElement')) 
{
    function lastElement($lastElement)
    {
        if(!is_array($lastElement) || $lastElement == []){
            return  [];
        } else{
            return $lastElement[count($lastElement) - 1];
        }
    }
}

if(! function_exists('response')) 
{
    function response($resourse) : string
    {
        return __DIR__.'/../resourses/'.$resourse;
        #return file_get_contents(__DIR__.'/../resourses/'.$resourse);
    };
}

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

if(! function_exists('pre'))
{
    function pre($pre)
    {
        echo '<pre>';
        var_dump($pre);
        echo '</pre>';
    }
}

if(! function_exists('domain')) 
{
    function domain($route) {
        return domain . $route;
    }
}

function sessionStarted()
{
    if(!isset($_SESSION)){ session_start();}
    $_SESSION['session'] = true;
}

function activeSession()
{
    if(!isset($_SESSION)){ session_start();}
    $sessionStarted = (!isset($_SESSION['session'])) ? false : $_SESSION['session'] ;

    if ($sessionStarted == false) {
        // echo "Debes iniciar sesión.";
        header("Location:" . domain("user"));
        die();
    }
}

function sessionEnded(){
    if(!isset($_SESSION)){ session_start();}
    $_SESSION['session'] = false;
}

function template($template_require, $contend_insert, $string = null)
{
    def($contend, iffn(fn()=>$string === 'string', 
        fn()=>  fn()=>  $contend_insert,
        fn()=>  fn()=>  require response($contend_insert)
    )); 
    return require response($template_require);
}

function printFunction($printFunction)
{
    echo(rtrim($printFunction, '1'));
}