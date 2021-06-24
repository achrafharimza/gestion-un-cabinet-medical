<template>
  <div class="container py-4">
    <div class="row">
      <div class="col-sm5 m-auto">
        <div class="text-center mb-4">
          <h1 style="color: #dc3545">Login</h1>
        </div>
        <form action="" @submit.prevent="hansleSubmit">
          <div class="row">
            <div class="col-sm-12 form-group">
              <label for="Reference">Entrez Votre Reference</label>
              <input
                type="text"
                name="Reference"
                id="Reference"
                placeholder="Reference"
                class="form-control form-control-lg"
                v-model="Reference"
              />
            </div>

            <div class="pt-4 col-sm-12 form-group">
              <button class="btn btn-dark btn-lg mx-1">Se connecter</button>
            </div>
            <div class="pt-4 col-sm-12 form-group mt-5">
              <p>
                Créer un compte ? <router-link to="/Signup">Signup</router-link>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Login",
  data() {
    return {
      Reference: "",
    };
  },
  methods: {
    async hansleSubmit() {
      const response = await axios.post(
        "http://localhost/briefRDV/src/Api/SignIn.php",
        {
          Reference: this.Reference,
        }
      );
      localStorage.setItem("Reference", response.data.Reference);
      if (response.data.Reference) {
        this.$router.push("/Dashboard");
      } else {
        alert("Reference incorrect !!");
      }
    },
  },
};
</script>

<style></style>
