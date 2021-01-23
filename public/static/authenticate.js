window.onload = () => {
  document
    .querySelector(".emailForm")
    .addEventListener("submit", emailForm_submit);
  document
    .querySelector(".verifyForm")
    .addEventListener("submit", verifyForm_submit);
};

function emailForm_submit(e) {
  document.querySelector(".verifyForm").classList.remove("_hidden");
  e.preventDefault();
  alert("emailForm_submit");
  //let req = fetch("")
}
function verifyForm_submit(e) {
  e.preventDefault();
  alert("verifyForm_submit");
  //let req = fetch("")
}
