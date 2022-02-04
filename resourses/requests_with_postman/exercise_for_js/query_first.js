//document.querySelector('#inicio').innerHTML = 'Hola mundo';


fetch('http://localhost:8000/index.html')
.then(uno => uno.text)
.then(dos =>
    {
        document.querySelector('#inicio').innerHTML = 'Hola mundo';
    })
.catch(tres=>
        console.log(tres)
    );

