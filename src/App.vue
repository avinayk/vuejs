<template>
<router-view></router-view>
 
</template>

<script>
import axios from "axios";
export default {
  name: "App",
  data() {
    return {
      names: ["Hi", "Test", "Hello"],
      multimes: [
        { name: "Rk Verma", email: "rk@gmail.com", phone: "1325432546" },
      ],
      uname: "",
      uemail: "",
      ugender: "",
      formSubmitted: false,
      message: "Submission Successfully! Please Login",
      showSuccessMessage: false,
    };
  },
  methods: {
    submitForm() {
      const requestOptions = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          name: this.uname,
          email: this.uemail,
          password: this.password,
          address: this.address,
          city: this.city,
          state: this.state,
        }),
      };
      axios
        .post("http://localhost/projects/vuejs/form.php", requestOptions)
        .then((response) => {
          console.log(response);
          this.uname = "";
          this.uemail = "";
          this.password = "";
          this.address = "";
          this.city = "";
          this.state = "";
          this.showSuccessMessage = true;
          setTimeout(() => {
            this.showSuccessMessage = false;
          }, 3500); // 2000 milliseconds = 2 seconds
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
form {
  padding: 10px;
  border: 2px solid black;
  border-radius: 5px;
}

input {
  padding: 4px 8px;
  margin: 4px;
}

span {
  font-size: 18px;
  margin: 4px;
  font-weight: 500;
}

.submit {
  font-size: 15px;
  color: #fff;
  background: #222;
  padding: 6px 12px;
  border: none;
  margin-top: 8px;
  cursor: pointer;
  border-radius: 5px;
}
</style>
