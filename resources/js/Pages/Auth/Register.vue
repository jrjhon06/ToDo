<template>
  <div>
    <h1>Register</h1>
    <form @submit.prevent="register">
      <div>
        <label for="name">Name</label>
        <input v-model="form.name" type="text" id="name" />
      </div>
      <div>
        <label for="email">Email</label>
        <input v-model="form.email" type="email" id="email" />
      </div>
      <div>
        <label for="password">Password</label>
        <input v-model="form.password" type="password" id="password" />
      </div>
      <button type="submit">Register</button>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const form = ref({
      name: '',
      email: '',
      password: ''
    });

    const register = () => {
      axios.post('/register', form.value)
        .then(response => {
          // Handle successful registration (e.g., redirect)
        })
        .catch(error => {
          // Handle error
          console.error(error);
        });
    };

    return {
      form,
      register
    };
  }
};
</script>
