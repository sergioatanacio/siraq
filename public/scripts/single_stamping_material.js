const urlParams = Object.fromEntries(new URLSearchParams(window.location.search));


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
    console.log(text);
    text.forEach(element => {
        let linck_image = (element.material_images[0].linck_image) 
        ? '/file_store/img_products/' + element.material_images[0].linck_image 
        : '';
        template_stamping_materials.querySelector('.card_data_link').setAttribute('href', `single_stamping_material.html?id_stamping_size=${element.id_stamping_materials}`);
        template_stamping_materials.querySelector('.card_image').setAttribute('src', `${linck_image}`);
        template_stamping_materials.querySelector('.card_image').setAttribute('alt', `hola mundo`);
        template_stamping_materials.querySelector('.name_card').textContent = element.name_of_material;
        /* True copia toda la estructura interna, si se le pasa un false, solo copia 
        la etiqueta elegida (apertura y cierre)*/
        let clone = document.importNode(template_stamping_materials, true)
        fragmet.append(clone);
    });
    let stamping_materials = document.querySelector('#stamping_materials');
    stamping_materials.append(fragmet);
})
.catch(error => console.log(error));

