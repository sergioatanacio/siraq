//http://localhost:8000/test_api_for_fetch/test_api_for_fetch.html

/* 
fetch('http://localhost:8000/index.html')
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

fetch('http://localhost:8000/login_controller', 
{
    method: 'POST',
    body:   data,
})
.then(response=> response.text())
.then(text =>
{
    document.querySelector('#inicio').append(document.createTextNode(text));
})
.catch(error => console.log(error));




const session_existsData = new FormData();
session_existsData.append('login_type', 'session_exists');
fetch('http://localhost:8000/login_controller', 
{
    method: 'POST',
    body:   session_existsData,
})
.then(response=> response.text())
.then(text =>
    {
        document.querySelector('#inicio').append(document.createTextNode(text));
    })
.catch(tres=> console.log(tres) );



/* 
const close_sessionData = new FormData();
close_sessionData.append('login_type', 'close_session');
fetch('http://localhost:8000/login_controller', 
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


