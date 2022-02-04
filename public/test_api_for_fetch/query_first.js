//http://localhost:8000/test_api_for_fetch/test_api_for_fetch.html

/* 
fetch('/index.html')
.then(response=> response.text())
.then(text =>
    {
        document.querySelector('#inicio').append(document.createTextNode(text));
    })
.catch(tres=> console.log(tres) );
 */



const data = new FormData();
data.append('email', 'andres@gmail.com');
data.append('password', 'andresc');
data.append('login_type', 'log_in');

fetch('/login_controller', 
{
    method: 'POST',
    body:   data,
})
.then(response=> response.text())
.then(text =>
{
    
    const element = document.createElement('h1');
    element.append(document.createTextNode(text));
    document.querySelector('#inicio').append(element);
})
.catch(error => console.log(error));




const session_existsData = new FormData();
session_existsData.append('login_type', 'session_exists');
fetch('/login_controller', 
{
    method: 'POST',
    body:   session_existsData,
})
.then(response=> response.text())
.then(text =>
    {
        const element = document.createElement('h1');
        element.append(document.createTextNode(text));
        document.querySelector('#inicio').append(element);
    })
.catch(tres=> console.log(tres) );




let form_upload_add_product = document.getElementById('form_upload_add_product_id');
              
form_upload_add_product.addEventListener('submit', function(event_of_submit_for_default)
{
    event_of_submit_for_default.preventDefault();

    let data = new FormData(form_upload_add_product);
    console.log(data)
    fetch('/administrative_panel', 
    {
        method: 'POST',
        body:   data,
    })
    .then(response => response.text())
    .then(function(texto) 
    {
        document.getElementById("result_message").innerHTML = JSON.stringify(texto);
    })
    .catch(function(error) 
    {
        console.log(error);
    })

});

/* 
const close_sessionData = new FormData();
close_sessionData.append('login_type', 'close_session');
fetch('/login_controller', 
{
    method: 'POST',
    body:   close_sessionData,
})
.then(response=> response.text())
.then(text =>
    {
        document.querySelector('#inicio').append(document.createTextNode(text));
    })
.catch(tres=> console.log(tres) );

 */


