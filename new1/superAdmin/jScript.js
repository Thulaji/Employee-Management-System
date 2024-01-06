let form = document.querySelector("#form");
let employeeId = document.querySelector("#EId");
let telephone = document.querySelector("#telephone");
let name = document.querySelector("#name");
let email = document.querySelector("#email");
let designation = document.querySelector("#designation");


// Update the form event listener
form.addEventListener("submit", (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});

function validateForm(){
    //EId
    if(employeeId.value.trim()==''){
        setError(employeeId,'Employee ID can not be empty');
    }else if(employeeId.value.trim().length<3){
        setError(employeeId,'employee ID must be min 3 charecters');

    }else{
        setSuccess(employeeId)
    }

    //Telephone number
    if(telephone.value.trim()==''){
        setError(telephone,'Telephone number can not be empty');
    } else if (!/^\d+$/.test(telephone.value.trim())) {
        setError(telephone, 'Telephone must be a number');
    }else if(!/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/.test(telephone.value.trim())){
        setError(telephone, 'Telephone number length invalid');
    }
    else{
        setSuccess(telephone)
    }

    //name
    if(name.value.trim()==''){
        setError(name,'Name can not be empty');
    }else if (!/^[a-zA-Z]+$/.test(name.value.trim())) {
        setError(name, 'Name must contain only characters');
    }else if(name.value.trim().length<2){
        setError(name, 'name must be grater than 2 characters');
    }
    else{
        setSuccess(name)
    }

    //email
    if (email.value.trim() == '') {
        setError(email, 'Email can not be empty');
    } else if (!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email.value.trim())) {
        setError(email, 'Provide a valid email address');
    } else {
        setSuccess(email);
    }

    //designation
    if(designation.value.trim()==''){
        setError(designation,'designation can not be empty');
    }else if (!/^[a-zA-Z]+$/.test(name.value.trim())) {
        setError(designation, 'designation must contain only characters');
    }else if(name.value.trim().length<2){
        setError(designation, 'designation must be grater than 2 characters');
    }else{
        setSuccess(designation)
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

