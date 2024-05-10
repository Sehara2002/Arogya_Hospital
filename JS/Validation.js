const validate_login = () =>{
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    if(username == ""){
        alert("Username cannot be empty");
        return false;
    }
    if(password == ""){
        alert("Password cannot be empty");
        return false;
    }else{
        console.log(username);
        console.log(password);
        return true;
    } 
}


const validate_signup = () => {
    let fname = document.getElementById("fname").value;
    let lname = document.getElementById("lname").value;
    let age = document.getElementById("age").value;
    let gender = document.getElementById("gender").value;
    let email = document.getElementById("email").value;
    let contact = document.getElementById("contact").value;
    let e_contact = document.getElementById("e_contact").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if(fname == ""){alert("First name cannot be empty");return false;}
    if(lname == ""){alert("Last name cannot be empty");return false;}
    if(gender == ""){alert("Gender cannot be empty");return false;}
    if(age == ""){alert("Age cannot be empty");return false;}
    if(contact == ""){alert("Contact Number cannot be empty");return false;}
    if(email == ""){alert("Email cannot be empty");return false;}
    if(username == ""){alert("Username cannot be empty");return false;}
    if(password == ""){alert("Password cannot be empty");return false;}
    if(e_contact == ""){alert("Emergency Contact Number cannot be empty");return false;}

    if(email_validation(email)==false){alert("Email is Invalid");return false;}

    else{
        return true;
    }

}

const email_validation = (email) =>{
    let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; 
    const result = regex.test(email);
    return result;
}

