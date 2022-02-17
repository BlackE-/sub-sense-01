const idcampain = document.getElementById('idcampain').value;
const numberSurveys = document.getElementById("numberSurveys");
const buttonFinal = document.getElementById("buttonFinal");
const rowSamples = document.getElementById("rowSamples");
const surveyForm = document.getElementById("survey");
const questionForm = document.getElementById("questionForm");
const samplesContainer = document.getElementById("samplesContainer");
const addSamples = document.getElementById("addSamples");
const addScale = document.getElementById("addScale");
const scaleForm = document.getElementById("scaleForm");
const orderForm = document.getElementById("orderForm");
const orderSave = document.getElementById("orderSave");
const nextSurvey = document.getElementById("nextSurvey");

let surveyData = new Array;
let currentSurvey = 1;
let currentQuestion = 1;
let currentSample = 1;
let currentScale = 1;
let ordenacionLabel = '';

fetchCall = ( dataFetch ) =>{
    let object = {};
    dataFetch.forEach((value, key) => object[key] = value);
    openModalFunction();
    fetch('./include/request.php', {
      method: 'POST', // or 'PUT'
      headers: {'Content-Type': 'application/json',},
      body: JSON.stringify(object),
    })
    .then(response => response.json())
    .then(data => {
        // console.log('Success:', data);
        if(!data.return){
            console.log(data.message);
        }else{
            console.log(data.return);
            switch(object.request){
                case 'getSurveysFromCampain':
                    data.return.map((item)=>{
                        surveyData.push(item.idsurvey);
                    });
                    numberSurveys.value = surveyData.length;
                break;
                case 'getSurveyId':
                    surveyForm.elements['idsurvey'].value = data.return;
                break;
                case "getSamples":
                    let samplesHTML = '<p>Muestras</p>';
                    ordenacionLabel = '';
                    data.return.map((sample)=>{
                        samplesHTML += `${sample.name} - ${sample.code}<br>`;
                        ordenacionLabel += `${sample.name}-${sample.code},`
                    });
                    document.getElementById("samplesOrderForm").innerHTML = samplesHTML;
                    ordenacionLabel = ordenacionLabel.slice(0, -1);     //remover la ultima coma
                break;
                case 'insertSample':
                    modalHideLoading(); modalSetMessage(data.message);
                    currentSample++;
                    samplesContainer.innerHTML += `<p>${object.name} - ${object.code}</p>`;
                    surveyForm.elements['sampleName'].value = '';surveyForm.elements['sampleCode'].value = '';
                break;
                case 'updateSurvey':
                    surveyForm.reset();
                    showQuestionForm();
                    hideSurveyForm();
                    showNextSurvey();
                break;
                case 'insertQuestion':
                    currentSample = 1;
                    document.getElementById("questionsContainer").innerHTML += `<p>${currentQuestion}. ${object.html}</p>`;
                    currentQuestion++;
                    switch(object.type){
                        case "scale":
                            questionForm.elements['idquestion'].value = data.return;
                            showScaleForm();
                        break;
                        case "order":
                            questionForm.elements['idquestion'].value = data.return;
                            showOrderSave();
                        break;
                    }
                break;
                case 'insertResponse':
                    document.getElementById("questionsContainer").innerHTML += `<p>${currentSample}. ${object.value} - ${object.label}</p>`;
                    currentScale++;
                    scaleForm.elements['questionScaleValue'].value = currentScale;
                    scaleForm.elements['questionScaleLabel'].value = '';
                break;

                case '':
                break;
            }
            setTimeout(function(){closeModalFunction();},5000);
        }
    })
    .catch((error) => {
      console.error('Error:', error);
    });
}

showSamplesRow = () =>{rowSamples.style.display = "block";}
hideSamplesRow = () =>{rowSamples.style.display = "none";}
showButtonFinal = () =>{buttonFinal.style.display = "block";}
hideButtonFinal = () =>{buttonFinal.style.display = "none";}
showQuestionForm = () =>{questionForm.style.display = "block";}
hideQuestionForm = () =>{questionForm.style.display = "none";}
showSurveyForm = () =>{surveyForm.style.display = "block";}
hideSurveyForm = () =>{surveyForm.style.display = "none";}
showScaleForm = () =>{scaleForm.style.display = "block";}
hideScaleForm = () =>{scaleForm.style.display = "none";}
showOrderForm = () =>{orderForm.style.display = "block";}
hideOrderForm = () =>{orderForm.style.display = "none";}
showOrderSave = () =>{orderSave.style.display = "block";}
hideOrderSave = () =>{orderSave.style.display = "none";}
showNextSurvey = () =>{nextSurvey.style.display = "block";}
hideNextSurvey = () =>{nextSurvey.style.display = "none";}

buttonFinal.addEventListener("click",function(){
    openModalFunction();
    window.location.href="campains";
});

