# Comand of install stylus
- $ npm install stylus -g
- stylus -w style.styl -o style.css
- stylus -c -w styles.styl -o style.css

# Que significan las banderas
- El "c" indica que es comprimido o minificado.
- El "w" es para que se quede el servidor escuchando los cambios.

# Comandos usados
- Usar comando en la raiz.
stylus -w stylus/style_of_stylus.styl -o css/style_of_stylus.css

# Sintaxis
Stylus no usa las llaves sino que indentación, tampoco usa el ":" o ";".

El punto para las clases, el # para los id. 

Ejemplo:

## Identación
.padre
    .hijo
    .hermano
        background grey
        &:hover
            background blue
            color white

## Las variables
ancho = 500px
$alto = 250px

div
    width ancho
    height $alto

<!-- Obteniendo el valor de un atributo. -->

div
    width ancho
    height (@width / 2)

ancho = 1000px
div
    width ancho
    article
        height (@width / 2)


## Mixins
body
    background #e3e3e3

center()
    position relative
    margin 0 auto 0 auto

border-radius(n)
    border-radius n
    -webkit-border-radius n
    -moz-border-radius n

.box
    background white
    border-radious(5px)
    border 1px solid #ccc
    width 250px
    height 150px 
    center()

.container
    background blue
    color white
    width 500px
    height 200px
    border 1px solid white
    center()
