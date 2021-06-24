<template>
  <div class="container py-4">
    <div class="row">
      <div class="col-sm5 m-auto">
        <div class="text-center mb-4">
          <h1 style="color: #dc3545">Regitre</h1>
        </div>
        <form action="" id="login-form" @submit.prevent="handleSubmit">
          <div class="row">
            <div class="col-sm-12 form-group">
              <label for="Nom">Nom :</label>
              <input
                type="text"
                class="form-control form-control-lg"
                placeholder=" nom"
                v-model="nom"
              />
            </div>
            <div class="col-sm-12 form-group">
              <label for="Prenom">Prenom :</label>
              <input
                type="text"
                class="form-control form-control-lg"
                placeholder=" prenom"
                v-model="prenom"
              />
            </div>
            <div class="col-sm-12 form-group">
              <label for="Age">Age :</label>
              <input
                type="number"
                class="form-control form-control-lg"
                placeholder=" Age"
                v-model="Age"
              />
            </div>
            <div class="col-sm-12 form-group">
              <label for="Cin">Cin :</label>
              <input
                type="text"
                class="form-control form-control-lg"
                placeholder="C.I.N"
                v-model="cin"
              />
            </div>
            <div class="col-sm-12 form-group">
              <label for="Numero">Numero de telephone :</label>
              <input
                type="number"
                class="form-control form-control-lg"
                placeholder=" numero de telephone"
                v-model="tele"
              />
            </div>
            <div class="pt-4 col-sm-12 form-group">
              <button class="btn btn-dark btn-lg mx-1">regiter</button>
            </div>
            <div class="pt-4 col-sm-12 form-group mt-5">
              <p>
                Vous-avez deja un compte ?
                <router-link to="/Login">Login</router-link>
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
  name: "Signup",
  data() {
    return {
      nom: "",
      prenom: "",
      Age: "",
      tele: "",
      cin: "",
    };
  },
  methods: {
    async handleSubmit() {
      const response = await axios.post(
        "http://localhost/briefRDV/src/Api/Signup.php",
        {
          nom: this.nom,
          prenom: this.prenom,
          Age: this.Age,
          tele: this.tele,
          cin: this.cin,
        }
      );
      console.log(response);
      if (response.data.reference) {
        localStorage.setItem("Reference", response.data.reference);
        this.$router.push("/Dashboard");
      } else {
        alert(response.data.message);
      }
    },
  },
};
</script>

<style></style>
