
//let elemento = document.createElement('h1');
//elemento.append(document.createTextNode('Hola mundo'));
//elemento.append();
//
//document.querySelector('#stamping_materials').append(elemento);

let data = new FormData();
data.append('administrative_panel_type', 'get_stamping_materials');

fetch('../administrative_panel', 
{
    method: 'POST',
    body:   data,
})
.then(response=> response.json())
.then(text =>
{
    let stamping_materials = document.querySelector('#stamping_materials');
    let template_stamping_materials = document.querySelector('#template_stamping_materials').content;
    let fragmet = document.createDocumentFragment();

    text.forEach(element => {
        template_stamping_materials.querySelector('div div img').setAttribute('src', `/file_store/img_products/${element}`);
        template_stamping_materials.querySelector('div div img').setAttribute('alt', `hola mundo`);
        template_stamping_materials.querySelector('div p').textContent = 'Este es el contenido';
        /* True copia toda la estructura interna, si se le pasa un false, solo copia 
        la etiqueta elegida (apertura y cierre)*/
        let clone = document.importNode(template_stamping_materials, true)
        fragmet.append(clone);
    });
    console.log(fragmet);
    stamping_materials.append(fragmet);
    
})
.catch(error => console.log(error));



