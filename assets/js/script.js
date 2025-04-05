setTimeout(function() {
    var message = document.getElementById("message");
    if (message) {
      message.classList.add("fade-out"); // Adds fade-out class to start the CSS transition
  
      // Wait for the CSS transition to complete before setting display to none
      message.addEventListener("transitionend", function() {
        message.style.display = "none";
      });
    }
  }, 3000);
  
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
