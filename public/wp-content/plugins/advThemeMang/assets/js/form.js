// import axios from "axios";
 class formLoader {
  constructor() {
    this.form = document.querySelector(".sunsetform");
    this.name = document.querySelector("#name");
    this.email = this.form.querySelector("#email");
    this.message = this.form.querySelector("#message");
    this.inputField = document.querySelectorAll(".sunsetform__field--input");
    this.url = this.form.dataset.url;
    this.submit = this.form.querySelector(".sunsetform__btn");
    this.submitProgress = this.form.querySelector(".sunsetform__msg--progress");
    this.submitSuccess = this.form.querySelector(".sunsetform__msg--success");
    this.submitFailure = this.form.querySelector(".sunsetform__msg--failure");
    this.invalidMsg = this.form.querySelectorAll(".sunsetform__msg--invalid");
    this.events();
  }
  /*  =====================================
          Event handlers
      ===================================== */

  events() {
    console.log('from the form')
    this.form.addEventListener("submit", (e) => {
      e.preventDefault();

      this.invalidMsg.forEach((msg) => {
        msg.style.display = "none";
      });

      this.formhandler();
    });
  }

  /*  =====================================
          Methods
      ===================================== */

//   async formhandler() {
//     let name = this.name.value;
//     let email = this.email.value;
//     let message = this.message.value;
//     let emptyFeilds = 0;
//     this.inputField.forEach((input) => {
//       if (input.value == "") {
//         console.log(input.value);
//         emptyFeilds++;
//         input.nextElementSibling.style.display = "block";
//       }
//     });
//     if (emptyFeilds) {
//       console.log(emptyFeilds);
//       return;
//     }

//     const data = new URLSearchParams({
//       name: name,
//       email: email,
//       message: message,
//       action: "sunset_contact_form_data",
//     });

    // try {
    //   this.submitProgress.style.display = "block";
    //   this.inputField.forEach((input) => {
    //     input.disabled = true;
    //   });
//       const result = await axios.post(this.url, data);
//       if (result.data == 0) {
//         this.submitProgress.style.display = "none";
//         this.submitFailure.style.display = "block";
//         this.inputField.forEach((input) => {
//           input.disabled = false;
//         });
//         return;
//       } else {
//         this.submitProgress.style.display = "none";
//         this.submitSuccess.style.display = "block";
//         this.inputField.forEach((input) => {
//           input.disabled = false;
//           input.value = "";
//         });
//         return;
//       }
//     } catch (error) {
//       this.progress.style.display = "none";
//       this.failure.style.display = "block";
//       this.inputField.forEach((input) => {
//         input.disabled = false;
//       });
//     }
//   }
}

document.addEventListener("DOMContentLoaded", (e) => {
    new formLoader();
});