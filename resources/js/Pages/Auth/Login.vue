<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div>
        <label for="email">Email</label>
        <input v-model="form.email" type="email" id="email" />
      </div>
      <div>
        <label for="password">Password</label>
        <input v-model="form.password" type="password" id="password" />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const form = ref({
      email: '',
      password: ''
    });

    const login = () => {
      axios.post('/login', form.value)
        .then(response => {
          // Handle successful login (e.g., redirect)
        })
        .catch(error => {
          // Handle error
          console.error(error);
        });
    };

    return {
      form,
      login
    };
  }
};
</script>
