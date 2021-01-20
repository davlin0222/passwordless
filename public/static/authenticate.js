window.onload = () => {
  document
    .querySelector(".authenticationForm")
    .addEventListener("submit", authenticationForm_submit);
};

function authenticationForm_submit(e) {
  e.preventDefault();
  alert("authenticationForm_submit");
  //let req = fetch("")
}
