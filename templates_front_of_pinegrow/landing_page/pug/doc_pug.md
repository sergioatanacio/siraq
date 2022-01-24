# Comandos
Instalarlo
npm i pug-cli -g
Compilar
pug -w --pretty landing.pug

# Sobre javascript, la manera de obtener los archivos es. y con .tex() se obtiene el valor en string, y eso se puede luego incertar con un innerhtml. Y ya tienes tus requiere de php.
const = 'https://pokeapi.co/api/v2/pokemon/1/';

fetch(url)
.then(response=>response.json())
.then(data=>{
    let element = document.getElementById('elem')
    element.innerHTML = `<p>${data.name}</p>`;
    console.log(data)
})
.catch(err=>console.log(err))