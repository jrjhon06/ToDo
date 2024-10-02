<template>
  <div>
    <h1>Mis Notas</h1>
    <form @submit.prevent="createNote">
      <input v-model="form.title" placeholder="Título" required />
      <textarea v-model="form.description" placeholder="Descripción" required></textarea>
      <input v-model="form.tags" placeholder="Etiquetas" />
      <input v-model="form.due_date" type="date" placeholder="Fecha de vencimiento" />
      <input type="file" @change="handleFileUpload" />
      <button type="submit">Crear Nota</button>
    </form>

    <div v-if="notes.length > 0">
      <h2>Listado de Notas</h2>
      <ul>
        <li v-for="note in notes" :key="note.id">
          {{ note.title }} - {{ note.description }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';

export default {
  setup() {
    const form = ref({
      title: '',
      description: '',
      tags: '',
      due_date: '',
      image: null
    });
    const notes = ref([]);

    const createNote = () => {
      const formData = new FormData();
      formData.append('title', form.value.title);
      formData.append('description', form.value.description);
      formData.append('tags', form.value.tags);
      formData.append('due_date', form.value.due_date);
      if (form.value.image) {
        formData.append('image', form.value.image);
      }

      axios.post('/notes', formData)
        .then(response => {
          notes.value.push(response.data.note);
          form.value = { title: '', description: '', tags: '', due_date: '', image: null };
        })
        .catch(error => console.error(error));
    };

    const handleFileUpload = (event) => {
      form.value.image = event.target.files[0];
    };

    onMounted(() => {
      axios.get('/notes').then(response => {
        notes.value = response.data;
      });
    });

    return {
      form,
      notes,
      createNote,
      handleFileUpload
    };
  }
};
</script>
