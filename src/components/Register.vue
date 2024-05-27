<template>
  <router-view></router-view>
  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div v-if="showSuccessMessage" class="alert alert-success">
              {{ message }}
            </div>
            <div v-if="errorMessage" class="alert alert-danger">
              {{ error }}
            </div>
            <form @submit.prevent="submitForm" class="php-email-form">
              <div class="section-title">
                <h2>Sign Up</h2>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="uname"
                    placeholder="Your Name"
                    required
                  />
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="uemail"
                    placeholder="Your Email"
                    required
                  />
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="password"
                    class="form-control"
                    v-model="password"
                    id="password"
                    placeholder="Your Password"
                    required
                  />
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="city"
                    class="form-control"
                    id="city"
                    v-model="city"
                    placeholder="Your City"
                    required
                  />
                </div>
                <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="state"
                    v-model="state"
                    placeholder="Your State"
                    required
                  />
                </div>
                <div class="col-md-12 form-group">
                  <textarea
                    type="email"
                    class="form-control"
                    id="address"
                    v-model="address"
                    placeholder="Your Address"
                    required
                  ></textarea>
                </div>
              </div>
              <div class="text-center">
                <button type="submit">Sign Up</button>
                <router-link to="/login" class="subb ml-2">Login</router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact Section -->
</template>

<script>
import axios from "axios";
export default {
  name: "App",
  created() {
    const isAuthenticated = sessionStorage.getItem("users");
    if (isAuthenticated) {
      this.$router.push("/home");
    }
  },
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
      errorMessage: false,
      error: "Email is already exits!",
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
          if (response.data == 1) {
            this.errorMessage = true;

            setTimeout(() => {
              this.errorMessage = false;
            }, 3500); // 2000 milliseconds = 2 seconds
          } else {
            this.uname = "";
            this.uemail = "";
            this.password = "";
            this.address = "";
            this.city = "";
            this.state = "";
            this.showSuccessMessage = true;
            // sessionStorage.setItem('users', JSON.stringify(response.data))

            setTimeout(() => {
              this.showSuccessMessage = false;
            }, 3500); // 2000 milliseconds = 2 seconds
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.subb {
  background: #e03a3c;
  border: 0;
  padding: 13px 32px;
  color: #fff;
  transition: 0.4s;
  border-radius: 4px;
}
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
