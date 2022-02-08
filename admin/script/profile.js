getUserProfile = (type) =>{
    const requestData = { request: 'getUserProfile',type:type };
    fetch('./include/request.php', {
      method: 'POST', // or 'PUT'
      headers: {'Content-Type': 'application/json',},
      body: JSON.stringify(requestData),
    })
    .then(response => response.json())
    .then(data => {
        if(!data.return){
            return;
        }else{
            let mensaje = ``;
            const formulario = document.getElementById("profileForm");
            formulario.elements['username'].value = data.return[0].username;
            formulario.elements['email'].value = (data.return[0].email) ? data.return[0].email : '';
            formulario.elements['firstName'].value = (data.return[0].firstName) ? data.return[0].firstName : '';
            formulario.elements['lastName'].value = (data.return[0].lastName) ? data.return[0].lastName : '';
            formulario.elements['type'].value = (data.return[0].type) ? data.return[0].type : '5';
            // console.log(data.return[0].type);
        }

    })
    .catch((error) => {
      console.error('Error:', error);
    });
}

getUserProfile();