orderSave.addEventListener("click",function(){
    const ordenInsert = new FormData();
    ordenInsert.append("request","insertResponse");
    ordenInsert.append("value",'');
    ordenInsert.append("label",ordenacionLabel);
    ordenInsert.append("_order",1);
    ordenInsert.append("type","ordenacion");
    ordenInsert.append("idquestion",questionForm.elements['idquestion'].value);

    fetchCall(ordenInsert);
})
orderForm.addEventListener("submit",function(event){
    event.preventDefault();
    ordenacionLabel += `, ${orderForm.elements['questionOrderLabel'].value}-${orderForm.elements['questionOrderValue'].value}`;
    openModalFunction();
    document.getElementById("samplesOrderForm").innerHTML = ordenacionLabel;
    orderForm.reset();
    closeModalFunction();
});

nextSurvey.addEventListener("click",function(event){
    event.preventDefault();
    currentQuestion = 1;
    currentSample = 1;
    currentScale = 1;
    currentSurvey++;

    surveyForm.elements['numberSurvey'].value = currentSurvey;
    hideQuestionForm();
    hideSamplesRow();
    hideScaleForm();
    showSurveyForm();
    showButtonFinal();
});

scaleForm.addEventListener("submit",function(event){
    event.preventDefault();
    const scaleInsert = new FormData();
    scaleInsert.append("request","insertResponse");
    scaleInsert.append("value",scaleForm.elements['questionScaleValue'].value);
    scaleInsert.append("label",scaleForm.elements['questionScaleLabel'].value);
    scaleInsert.append("_order",currentScale);
    scaleInsert.append("type","scale");
    scaleInsert.append("idquestion",questionForm.elements['idquestion'].value);

    fetchCall(scaleInsert);
});

questionForm.elements['questionType'].addEventListener("change",function(event){
    event.preventDefault();
    switch(event.target.value){
        // case "scale":showScaleForm();break;
        case "order":
            showOrderForm();
            showOrderSave();
            const samplesData = new FormData();
            samplesData.append("request","getSamples");
            samplesData.append("idcampain",idcampain);
            fetchCall(samplesData);
        break;
        default:hideScaleForm();hideOrderForm();hideOrderSave();break;
    }
});

questionForm.addEventListener("submit",function(event){
    event.preventDefault();
    currentScale = 1;
    scaleForm.elements['questionScaleValue'].value = currentScale;
    const questionInsert = new FormData();
    questionInsert.append("request","insertQuestion");
    questionInsert.append("html",questionForm.elements['questionName'].value);
    questionInsert.append("_order",currentQuestion);
    questionInsert.append("type",questionForm.elements['questionType'].value);
    questionInsert.append("idsurvey",surveyData[currentSurvey-1]);
                                        //insert file from input file
                                        //save in DB
                                        //return idMedia
    questionInsert.append("idmedia",'');
    fetchCall(questionInsert);
});

surveyForm.addEventListener("submit",function(event){
    showNextSurvey();
    showButtonFinal();
    event.preventDefault();
    const surveyUpdate = new FormData();
    surveyUpdate.append("request","updateSurvey");
    surveyUpdate.append("idsurvey", surveyData[currentSurvey-1]);
    surveyUpdate.append("name",surveyForm.elements['nameSurvey'].value);
    surveyUpdate.append("description",surveyForm.elements['descriptionSurvey'].value);
    surveyUpdate.append("type",surveyForm.elements['typeSurvey'].value);
    fetchCall(surveyUpdate);
});

addSamples.addEventListener("click",function(){
    console.log("click");
    const sampleName = surveyForm.elements['sampleName'].value;
    const sampleCode= surveyForm.elements['sampleCode'].value;
    if( sampleName == ""){openModalFunction();modalHideLoading();modalSetMessage("Nombre de Muestra vacia");setTimeout(function(){closeModalFunction()},2000);return;}
    if( sampleCode == ""){openModalFunction();modalHideLoading();modalSetMessage("Nombre de Muestra vacia");setTimeout(function(){closeModalFunction()},2000);return;}

    const idsurvey = surveyForm.elements['idsurvey'].value;
    const samples = new FormData();
    samples.append('request','insertSample');
    samples.append('name',sampleName);
    samples.append('code',sampleCode);
    samples.append('_order',currentSample);
    samples.append('idsurvey',idsurvey);
    fetchCall(samples);
});

getSurveyId = () =>{
    const survey = new FormData();
    survey.append("request","getSurveyId");
    survey.append("idcampain",idcampain);
    survey.append("number",currentSurvey);
    fetchCall(survey);
}

init = () =>{
    hideQuestionForm();
    hideButtonFinal();
    hideScaleForm();
    hideOrderForm();
    hideOrderSave();
    hideNextSurvey();
    surveyForm.elements['numberSurvey'].value = currentSurvey;

    const surveysNumber = new FormData();
    surveysNumber.append("request","getSurveysFromCampain");
    surveysNumber.append("idcampain",idcampain);
    fetchCall(surveysNumber);

    getSurveyId();
}
init();