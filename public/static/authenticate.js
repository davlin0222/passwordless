window.onload = () => {
  document
    .querySelector(".emailForm")
    .addEventListener("submit", emailForm_submit);
  document
    .querySelector(".verifyForm")
    .addEventListener("submit", verifyForm_submit);
};

function emailForm_submit(e) {
  e.preventDefault();
  // alert("emailForm_submit");
  emailForm_data = new FormData(e.target);
  formFetch("sendEmail", emailForm_data, ".verifyForm");
}

function verifyForm_submit(e) {
  e.preventDefault();
  // alert("verifyForm_submit");
  verifyForm_data = new FormData(e.target);
  formFetch("verifyCode", verifyForm_data, ".pwlessAuth__accountSecrets");
}

function formFetch(serverScriptName, formData, displayElementsWithClass) {
  fetch(`public/src/${serverScriptName}.php`, {
    method: "POST",
    body: formData,
  })
    .then((resJson) => {
      resJson.json().then((res) => {
        console.log("formFetch ~ res", res);
        if (res.debugRespons) {
          console.log(
            "formFetch ~ res.debugRespons.code \n",
            res.debugRespons.code
          );
        }
        if (res.success) {
          document
            .querySelector(displayElementsWithClass)
            .classList.remove("_hidden");
        }
      });
    })
    .catch((err) => console.log(err));
}
