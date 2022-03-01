const urlParams = Object.fromEntries(new URLSearchParams(window.location.search));
//`single_stamping_material.html?${Object.keys(element)[0]}=${element.id_stamping_materials}`
let get_stamping_materials = new FormData();
let id_of_element = Object.keys(urlParams)[0];
get_stamping_materials.append(id_of_element, `${urlParams[id_of_element]}`);
get_stamping_materials.append('administrative_panel_type', 'get_single_stamping_material');

fetch('administrative_panel', 
{
    method: 'POST',
    body:   get_stamping_materials,
})
.then(response=> response.json() )
.then(text =>
{
    let object_single_material = text[0];
    console.log(object_single_material);

    let template_stamping_materials = document.querySelector('#template_stamping_materials').content;
    let fragmet = document.createDocumentFragment();

    template_stamping_materials.querySelector('h2').textContent = object_single_material.name_of_material;
    template_stamping_materials.querySelector('p').textContent = object_single_material.description_material;
    
    /* True copia toda la estructura interna, si se le pasa un false, solo copia 
    la etiqueta elegida (apertura y cierre)*/
    let clone = document.importNode(template_stamping_materials, true)
    fragmet.append(clone);

    let stamping_materials = document.querySelector('.wrapper');
    stamping_materials.append(fragmet);



})
.catch(error => console.log(error));

