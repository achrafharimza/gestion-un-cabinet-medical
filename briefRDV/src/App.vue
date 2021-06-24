<template>
  <router-view />
</template>
<script>
export default {
  name: "login",
  props: ["Reference"],
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: black;
  font-size: large;
}

#nav {
  padding: 30px;
}

a {
  font-weight: bold;
  color: #2c3e50;
  list-style: none;
  text-decoration: none;
}
</style>
