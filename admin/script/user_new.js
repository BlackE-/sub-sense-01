getAge = (birthdayDate) => {
    var today = new Date();
    var birthDate = birthdayDate;
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

setError = ( input ) =>{
	input.classList.add('error');
	setTimeout(()=>{input.classList.remove('error')},2000);
}

insertUser = ( dataUser ) =>{
	var object = {};
	dataUser.forEach((value, key) => object[key] = value);

	openModalFunction();

	fetch('./include/request.php', {
	  method: 'POST', // or 'PUT'
	  headers: {'Content-Type': 'application/json',},
	  body: JSON.stringify(object),
	})
	.then(response => response.json())
	.then(data => {
		console.log('Success:', data);
		if(!data.return){
			console.log(data.message);
		}else{
			console.log('Success:', data);
			modalHideLoading();
			modalSetMessage(data.message);
			setTimeout(function(){closeModalFunction();},5000);
			formPersonal.reset();
			formAddress.reset();
		}
	})
	.catch((error) => {
	  console.error('Error:', error);
	});
}


let day = document.getElementsByName('day')[0];
let month = document.getElementsByName('month')[0];
let year = document.getElementsByName('year')[0];
let dob = null;
year.addEventListener('change',function(){
	dob = null;
	if(day.value > 31){setError( day );return;}
	if(month.value > 12){setError( month );return;}
	dob = new Date(year.value,month.value - 1,day.value);
	if (isNaN(dob)){setError( day );setError( month );setError( year );
	}else{
		const age = getAge(dob);
		document.getElementById('edad').innerHTML = `${dob.getDay()}/${dob.getMonth() + 1}/${dob.getFullYear()} <br> ${age} años`;
	}
});


const formPersonal = document.getElementById('personalForm');
const formAddress = document.getElementById('addressForm');
formPersonal.addEventListener('submit',(event)=>{event.preventDefault();})
formAddress.addEventListener('submit',(event)=>{event.preventDefault();})

const saveNewUser = document.getElementById('saveNewUser');
saveNewUser.addEventListener('click',function(){
	
	const submitPersonal = document.getElementById('submitPersonal');
	submitPersonal.click();

	const folio = formPersonal.elements['folio'];
	if(!folio.checkValidity()){setError( folio );return;}
	const firstname = formPersonal.elements['firstname'];
	if(!firstname.checkValidity()){setError( firstname );return;}
	const lastname = formPersonal.elements['lastname'];
	if(!lastname.checkValidity()){setError( lastname );return;}
	const email = formPersonal.elements['email'];
	if(!email.checkValidity()){setError( email );return;}

	const _dob = dob;
	if(typeof(_dob) == null){setError( day );setError( month );setError( year );return;}
	// console.log(_dob);
	const sex = document.querySelector('input[name="sex"]:checked');
	if(sex === null){
		let _sex = document.querySelectorAll('input[name="sex"] + label');
		_sex.forEach((item)=>{setError(item);});
	}
	const nse = formPersonal.elements['nse'].value;


	const submitContact = document.getElementById('submitContact');
	submitContact.click();

	const addressline1 = formAddress.elements['addressline1'];
	if(!addressline1.checkValidity()){setError( addressline1 );return;}
	const betweenstreet1 = formAddress.elements['betweenstreet1'];
	if(!betweenstreet1.checkValidity()){setError( betweenstreet1 );return;}
	const betweenstreet2 = formAddress.elements['betweenstreet2'];
	if(!betweenstreet2.checkValidity()){setError( betweenstreet2 );return;}
	const zone = formAddress.elements['zone'];
	if(!zone.checkValidity()){setError( zone );return;}
	const zipcode = formAddress.elements['zipcode'];
	if(!zipcode.checkValidity()){setError( zipcode );return;}
	const city = formAddress.elements['city'];
	if(!city.checkValidity()){setError( city );return;}
	const phone = formAddress.elements['phone'];
	if(!phone.checkValidity()){setError( phone );return;}

	const state = formAddress.elements['state'];
	const country = formAddress.elements['country'];


	const formData = new FormData();
	formData.append('request', 'insertUser');
	formData.append('type', '5');

	formData.append('folio', 	folio.value );
	formData.append('firstname', firstname.value);
	formData.append('lastname', lastname.value);
	formData.append('email', 	email.value);
	formData.append('dob', 		`${dob.getFullYear()}-${dob.getMonth() + 1}-${dob.getDay()}`);
	formData.append('sex', 		sex.value);
	formData.append('nse', 		nse);

	formData.append('addressline1', 	addressline1.value);
	formData.append('betweenstreet1', 	betweenstreet1.value);
	formData.append('betweenstreet2', 	betweenstreet2.value);
	formData.append('zipcode', 			zipcode.value);
	formData.append('zone', 			zone.value);
	formData.append('city', 			city.value);
	formData.append('state', 			state.value);
	formData.append('country', 			country.value);
	formData.append('phone', 			phone.value);

	insertUser( formData );
});