window.onload = () => {
  document
    .querySelector(".emailForm")
    .addEventListener("submit", emailForm_submit);
  document
    .querySelector(".verifyForm")
    .addEventListener("submit", verifyForm_submit);
};

async function emailForm_submit(e) {
  e.preventDefault();
  // alert("emailForm_submit");
  document.querySelector(".verifyForm").classList.remove("_hidden");
  emailForm_data = new FormData(e.target);
  // console.log("emailForm_submit ~ emailForm_data", ...emailForm_data);

  let res = await fetch("public/src/sendEmail.php", {
    method: "POST",
    body: emailForm_data,
  });
  let data = await res.json();
  console.log("emailForm_submit ~ res", res);
  console.log("emailForm_submit ~ data", data);

  localStorage.setItem(
    "passwordless-verificationCode",
    data.verificationCode
  );

  // fetch(
  //   "https://creatorise.com/projects/simply-for-fun/passwordless/public/src/email.php",
  //   { method: "POST", body: emailForm_data }
  // )
  //   .then((res) => {
  //     res.text();
  //   })
  //   .then((text) => {
  //     console.log(text);
  //   });
}
async function verifyForm_submit(e) {
  e.preventDefault();
  // alert("verifyForm_submit");
  document.querySelector(".accountSecrets").classList.remove("_hidden");

  verifyForm = new FormData(e.target);
  let res = await fetch("public/src/verifyCode.php", {
    method: "POST",
    body: verifyForm,
  });
  let data = await res.json();
  console.log("emailForm_submit ~ res", res);
  console.log("emailForm_submit ~ data", data);
}
