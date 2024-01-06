let form = document.querySelector("#form");
let TId = document.querySelector("#TId");
let taskName = document.querySelector("#taskName");
let StartDate = document.querySelector("#StartDate");
let endDate = document.querySelector("#endDate");
let nature = document.querySelector("#nature");


// Update the form event listener
form.addEventListener("submit", (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});


function validateForm(){
    //TId
    if(TId.value.trim()==''){
        setError(TId,'Task ID can not be empty');
    }else if(TId.value.trim().length<3){
        setError(TId,'Task ID must be min 3 charecters');

    }else{
        setSuccess(TId);
    }

    if(taskName.value.trim()==''){
        setError(taskName,'Task name can not be empty');
    }else if (!/^[a-zA-Z]+$/.test(taskName.value.trim())) {
        setError(taskName, 'Name must contain only characters');
    }else if(taskName.value.trim().length<2){
        setError(taskName, 'Task name must be grater than 2 characters');
    }
    else{
        setSuccess(taskName);
    }
    if(StartDate.value.trim()==''){
        setError(StartDate,'Date can not be empty');
    } 
    else{
        setSuccess(StartDate);
    }

    if(endDate.value.trim()==''){
        setError(endDate,'Date can not be empty');
    } 
    else{
        setSuccess(endDate);
    }

    if(nature.value.trim()==''){
        setError(nature,'Nature can not be empty');
    }else if (!/^[a-zA-Z]+$/.test(nature.value.trim())) {
        setError(nature, 'Name must contain only characters');
    }else if(nature.value.trim().length<2){
        setError(nature, 'Nature must be grater than 2 characters');
    }
    else{
        setSuccess(nature);
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

