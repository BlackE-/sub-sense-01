    const tabsSurveys = new Tabby('[data-tabs]');
    const idcampain = document.getElementById('idcampain');
    const surveys = document.querySelectorAll('form');
    // console.log(surveys);

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
            console.log('Success:', data);
            if(!data.return){
                console.log(data.message);
            }else{
                console.log('Success:', data);
                modalHideLoading();
                modalSetMessage(data.message);
                setTimeout(function(){
                    closeModalFunction();
                },5000);
            }
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    }

    // surveys.forEach((item,index)=>{
    //     console.log(item);
    //     let idsurvey = item.getAttribute('name');
    //     let surveyIndex = index+1;
    //     // 1
    //     //funcion para actualizar el cuestionario (nombre | descripcion | tipo )
    //     // let surveyForm = new FormData();
    //     // surveyForm.append('request', 'updateSurvey');
    //     // surveyForm.append ( "name" , item.elements['nameSurvey'].value);
    //     // surveyForm.append ( "description" , item.elements['descriptionSurvey'].value);
    //     // surveyForm.append ( "type" , item.elements['typeSurvey'].value);
    //     // surveyForm.append ( "idsurvey" , idsurvey);
    //     // fetchCall( surveyForm );

    //     // 2 dependiendo del tipo de hacen ciertas cosas
    //     // switch(type){
    //     //     case 'samples':
    //     //         //  save samples
    //     //         /*  

    //     //                 NO DESCOMENTAR PARA NO VOLVER A GGUARDAR LOS MISMOS SAMPLES

    //     //         */
    //     //         // let samples = item.elements['sampleValue'];
    //     //         // samples.forEach((sample,index)=>{
    //     //         //     let sampleForm = new FormData();
    //     //         //     sampleForm.append('request', 'insertSample');
    //     //         //     sampleForm.append ( "name" , sample.value);
    //     //         //     sampleForm.append ( "_order" , index);
    //     //         //     sampleForm.append ( "idsurvey" , idsurvey);
    //     //         //     fetchCall( sampleForm );
    //     //         // })
    //     //     break;
    //     //     case 'regular':

    //     //     break;
    //     // }


    //     // 3
    //     //guardar las preguntas de cada cuestionario
    //     // let surveyQuestionCounter = item.elements['surveyQuestionCounter'].value;
    //     // console.log(surveyQuestionCounter);
    //     // for(let x = 1;x<=surveyQuestionCounter;x++){
    //     //     let questionName = item.elements[`survey${surveyIndex}question${x}name`].value;
    //     //     // console.log(questionName);
    //     //     let questionType = item.elements[`survey${surveyIndex}question${x}type`].value;
    //     //     // console.log(questionType);

    //     //     let questionForm = new FormData();
    //     //     questionForm.append('request', 'insertQuestion');
    //     //     questionForm.append ( "html" , questionName);
    //     //     questionForm.append ( "_order" , x);
    //     //     questionForm.append ( "type" , questionType);
    //     //     questionForm.append ( "idsurvey" , idsurvey);
    //     //     questionForm.append ( "idmedia" , '');
    //     //     fetchCall( questionForm );
    //     // }


    //     //una vez hecho eso colocar el ID de la pregunta en el html
    //     // y empezar a guardar sus opciones
    //     // let surveyQuestionCounter = item.elements['surveyQuestionCounter'].value;
    //     // for(let x = 1;x<=surveyQuestionCounter;x++){
    //     //     let idquestion = item.elements[`survey${surveyIndex}question${x}idquestion`].value;
    //     //     let questionType = item.elements[`survey${surveyIndex}question${x}type`].value;
    //     //     console.log(idquestion);
    //     //     // console.log(questionType);
    //     //     let responseForm = new FormData();
    //     //     responseForm.append("request","insertResponse");
    //     //     switch(questionType){
    //     //         case 'scale':
    //     //             let scaleCounter = item.elements[`survey${surveyIndex}question${x}scale`].value;
    //     //             // console.log(scaleCounter);

    //     //             for(let y = 1;y<=scaleCounter;y++){
    //     //                 let scale = item.elements[`survey${surveyIndex}question${x}scale${y}`].value;
    //     //                 // console.log(scale);
    //     //                 let responseForm = new FormData();
    //     //                 responseForm.append("request","insertResponse");
    //     //                 responseForm.append("value",y);
    //     //                 responseForm.append("label",scale);
    //     //                 responseForm.append("type","scale");
    //     //                 responseForm.append("_order",y);
    //     //                 responseForm.append("idquestion",idquestion);
    //     //                 fetchCall(responseForm);
    //     //             }


    //     //         break;
    //     //         case 'checkbox':
    //     //             let checkboxCounter = item.elements[`survey${surveyIndex}question${x}checkbox`].value;
    //     //             // console.log(checkboxCounter);

    //     //             for(let y = 1;y<=checkboxCounter;y++){
    //     //                 let checkbox = item.elements[`survey${surveyIndex}question${x}checkbox${y}`].value;
    //     //                 // console.log(checkbox);

    //     //                 let responseForm2 = new FormData();
    //     //                 responseForm2.append("request","insertResponse");
    //     //                 responseForm2.append("value",checkbox);
    //     //                 responseForm2.append("label",checkbox);
    //     //                 responseForm2.append("type","checkbox");
    //     //                 responseForm2.append("_order",y);
    //     //                 responseForm2.append("idquestion",idquestion);
    //     //                 fetchCall(responseForm2);
    //     //             }

    //     //         break;
    //     //         case 'radio':
    //     //         break;
    //         // }
    //     // }
    // });