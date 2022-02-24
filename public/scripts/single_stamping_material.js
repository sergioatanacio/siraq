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
    console.log(text[0]);

})
.catch(error => console.log(error));

