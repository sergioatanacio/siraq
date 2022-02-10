
let elemento = document.createElement('h1');
elemento.append(document.createTextNode('Hola mundo'));
//elemento.append();

document.querySelector('#stamping_materials').append(elemento);

let card_stamping_materials = document.querySelector('#template_stamping_materials').content;

let img_stamping_materials = card_stamping_materials.querySelector('div img');
img_stamping_materials.setAttribute('src', `/file_store/img_products${linck_image}`);