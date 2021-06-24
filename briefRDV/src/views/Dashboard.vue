<template>
  <div id="app">
    <div class="navbar navbar-dark bg-dark">
      <a href="#" class="navbar-brand">Doctor R-V</a>
      <ul class="nav">
        <li class="nav-item px-3">
          <router-link class="text-white" to="/">Home</router-link>
        </li>
        <li class="nav-item px-3">
          <router-link class="text-white" to="#">mon compte</router-link>
        </li>
        <li class="nav-item px-3">
          <router-link class="text-white" to="/Dashboard"
            >Dashboard</router-link
          >
        </li>
        <li class="nav-item px-3">
          <a href="#" @click.prevent="Logout" style="color: white"
            >Deconnexion</a
          >
        </li>
      </ul>
    </div>
  </div>

  <div class="container py-4">
    <h1 style="color: #dc3545" v-if="Reference">
      Votre Reference: {{ Reference }}
    </h1>
    <form>
      <!-- date input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="Date">Date</label>
        <input
          @change="ReadCreneau"
          type="date"
          id="form4Example2"
          class="form-control"
          v-model="day"
        />
      </div>

      <!-- crenau input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="form4Example1">Creneau</label>
        <select
          class="form-select"
          aria-label="Default select example"
          v-model="Num_creneau"
        >
          <option selected disabled>Selectionner un horaire</option>
          <option
            v-for="cr in creneaus"
            :value="cr.Num_creneau"
            :key="cr.Num_creneau"
          >
            {{ cr.heure }}
          </option>
        </select>
      </div>

      <!-- motif input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="Motif">Motif</label>
        <textarea
          class="form-control"
          id="form4Example3"
          rows="4"
          v-model="Motif"
        ></textarea>
      </div>

      <!-- Submit button -->
      <button
        type="submit"
        class="btn btn-dark btn-block mb-4"
        @click.prevent="AddRdv"
      >
        ajouter un RV
      </button>
    </form>
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Creneau</th>
          <th scope="col">Motif</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="r in rdv" :key="r.Id_rdv">
          <th scope="row">{{ r.Date }}</th>
          <td>{{ r.heure }}</td>
          <td>{{ r.Motif }}</td>

          <td>
            <button
              type="submit"
              class="btn btn-danger"
              @click.prevent="del(r.Id_rdv)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Dashboard",
  data() {
    return {
      Reference: localStorage.getItem("Reference"),
      Motif: "",
      day: "",
      heure: "",
      Num_creneau: "",
      rdv: [],
      Id_rdv: "",
      creneaus: [],
    };
  },

  methods: {
    ReadCreneau: function () {
      console.log(this.date);
      axios
        .post("http://localhost/briefRDV/src/Api/Creneau.php", {
          Date: this.day,
        })
        .then(
          function (response) {
            this.creneaus = response.data;
          }.bind(this)
        );
    },

    AddRdv: function () {
      axios
        .post("http://localhost/briefRDV/src/Api/Add_Rdv.php", {
          Reference: this.Reference,
          Motif: this.Motif,
          Date: this.day,
          Num_creneau: this.Num_creneau,
        })
        .then(
          function (response) {
            this.ReadRdv();
            this.ReadCreneau();
            console.log(response.data);
            console.log(Date);
          }.bind(this)
        );
      this.Num_creneau = "";
      this.Motif = "";
      this.day = "";
    },
    async ReadRdv() {
      this.Reference = localStorage.getItem("Reference");
      await axios
        .post("http://localhost/briefRDV/src/Api/ReadRdv.php", {
          Reference: this.Reference,
        })
        .then(
          function (response) {
            this.rdv = response.data;
            console.log(response.data);
          }.bind(this)
        );
    },
    del(Id_rdv) {
      axios
        .post("http://localhost/briefRDV/src/Api/Delete_Rdv.php", {
          Id_rdv: Id_rdv,
        })
        .then(
          function (response) {
            this.ReadRdv();

            alert(response.data.message);
          }.bind(this)
        );
    },
    Logout() {
      localStorage.clear();
      this.$router.push("/Login");
    },
  },
  mounted() {
    this.ReadRdv();
    this.ReadCreneau();
  },
};
</script>

<style></style>
