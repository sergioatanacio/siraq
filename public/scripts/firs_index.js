
//let elemento = document.createElement('h1');
//elemento.append(document.createTextNode('Hola mundo'));
//elemento.append();
//
//document.querySelector('#stamping_materials').append(elemento);

let get_stamping_materials = new FormData();
get_stamping_materials.append('administrative_panel_type', 'get_stamping_materials');

fetch('administrative_panel', 
{
    method: 'POST',
    body:   get_stamping_materials,
})
.then(response=> response.json() )
.then(text =>
{
    let template_stamping_materials = document.querySelector('#template_stamping_materials').content;
    let fragmet = document.createDocumentFragment();

    text.forEach(element => {
        let linck_image = (element.material_images[0].linck_image) 
            ? '/file_store/img_products/' + element.material_images[0].linck_image 
            : '';
        template_stamping_materials.querySelector('img').setAttribute('src', `${linck_image}`);
        template_stamping_materials.querySelector('img').setAttribute('alt', `hola mundo`);
        template_stamping_materials.querySelector('p').textContent = element.name_of_material;
        /* True copia toda la estructura interna, si se le pasa un false, solo copia 
        la etiqueta elegida (apertura y cierre)*/
        let clone = document.importNode(template_stamping_materials, true)
        fragmet.append(clone);
    });
    let stamping_materials = document.querySelector('#stamping_materials');
    stamping_materials.append(fragmet);
})
.catch(error => console.log(error));



let get_stamping_size = new FormData();
get_stamping_size.append('administrative_panel_type', 'get_stamping_size');

fetch('administrative_panel', 
{
    method: 'POST',
    body:   get_stamping_size,
})
.then(response=> response.json() )
.then(text =>
{
    let template_stamping_materials = document.querySelector('#template_stamping_materials').content;
    let fragmet = document.createDocumentFragment();
    console.log(text);

    text.forEach(element => {
        let linck_image = (element.stamping_size_image[0].linck_image) 
            ? '/file_store/img_products/' + element.stamping_size_image[0].linck_image 
            : '';
        template_stamping_materials.querySelector('div div img').setAttribute('src', `${linck_image}`);
        template_stamping_materials.querySelector('div div img').setAttribute('alt', `hola mundo`);
        template_stamping_materials.querySelector('div p').textContent = element.name_stamping_size;
        /* True copia toda la estructura interna, si se le pasa un false, solo copia 
        la etiqueta elegida (apertura y cierre)*/
        let clone = document.importNode(template_stamping_materials, true)
        fragmet.append(clone);
    });
    let stamping_materials = document.querySelector('#stamping_size');
    stamping_materials.append(fragmet);
})
.catch(error => console.log(error));