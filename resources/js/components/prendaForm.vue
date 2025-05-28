<template>
    <form @submit.prevent="enviarPrenda">
        <div class="mb-3">
            <label class="form-label">Categoría de Prenda</label>
            <select v-model="categoriaSeleccionada" class="form-select" required @change="actualizarTiposPrenda">
                <option disabled value="">Selecciona...</option>
                <option value="Ropa">Ropa</option>
                <option value="Edredón">Edredón</option>
                <option value="Sábana">Sábana</option>
            </select>
        </div>

        <div class="mb-3" v-if="categoriaSeleccionada === 'Ropa'">
            <label class="form-label">Tipo de Prenda</label>
            <select v-model="prendaSeleccionada" class="form-select" required>
                <option disabled value="">Selecciona...</option>
                <option v-for="item in tiposPrendaFiltrados" :key="item.id" :value="item">
                    {{ item.tipo }}
                </option>
            </select>
        </div>

        <div class="mb-3" v-if="categoriaSeleccionada === 'Ropa' && prendaSeleccionada">
            <label class="form-label">Color</label>
            <select v-model="prenda.color" class="form-select" required>
                <option disabled value="">Selecciona...</option>
                <option value="Blanco">Blanco</option>
                <option value="Negro">Negro</option>
                <option value="Azul">Azul</option>
                <option value="Gris">Gris</option>
                <option value="Rojo">Rojo</option>
            </select>
        </div>

        <div class="mb-3">
            <div class="row d-flex justify-around">
                <div class="form-check col ps-2">
                    <input
                        class="form-check-input m-1"
                        type="radio"
                        name="flexRadioDefault"
                        id="radioCantidad"
                        checked
                        @change="radioControl = 'cantidad'"
                    />
                    <label class="form-check-label ps-1" for="radioCantidad">
                        Por Cantidad
                    </label>
                </div>
                <div class="form-check col">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="flexRadioDefault"
                        id="radioPeso"
                        @change="radioControl = 'peso'"
                    />
                    <label class="form-check-label" for="radioPeso">
                        Por Peso
                    </label>
                </div>
            </div>
            <div class="input-group mt-2 mb-3">
                <input
                    v-if="radioControl == 'cantidad'"
                    type="number"
                    v-model="prenda.cantidad"
                    class="form-control"
                    required
                    min="1"
                />
                <input
                    v-else-if="radioControl == 'peso'"
                    type="number"
                    v-model="prenda.peso"
                    class="form-control"
                    required
                    min="1"
                />
                <span
                    v-if="radioControl == 'cantidad'"
                    class="input-group-text"
                    id="basic-addon2"
                    >Prendas</span
                >
                <span
                    v-else-if="radioControl == 'peso'"
                    class="input-group-text"
                    id="basic-addon2"
                    >Kg</span
                >
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Lavado</label>
            <select v-model="servicioLavadoSeleccionado" class="form-select" required>
                <option disabled value="">Selecciona...</option>
                <option v-for="servicio in serviciosLavado" :key="servicio.id" :value="servicio">
                    {{ servicio.nombre }} ({{ servicio.precio }} S/)
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Planchado <span v-if="categoriaSeleccionada !== 'Ropa'">(Opcional)</span></label>
            <select v-model="servicioPlanchadoSeleccionado" class="form-select" :required="categoriaSeleccionada === 'Ropa'">
                <option disabled value="">Selecciona...</option>
                <option v-for="servicio in serviciosPlanchado" :key="servicio.id" :value="servicio">
                    {{ servicio.nombre }} ({{ servicio.precio }} S/)
                </option>
            </select>
            <div v-if="categoriaSeleccionada !== 'Ropa'" class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="sinPlanchado" v-model="omitirPlanchado">
                <label class="form-check-label" for="sinPlanchado">
                    No requiere planchado
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Agregar Prenda
        </button>
    </form>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";

import { prendasDB } from "../dataJs.js";
import { serviciosDB } from "../dataJs.js";

// Estado para la selección de categoría y tipo de prenda
const categoriaSeleccionada = ref("");
const prendaSeleccionada = ref(null);
const servicioLavadoSeleccionado = ref(null);
const servicioPlanchadoSeleccionado = ref(null);
const radioControl = ref("cantidad");
const omitirPlanchado = ref(false);

// Filtrar tipos de prenda según la categoría seleccionada
const tiposPrendaFiltrados = computed(() => {
    if (!categoriaSeleccionada.value) return [];
    
    // Obtener tipos únicos para la categoría seleccionada
    const tiposUnicos = {};
    prendasDB.forEach(prenda => {
        if (!tiposUnicos[prenda.tipo]) {
            tiposUnicos[prenda.tipo] = prenda;
        }
    });
    
    return Object.values(tiposUnicos);
});

// Filtrar servicios por tipo
const serviciosLavado = computed(() => {
    return serviciosDB.filter(servicio => servicio.tipo === "lavado");
});

