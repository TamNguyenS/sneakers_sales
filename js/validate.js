const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const inputElement = document.querySelectorAll('input')
inputElement.forEach(input => {
    input.onblur = () => {
        checkInput()
    }
    input.oninput = () => {
        checkInput()
    }
})
form.addEventListener('submit',function (e){
    e.preventDefault()
    let isCheck = checkInput()
    if(isCheck){
        console.log('Lỗi');
    }else{
        console.log('Call Api')
    }
   
})

const checkInput =() =>{

    if(!username.value.trim()){
        setErrorFor(username,'Vui lòng nhập kí tự ')
        return true
    }else{
        setSuccedFor(username)
    }
    if(!email.value.trim()){
        setErrorFor(email,'Vui lòng nhập kí tự')
        return true
    }else if(!isCheckEmail(email.value)){
        setErrorFor(email,'Truong nay khong phai email')
        return true
    }else{
        setSuccedFor(email)
    }
    if(!password.value.trim()){
        setErrorFor(password,'Vui lòng nhập kí tự')
        return true
    }else if(!isMinimum(password.value,6)){
        setErrorFor(password,`Nhap toi thieu 6 kí tự`)
        return true
    }else{
        setSuccedFor(password)
    }
    if(!password2.value.trim()){
        setErrorFor(password2,'Vui lòng nhập kí tự')
        return true
    }else if(!isMinimum(password2.value,6)){
        setErrorFor(password2,`Nhap toi thieu 6 kí tự`)
        return true
    }else if(password.value.trim() !== password2.value.trim() ){
        setErrorFor(password2,'vui lòng nhập trùng password')
        return true
    }else{
        setSuccedFor(password2)

    }

    return false

}

function setErrorFor(input,message){
    const parentElement = input.parentElement
    const small = parentElement.querySelector('small')
    parentElement.classList.add('error')
    small.innerText = message;
  
}
function setSuccedFor(input){
    const parentElement = input.parentElement
    parentElement.classList.remove('error')
    parentElement.classList.add('success')
}
function isCheckEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
