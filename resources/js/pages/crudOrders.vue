<template>
    <div class="container mt-4">
        <h2 class="mb-4">Gestión de Prendas</h2>

        <!-- Formulario de Registro -->
        <form
            @submit.prevent="eventoForm"
            class="mb-4"
            :class="{ 'modo-edicion': modoEdicion }"
        >
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Edredones</label>
                    <input
                        v-model.number="nuevaPrenda.edredones"
                        type="number"
                        class="form-control"
                        required
                    />
                </div>

                <div class="col-md-4">
                    <label class="form-label">Sábanas</label>
                    <input
                        v-model.number="nuevaPrenda.sabanas"
                        type="number"
                        class="form-control"
                        required
                    />
                </div>

                <div class="col-md-4">
                    <label class="form-label">Colores de la ropa</label>
                    <select
                        v-model="nuevaPrenda.colorRopa"
                        class="form-select"
                        required
                    >
                        <option value="blanca">Ropa blanca o muy clara</option>
                        <option value="intensa">
                            Ropa de colores intensos
                        </option>
                        <option value="oscura">Ropa negra o muy oscura</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Número de Prendas</label>
                    <input
                        v-model.number="nuevaPrenda.numPrendas"
                        type="number"
                        class="form-control"
                        required
                    />
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tipo de Lavado</label>
                    <select
                        v-model="nuevaPrenda.tipoLavado"
                        class="form-select"
                        required
                    >
                        <option value="delicado">Delicado</option>
                        <option value="normal">Normal</option>
                        <option value="seco">Seco</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Planchado</label>
                    <select
                        v-model="nuevaPrenda.planchado"
                        class="form-select"
                        required
                    >
                        <option value="no">Sin planchado</option>
                        <option value="suave">Planchado suave</option>
                        <option value="normal">Planchado normal</option>
                        <option value="fuerte">Planchado fuerte</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tipo de Pago</label>
                    <select
                        v-model="nuevaPrenda.tipoPago"
                        class="form-select"
                        required
                    >
                        <option value="yape">Yape</option>
                        <option value="transferencia">
                            Transferencia Bancaria
                        </option>
                        <option value="tarjeta">Tarjeta Débito/Crédito</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Código Ticket</label>
                    <input
                        v-model="nuevaPrenda.codigoTicket"
                        type="text"
                        class="form-control"
                        required
                        readonly
                    />
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fecha de Ingreso</label>
                    <input
                        id="inputDate"
                        v-model="nuevaPrenda.fechaIngreso"
                        type="date"
                        class="form-control"
                        required
                        readonly
                    />
                </div>
            </div>

            <button
                type="submit"
                class="btn btn-primary mt-3"
                :disabled="!formularioValido"
            >
                {{ modoEdicion ? "Actualizar Prenda" : "Agregar Prenda" }}
            </button>

            <button
                v-if="modoEdicion"
                type="button"
                class="btn btn-secondary mt-3 ms-2"
                @click="cancelarEdicion"
                title="Cancelar Edicion"
            >
                Cancelar
            </button>
        </form>

        <!-- Lista de Prendas -->
        <div v-if="prendas.length">
            <h3>Lista de Prendas</h3>
            <table class="table table-striped container text-center">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Edredones</th>
                        <th>Sábanas</th>
                        <th>Color</th>
                        <th>Número de Prendas</th>
                        <th>Lavado</th>
                        <th>Planchado</th>
                        <th>Pago</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(prenda, index) in prendas"
                        :key="prenda.codigoTicket"
                    >
                        <td>{{ prenda.codigoTicket }}</td>
                        <td>{{ prenda.edredones }}</td>
                        <td>{{ prenda.sabanas }}</td>
                        <td>{{ prenda.colorRopa }}</td>
                        <td>{{ prenda.numPrendas }}</td>
                        <td>{{ prenda.tipoLavado }}</td>
                        <td>{{ prenda.planchado }}</td>
                        <td>{{ prenda.tipoPago }}</td>
                        <td>{{ prenda.fechaIngreso }}</td>
                        <td>
                            <div class="row justify-content-around">
                                <button
                                    class="d-flex btn btn-primary btn-sm col-4 align-items-center justify-content-center"
                                    @click="editarPrenda(index)"
                                    tittle="Editar"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-pencil-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"
                                        />
                                    </svg></button
                                ><button
                                    class="d-flex btn btn-danger btn-sm col-4 align-items-center justify-content-center"
                                    @click="eliminarPrenda(index)"
                                    tittle="Eliminar"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-trash3-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="container mt-4 pe-5">
                <button
                    @click="reiniciarTickes"
                    class="d-flex btn btn-primary btn-l justifify-content-center"
                >
                    Reiniciar contador tickets
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";

