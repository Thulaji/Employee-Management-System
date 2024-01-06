let form = document.querySelector("#form");
let EId = document.querySelector("#EId");
let TId = document.querySelector("#TId");
let input1 = document.querySelector("#input1");
let acivityid = document.querySelector("#acivityid");
let nature = document.querySelector("#nature");


// Update the form event listener
form.addEventListener("submit", (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});


function validateForm(){
    //EID
     // EID
     if (EId.selectedIndex === 0) {
        setError(EId, 'Select EId');
    } else {
        setSuccess(EId);
    }

    if (TId.selectedIndex === 0) {
        setError(TId, 'Select TId');
    } else {
        setSuccess(TId);
    }

    // if(taskName.value.trim()==''){
    //     setError(taskName,'Task name can not be empty');
    // }else if (!/^[a-zA-Z]+$/.test(taskName.value.trim())) {
    //     setError(taskName, 'Name must contain only characters');
    // }else if(taskName.value.trim().length<2){
    //     setError(taskName, 'Task name must be grater than 2 characters');
    // }
    // else{
    //     setSuccess(taskName);
    // }
    if(input1.value.trim()==''){
        setError(input1,'Date can not be empty');
    } 
    else{
        setSuccess(input1);
    }


    if (acivityid.selectedIndex === 0) {
        setError(acivityid, 'Select ActivityID');
    } else {
        setSuccess(acivityid);
    }

    
    if(input2.value.trim()==''){
        setError(input2,'Select TId');
    }
    else{
        setSuccess(input2);
    }

    const errors = document.querySelectorAll('.error');
    if (errors.length === 0) {
        return true; // Allow form submission
    } else {
        return false; // Prevent form submission
    }
  
}

function setError(element, errorMessage){
    const parent = element.parentElement;
    if(parent.classList.contains('success')){
        parent.classList.remove('success');
    }
    parent.classList.add('error');
    const paragraph = parent.querySelector('small');
    paragraph.textContent = errorMessage;
}

function setSuccess(element){
    const parent = element.parentElement;
    if(parent.classList.contains('error')){
        parent.classList.remove('error');
    }
    parent.classList.add('success');
}

