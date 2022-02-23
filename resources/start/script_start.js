//alert('Hola mundo<?php echo($enviando_dato_desde_el_controlador);?>');
//JSON.parse y JSON.stringify
consultFn();

function alumnos_ajax() 
{
    ejecutarAlumnosAjax = function() 
    {
        let data = new FormData();
        data.append('nombre_alumno', name_of_alumno);
        data.append('sex', sex);

        fetch('<?php domain_print("students");?>', 
        {
            method: 'POST',
            body:   data,
        })
        .then(function(response) 
        {
            if (response.ok) {
                return response.text();
            } else {
                throw "Error en la llamada";
            }
        })
        .then(function(texto) 
        {
            console.log(texto);
            document.getElementById("escribir_alumno").innerHTML = JSON.parse(texto) 
                ? 'El alumno fué registrado con exito' 
                : 'El alumno no pudo ser registrado, comunícate con soporte.'; 

            // document.getElementById("escribir_curso").innerHTML = texto;

            document.getElementById('name_of_alumno').value = '';
            document.getElementById('sex').value            = '';
        })
        .catch(function(error) 
        {
            console.log(error);
        })
    }
    let name_of_alumno  = document.getElementById('name_of_alumno').value;
    let sex             = document.getElementById('sex').value;
    console.log(sex);
    if (name_of_alumno !== '' && sex !== '')
    {   
        ejecutarAlumnosAjax();
        consultFn();
    }
    else 
    {   
        document.getElementById('name_of_alumno').style.backgroundColor = 'red' ;
        document.getElementById('valida_1').style.display = 'block';
        setTimeout(function (){
            document.getElementById('name_of_alumno').style.backgroundColor = 'white' ;
            document.getElementById('valida_1').style.display = 'none';
        },3000);
        document.getElementById("escribir_alumno").innerHTML =
        'El nombre del alumno o su sexo no pueden estar vacíos.';
    }
}

function cursos_ajax() 
{
    
    let ejecutarCursosAjax = function() 
    {   

        let data = new FormData();
        data.append('front_name_course', nombre_curso);
        data.append('front_teacher', nombre_profesor);

        fetch('<?php domain_print("courses");?>', 
        {
            method: 'POST',
            body:   data,
        })
        .then(function(response) 
        {
            if (response.ok) {
                return response.text();
            } else {
                throw "Error en la llamada";
            }
        })
        .then(function(texto) 
        {
            console.log(texto);
            document.getElementById("escribir_curso").innerHTML = (texto === 'true') 
                ? 'El curso fué registrado con exito' 
                : 'El curso no pudo ser registrado, comunícate con soporte.'; 

            // document.getElementById("escribir_curso").innerHTML = texto;

            document.getElementById('nombre_curso').value    = '';
            document.getElementById('nombre_profesor').value = '';
            //console.log(texto);
        })
        .catch(function(error) 
        {
            console.log(error);
        })
    }

    //document.getElementById("valueInput").innerHTML = inputValue; 
    let nombre_curso = document.getElementById('nombre_curso').value;
    let nombre_profesor = document.getElementById('nombre_profesor').value;

    if (nombre_curso !== '' && nombre_profesor !== '') 
    {
        ejecutarCursosAjax();
        consultFn();
    } 
    else 
    {
        document.getElementById("escribir_curso").innerHTML = 
        'El nombre del curso o del profesor no pueden estar vacíos.';
    }
}

function inscriptions_fetch() 
{
    let data = new FormData();
    data.append('name_course_inscriptions', 
        document.getElementById('name_of_course_inscriptions').value);
    data.append('name_student_inscriptions', 
        document.getElementById('name_pupil_inscriptions').value);

    fetch('<?php domain_print("inscriptions_insert");?>', 
    {
        method: 'POST',
        body:   data,
    })
    .then(function(response) 
    {
        if (response.ok) {
            return response.text();
        } else {
            throw "Error en la llamada";
        }
    })
    .then(function(texto) 
    {
        console.log(texto);

        document.getElementById("escribir_inscription").innerHTML = (texto === '"true"') 
            ? 'La inscripción fué registrado con exito' 
            : 'La inscripción no pudo ser registrada, comunícate con soporte.'; 

    })
    .catch(function(error) 
    {
        console.log(error);
    })
}

document.getElementById("inscriptions_button").addEventListener("click", function () 
{
    inscriptions_fetch();
    consultFn();
});



document.getElementById("consult").addEventListener("click", function () 
{
    consultFn();
});

function consultFn()
{
    let data = new FormData();

    fetch('<?php domain_print("json_course");?>')
    .then(function(response) 
    {
        if (response.ok) {
            return response.text();
        } else {
            throw "Error en la llamada";
        }
    })
    .then(function(texto) 
    {
        console.log(texto);
 
        
        json_course = JSON.parse(texto); 
        let select = json_course.map(function(course) 
        {
            return `<option value="${course.id_courses}">${course.name_course}</option>`;
        });
        document.getElementById("name_of_course_inscriptions").innerHTML = select; 

    })
    .catch(function(error) 
    {
        console.log(error);
    })

    
    fetch('<?php domain_print("json_students");?>')
    .then(function(response) 
    {
        if (response.ok) {
            return response.text();
        } else {
            throw "Error en la llamada";
        }
    })
    .then(function(texto) 
    {
        console.log(texto);
 
        
        json_students = JSON.parse(texto); 
        let select = json_students.map(function(students) 
        {
            return `<option value="${students.id_pupil}">${students.name_of_alumno}</option>`;
        });
        console.log(select);
        document.getElementById("name_pupil_inscriptions").innerHTML = select; 


        
        // document.getElementById("escribir_curso").innerHTML = texto;
        //console.log(texto);
    })
    .catch(function(error) 
    {
        console.log(error);
    })

    
    fetch('<?php domain_print("table_simple");?>')
    .then(function(response) 
    {
        if (response.ok) {
            return response.text();
        } else {
            throw "Error en la llamada";
        }
    })
    .then(function(texto) 
    {
        console.log(texto);
         
        json_course = JSON.parse(texto); 
        let table_consult = json_course.map(function(table_query) 
        {
            return `
            <tr>
                <td>${table_query.id_inscriptions}</td>
                <td>${table_query.name_course}</td>
                <td>${table_query.name_of_alumno}</td>
            </tr>`;
        });
        document.getElementById("insert_consult").innerHTML = `
            <tr>
                <th>Codigo de inscripción</th>
                <th>Nombre de curso</th>
                <th>Nombre de alumno</th>
            </tr>
            ${table_consult.join('')}`; 
        
        json_students = JSON.parse(texto); 
        let select = json_students.map(function(students) 
        {
            return `<option value="${students.id_pupil}">${students.name_of_alumno}</option>`;
        });
        console.log(select);
        document.getElementById("name_pupil_inscriptions").innerHTML = select; 



    })
    .catch(function(error) 
    {
        console.log(error);
    })

    /*document.getElementById("insert_consult").innerHTML = 'Hello';*/
}

document.getElementById("consult").addEventListener("click", function() 
{
    consultJoin();
});