//Variables Informativas
const date = new Date();
const formattedDate = date.toISOString().split("T")[0];

//Variables Reactivas
const codigoTicket = ref(1);
const prendas = ref([]);
const nuevaPrenda = ref({
    edredones: 0,
    sabanas: 0,
    colorRopa: "blanca",
    numPrendas: 0,
    tipoLavado: "normal",
    planchado: "no",
    tipoPago: "yape",
    codigoTicket: String(codigoTicket.value).padStart(4, 0),
    fechaIngreso: formattedDate,
});
const prendaTemporal = ref({});
const modoEdicion = ref(false);
const codigoEdicion = ref(null);

//Funciones CRUD
const agregarPrenda = () => {
    prendas.value.push({ ...nuevaPrenda.value });
    codigoTicket.value++;
    limpiarFormulario();

    guardarLocalStorage("codigoTicket", codigoTicket);
    guardarLocalStorage("arrayPrendas", prendas);
};

const editarPrenda = (index) => {
    modoEdicion.value = true;
    prendaTemporal.value = { ...prendas.value[index] };
    codigoEdicion.value = prendaTemporal.value.codigoTicket;
    nuevaPrenda.value = { ...prendaTemporal.value };
};

const actualizarPrenda = () => {
    if (codigoEdicion.value !== null) {
        prendaTemporal.value = { ...nuevaPrenda.value };
        const codigoPrenda = prendas.value.findIndex(
            (e) => e.codigoTicket === prendaTemporal.value.codigoTicket
        );
        prendas.value[codigoPrenda] = { ...prendaTemporal.value };

        limpiarFormulario();
        guardarLocalStorage("arrayPrendas", prendas);
    }
};

const eliminarPrenda = (index) => {
    prendas.value.splice(index, 1);
    guardarLocalStorage("arrayPrendas", prendas);
};

//Funciones Auxiliares
const formularioValido = computed(() => {
    return (
        nuevaPrenda.value.edredones >= 0 &&
        nuevaPrenda.value.sabanas >= 0 &&
        nuevaPrenda.value.numPrendas > 0 &&
        nuevaPrenda.value.colorRopa &&
        nuevaPrenda.value.tipoLavado &&
        nuevaPrenda.value.planchado &&
        nuevaPrenda.value.tipoPago
    );
});

const limpiarFormulario = () => {
    nuevaPrenda.value = {
        edredones: 0,
        sabanas: 0,
        colorRopa: "blanca",
        numPrendas: 0,
        tipoLavado: "normal",
        planchado: "no",
        tipoPago: "yape",
        codigoTicket: String(codigoTicket.value).padStart(4, 0),
        fechaIngreso: formattedDate,
    };
    modoEdicion.value = false;
    codigoEdicion.value = null;
};

const cancelarEdicion = () => {
    limpiarFormulario();
};

const eventoForm = () => {
    if (modoEdicion.value) {
        actualizarPrenda();
    } else {
        agregarPrenda();
    }
};

const reiniciarTickes = () => {
    codigoTicket.value = 1;
    prendas.value = [];
    limpiarFormulario();
    guardarLocalStorage("codigoTicket", codigoTicket);
};

//LOCAL STORAGE
/*GUARDAR*/

const guardarLocalStorage = (name, item) => {
    localStorage.setItem(name, JSON.stringify(item.value));
};

/* RECUPERAR */
const cargarItemLocalStorage = (name, item) => {
    const datos = localStorage.getItem(name);
    if (datos !== "undefined") {
        item.value = JSON.parse(datos);
    }
};

onMounted(() => {
    cargarItemLocalStorage("arrayPrendas", prendas);
    cargarItemLocalStorage("codigoTicket", codigoTicket);
    limpiarFormulario();
});
</script>

<style scoped>
.container {
    max-width: 900px;
}

.modo-edicion {
    background-color: #ffeeba;
    padding: 10px;
    border-radius: 5px;
}
</style>
