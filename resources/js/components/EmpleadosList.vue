<template>
  <div>
    <h2 class="mb-4">Lista de Empleados</h2>
    
    <div v-if="cargando" class="text-center my-4">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Cargando...</span>
      </div>
    </div>

    <div v-else-if="error" class="alert alert-danger" role="alert">
      {{ error }}
    </div>
    
    <div v-else>
      <div class="mb-3">
        <input 
          type="text" 
          class="form-control" 
          placeholder="Buscar por nombre o email" 
          v-model="busqueda"
        >
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Fecha de Registro</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="empleado in empleadosFiltrados" :key="empleado.IdEmpleado">
              <td>{{ empleado.IdEmpleado }}</td>
              <td>{{ empleado.Nombre }}</td>
              <td>{{ empleado.CorreoElectronico }}</td>
              <td>{{ empleado.Cargo || 'Empleado' }}</td>
              <td>{{ formatFecha(empleado.created_at) }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-if="empleadosFiltrados.length === 0" class="alert alert-info">
        No se encontraron empleados.
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const empleados = ref([]);
const cargando = ref(true);
const error = ref(null);
const busqueda = ref('');

const empleadosFiltrados = computed(() => {
  if (!busqueda.value) return empleados.value;
  
  const termino = busqueda.value.toLowerCase();
  return empleados.value.filter(e => 
    e.Nombre.toLowerCase().includes(termino) || 
    e.CorreoElectronico.toLowerCase().includes(termino)
  );
});

const cargarEmpleados = async () => {
  try {
    cargando.value = true;
    const response = await axios.get('/api/empleados');
    empleados.value = response.data;
    cargando.value = false;
  } catch (err) {
    console.error('Error al cargar empleados:', err);
    error.value = 'Error al cargar la lista de empleados. Por favor, intenta nuevamente.';
    cargando.value = false;
  }
};

const formatFecha = (fecha) => {
  if (!fecha) return 'N/A';
  return new Date(fecha).toLocaleDateString('es-ES', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric'
  });
};

onMounted(() => {
  cargarEmpleados();
});
</script>

<style scoped>
.table {
  margin-top: 20px;
}
</style>
