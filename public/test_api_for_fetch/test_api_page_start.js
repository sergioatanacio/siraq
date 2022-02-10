
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
    let card_stamping_materials = document.querySelector('#template_stamping_materials').content;
    let fragmet = document.createDocumentFragment();

    text.forEach(element => {
        let img_stamping_materials = document.createElement('img');
        let img_element_promise = new Promise((resolve, reject) => {
            if(element){
                resolve(element);
            }
        });

        img_element_promise.then(res_stamping_materials =>{
            img_stamping_materials.setAttribute('src', `/file_store/img_products/${res_stamping_materials}`);
            let add_stamping = card_stamping_materials.querySelector('div').append(img_stamping_materials);
            fragmet.append(add_stamping);
        })
        .catch()
    });
    console.log(fragmet);
    let stamping_materials_container = document.querySelector('#stamping_materials');
    stamping_materials_container.append(fragmet);
    
})
.catch(error => console.log(error));



