const loginForm = document.getElementById("loginForm");


fetchCall = ( answerData ) =>{
    openModalFunction();
    let object = {};
    answerData.forEach((value, key) => object[key] = value);
    fetch('./include/INIT-subsense.php', {
      method: 'POST', // or 'PUT'
      headers: {'Content-Type': 'application/json',},
      body: JSON.stringify(object),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(!data.return){
            return;
        }else{
            closeModalFunction();
            console.log(data.return);
            window.location.href = `config.php`;
        }
    })
    .catch((error) => {
      console.error('Error:', error);
    });
}

loginForm.addEventListener("submit",function(event){
    event.preventDefault();
    let report = new FormData();
    report.append( 'host' , loginForm.elements['host'].value );
    report.append( 'database' , loginForm.elements['database'].value );
    report.append( 'username' , loginForm.elements['username'].value );
    report.append( 'password' , loginForm.elements['password'].value );
    fetchCall( report );
});