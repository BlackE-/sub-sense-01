    
    const addTemporaryClass = (element, className,duration) =>{
        setTimeout(()=>{
            element.classList.remove(className);
        },duration);
        element.classList.add(className);
    }
    const checkPassword = (pwd) =>{
        const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{0,9}$/;
        return re.test(pwd);
    }
    const formSubmit = (event) =>{
        event.preventDefault();
        openModalFunction();
        const username_element = document.querySelector('input[name="username"]');
        if(username_element.value.length === 0){
            addTemporaryClass(username_element ,'animated', 1000);
            addTemporaryClass(username_element ,'swing', 1000);
            return false;
        }
        const pass_element = document.querySelector('input[name="pass"]');
        if(pass_element.value.length === 0){
            addTemporaryClass( pass_element ,'animated', 1000);
            addTemporaryClass( pass_element ,'swing', 1000);
            return false;
        }
        //ajax call
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
                myObj = JSON.parse(this.response);
                console.log(myObj);
                if(!myObj.return){
                    console.log("ERROR");
                    modalHideLoading();
                    modalSetMessage(myObj.message);
                    // setTimeout(function(){closeModalFunction();},5000);
                }else{
                    closeModalFunction();
                    document.getElementById("error").innerHTML = myObj.message;
                    sessionStorage.setItem('iduser', myObj.return);
                    window.location.href = 'index';
                }
            }
        };
        
        xhttp.open("POST", "include/LOGIN-login.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`username=${username_element.value}&password=${pass_element.value}`);
         
    }

    document.querySelector('#loginForm').addEventListener('submit',formSubmit);