//I certify that this submission is my own original work-Alvin Varughese

function validateForm() {
    let username = document.forms["registerForm"]["username"].value;
    if (username == "") {
      alert("Username must be filled out");
      return false;
    }
  }
  