const serviciosPlanchado = computed(() => {
    return serviciosDB.filter(servicio => servicio.tipo === "planchado");
});

// Función para actualizar tipos de prenda cuando cambia la categoría
const actualizarTiposPrenda = () => {
    prendaSeleccionada.value = null;
    prenda.value.color = "";
};

// Estado principal de la prenda
const prenda = ref({
    tipo: "",
    color: "",
    idPrenda: "",
    idLavado: "",
    idPlanchado: "",
    cantidad: 0,
    peso: 0,
    lavado: "",
    planchado: "",
    precio: 0
});

const emit = defineEmits(["prenda-agregada"]);

// Enviar prenda al componente padre
const enviarPrenda = () => {
    // Validaciones según el tipo de categoría
    if (categoriaSeleccionada.value === 'Ropa') {
        // Para Ropa necesitamos tipo, color y servicios
        if (!prendaSeleccionada.value || !servicioLavadoSeleccionado.value || 
            !servicioPlanchadoSeleccionado.value || !prenda.value.color) {
            alert("Por favor completa todos los campos del formulario");
            return;
        }
    } else {
        // Para Edredón y Sábana solo necesitamos la categoría y servicios
        if (!categoriaSeleccionada.value || !servicioLavadoSeleccionado.value) {
            alert("Por favor selecciona al menos la categoría y el tipo de lavado");
            return;
        }
    }
    
    // Verificar que se haya ingresado cantidad o peso
    if ((radioControl.value === "cantidad" && !prenda.value.cantidad) ||
        (radioControl.value === "peso" && !prenda.value.peso)) {
        alert("Por favor ingresa la cantidad o peso");
        return;
    }
    
    // Asignar valores seleccionados según la categoría
    if (categoriaSeleccionada.value === 'Ropa') {
        prenda.value.tipo = prendaSeleccionada.value.tipo;
        prenda.value.idPrenda = prendaSeleccionada.value.id;
    } else {
        // Para Edredón y Sábana, usamos la categoría como tipo
        prenda.value.tipo = categoriaSeleccionada.value;
        // Buscar un ID apropiado o usar uno predeterminado
        const prendaDefault = prendasDB.find(p => p.tipo.includes(categoriaSeleccionada.value)) || prendasDB[0];
        prenda.value.idPrenda = prendaDefault.id;
        prenda.value.color = "N/A"; // No aplica color para estas categorías
    }
    
    // Asignar servicios
    prenda.value.idLavado = servicioLavadoSeleccionado.value.id;
    prenda.value.lavado = servicioLavadoSeleccionado.value.nombre;
    
    // El planchado puede ser opcional para Edredón y Sábana
    if (categoriaSeleccionada.value !== 'Ropa' && omitirPlanchado.value) {
        // Si se marcó la opción de omitir planchado
        prenda.value.idPlanchado = 4; // ID del servicio "Sin planchado"
        prenda.value.planchado = "Sin planchado";
    } else if (servicioPlanchadoSeleccionado.value) {
        // Si se seleccionó un servicio de planchado
        prenda.value.idPlanchado = servicioPlanchadoSeleccionado.value.id;
        prenda.value.planchado = servicioPlanchadoSeleccionado.value.nombre;
    } else if (categoriaSeleccionada.value !== 'Ropa') {
        // Si no se seleccionó planchado para Edredón/Sábana, usar un valor por defecto
        prenda.value.idPlanchado = 4; // ID del servicio "Sin planchado"
        prenda.value.planchado = "Sin planchado";
    }
    
    // Calcular precio basado en los servicios seleccionados
    const precioLavado = servicioLavadoSeleccionado.value.precio;
    let precioPlanchado = 0;
    
    // Si no se omite el planchado y hay un servicio seleccionado, usar su precio
    if (!omitirPlanchado.value && servicioPlanchadoSeleccionado.value) {
        precioPlanchado = servicioPlanchadoSeleccionado.value.precio;
    }
    
    const precioUnitario = precioLavado + precioPlanchado;
    
    // Calcular precio total según cantidad o peso
    if (radioControl.value === "cantidad") {
        prenda.value.precio = precioUnitario * prenda.value.cantidad;
    } else {
        prenda.value.precio = precioUnitario * prenda.value.peso;
    }
    
    // Enviar prenda al componente padre
    emit("prenda-agregada", { ...prenda.value });
    
    // Reiniciar formulario pero mantener categoría
    const categoriaActual = categoriaSeleccionada.value;
    prendaSeleccionada.value = null;
    servicioLavadoSeleccionado.value = null;
    servicioPlanchadoSeleccionado.value = null;
    omitirPlanchado.value = false;
    
    prenda.value = {
        tipo: "",
        color: "",
        idPrenda: "",
        idLavado: "",
        idPlanchado: "",
        cantidad: 0,
        peso: 0,
        lavado: "",
        planchado: "",
        precio: 0
    };
};
</script>
