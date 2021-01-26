window.onload = () => {
  checkIfLoggedIn();
  document
    .querySelector(".emailForm")
    .addEventListener("submit", emailForm_submit);
  document
    .querySelector(".verifyForm")
    .addEventListener("submit", verifyForm_submit);
};

async function emailForm_submit(e) {
  const { success } = await pwlessAuth__form_submit(e, "sendEmail");
  if (success) {
    document.querySelector(".verifyForm").classList.remove("_hidden");
  }
}

async function verifyForm_submit(e) {
  const { success, message } = await pwlessAuth__form_submit(
    e,
    "verifyCode"
  );
  if (success) {
    checkIfLoggedIn();
  } else {
    document.querySelector(
      ".pwlessAuth__issues"
    ).innerHTML = `<li class="pwlessAuth__issues__message">${message}</li>`;
  }
}

async function pwlessAuth__form_submit(e, serverAction) {
  e.preventDefault();
  formData = new FormData(e.target);
  const resJson = await fetch(`public/src/${serverAction}.php`, {
    method: "POST",
    body: formData,
  });
  const res = await resJson.json();
  console.log("pwlessAuth__form_submit ~ res", res);
  if (res.debugRespons) {
    console.log(
      "pwlessAuth__form_submit ~ res.debugRespons.code \n",
      res.debugRespons.code
    );
  }
  return { success: res.success, message: res.message };
}

async function formFetch(serverScriptName, formData) {
  document.querySelector(".pwlessAuth__issues").innerHTML = "";
  let success;
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
        success = res.success;
        console.log("resJson.json ~ success", success);
      });
    })
    .catch((err) => console.log(err));
  console.log("resJson.json ~ success", success);
  return await success;
}

function checkIfLoggedIn() {
  fetch("public/src/checkIfLoggedIn.php").then((resJson) => {
    resJson.json().then((res) => {
      console.log("checkIfLoggedIn ~ res", res);
      if (res.isLoggedIn) {
        renderAsLoggedIn(res.accountSecretMessage);
      }
    });
  });
}

function renderAsLoggedIn(accountSecretMessage) {
  document
    .querySelector(".pwlessAuth__accountSecrets")
    .classList.remove("_hidden");
  document.querySelector(".pwlessAuth__heading").classList.add("_hidden");
  document
    .querySelectorAll(".pwlessAuth__form")[0]
    .classList.add("_hidden");
  document
    .querySelectorAll(".pwlessAuth__form")[1]
    .classList.add("_hidden");
  document.querySelector(".pwlessAuth__issues").classList.add("_hidden");
  document.querySelector(
    ".pwlessAuth__accountSecrets__textarea"
  ).value = accountSecretMessage;
}
