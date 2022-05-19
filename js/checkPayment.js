
function checkName(name) {
    let regexName = /^[a-z -']+$/;
    if(regexName.test(name)){
        return true;
    }
    return false;
}
function checkPhone(phone){
    let regexPhone = /^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/;
    if(regexPhone.test(phone)){
        return true;
    }
    return false;
}

function checkPayment(){
    let submit = true;
    let name = document.getElementById("name").value;
    console.log(name);
    let phone = document.getElementById("phone").value;
    // let email = document.getElementById("email").value;
    // let address = document.getElementById("address").value;
    // let note = document.getElementById("note").value;
   console.log(checkName(name));
   console.log(checkName(phone));
    if(!checkName(name)){
       alert("Tên khum được có số hoặc kí tự đặt biệt");
       submit = false;
    }
    if(!checkPhone(phone)){
        alert("Số điện thoại không đúng");
        submit = false;
    }
    if(submit){
    return true;
    }
    return false;
}