<template>
    <div class="container mt-4">
        <h2 class="mb-4">Gestión de Ordenes</h2>

        <!-- Formulario de Registro -->
        <form @submit.prevent="agregarOrden" class="mb-4">
            <div class="row g-3">
                <div class="col ms-3">
                    <div class="row-md-4 input-group align-item-center m-0 p-0">
                        <label
                            class="form-label col d-flex m-0 align-items-center"
                        >
                            Número de Prendas
                        </label>
                        <input
                            v-model.number="nuevaOrden.numPrendas"
                            type="number"
                            class="form-control col border rounded-start"
                            required
                            readonly
                        />
                    </div>
                    <div class="row-md-4 mt-2">
                        <label class="form-label"> Colores de Prendas </label>
                        <ul class="w-100 list-group mt-1">
                            <li
                                class="list-group-item p-0 border-0"
                                data-bs-toggle="collapse"
                                href="#collapseColoresRopa"
                                role="button"
                                aria-expanded="false"
                                aria-controls="collapseExample"
                            >
                                <div
                                    class="d-flex w-100 h-100 input-group align-item-center m-0 p-0"
                                >
                                    <input
                                        type="text"
                                        class="form-control"
                                        aria-label="Text input with dropdown button"
                                        value="Seleccione el color de las prendas"
                                        readonly
                                        disabled
                                        @click="toggleColors"
                                    />
                                    <button
                                        id="btnCollapse"
                                        type="button"
                                        class="btn btn-secondary d-flex align-items-center h-100"
                                        @click="toggleColors"
                                    >
                                        <svg
                                            v-if="toggleColor"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="24"
                                            fill="currentColor"
                                            class="bi bi-caret-down-fill"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"
                                            />
                                        </svg>
                                        <svg
                                            v-if="!toggleColor"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="24"
                                            fill="currentColor"
                                            class="bi bi-caret-right-fill"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </li>
                            <li
                                class="list-group-item p-0 border-0 collapse"
                                id="collapseColoresRopa"
                            >
                                <div class="input-group">
                                    <label
                                        type="text"
                                        class="form-control"
                                        for="numColor"
                                    >
                                        Ropa blanca o muy clara
                                    </label>
                                    <input
                                        v-model.number="
                                            nuevaOrden.colorRopa.ropaClara
                                        "
                                        type="number"
                                        id="numColor"
                                        class="border border-end rounded-end ps-2"
                                        style="width: 4rem"
                                    />
                                </div>
                            </li>
                            <li
                                class="list-group-item p-0 border-0 collapse"
                                id="collapseColoresRopa"
                            >
                                <div class="input-group">
                                    <label
                                        type="text"
                                        class="form-control"
                                        for="numColor"
                                    >
                                        Ropa de colores intensos
                                    </label>
                                    <input
                                        v-model.number="
                                            nuevaOrden.colorRopa.ropaIntenso
                                        "
                                        type="number"
                                        id="numColor"
                                        class="border border-end rounded-end ps-2"
                                        style="width: 4rem"
                                    />
                                </div>
                            </li>
                            <li
                                class="list-group-item p-0 border-0 collapse"
                                id="collapseColoresRopa"
                            >
                                <div class="input-group">
                                    <label
                                        type="text"
                                        class="form-control"
                                        for="numColor"
                                    >
                                        Ropa negra o muy oscura
                                    </label>
                                    <input
                                        v-model.number="
                                            nuevaOrden.colorRopa.ropaOscura
                                        "
                                        type="number"
                                        id="numColor"
                                        class="border border-end rounded-end ps-2"
                                        style="width: 4rem"
                                    />
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="row-md-4 input-group mt-4">
                        <label
                            class="form-label col d-flex m-0 align-items-center"
                        >
                            Edredones
                        </label>
                        <input
                            v-model.number="nuevaOrden.edredones"
                            type="number"
                            class="form-control col border rounded-start"
                            required
                        />
                    </div>
                    <div class="row-md-4 input-group mt-4">
                        <label
                            class="form-label col d-flex m-0 align-items-center"
                        >
                            Sábanas
                        </label>
                        <input
                            v-model.number="nuevaOrden.sabanas"
                            type="number"
                            class="form-control col border rounded-start"
                            required
                        />
                    </div>
                </div>
                <div class="col ms-2">
                    <div class="row-md-4 input-group">
                        <label class="col form-label">Tipo de Lavado</label>
                        <select
                            v-model="nuevaOrden.tipoLavado"
                            class="form-select col border rounded-start"
                            required
                        >
                            <option value="delicado">Delicado</option>
                            <option value="normal">Normal</option>
                            <option value="seco">Seco</option>
                        </select>
                    </div>

                    <div class="row-md-4 input-group mt-3">
                        <label
                            class="form-label col d-flex m-0 align-items-center"
                        >
                            Planchado
                        </label>
                        <select
                            v-model="nuevaOrden.planchado"
                            class="form-select col border rounded-start"
                            required
                        >
                            <option value="No">Sin planchado</option>
                            <option value="Suave">Planchado suave</option>
                            <option value="Normal">Planchado normal</option>
                            <option value="Fuerte">Planchado fuerte</option>
                        </select>
                    </div>

                    <div class="row-md-4 input-group mt-3">
                        <label
                            class="form-label col-3 d-flex m-0 align-items-center"
                        >
                            Tipo de Pago
                        </label>
                        <select
                            v-model="nuevaOrden.tipoPago"
                            class="form-select col-5 border rounded-start"
                            required
                        >
                            <option value="yape">Yape</option>
                            <option value="transferencia">
                                Transferencia Bancaria
                            </option>
                            <option value="tarjeta">
                                Tarjeta Débito/Crédito
                            </option>
                        </select>
                        <label
                            for="montoPago"
                            class="form-label col-1 d-flex m-0 align-items-center ps-2 border border-end-0"
                            disabled
                        >
                            S/.
                        </label>
                        <input
                            v-model.number="nuevaOrden.montoPago"
                            type="number"
                            id="montoPago"
                            class="form-control col-5 ps-0 border border-start-0"
                            @change="formattedPago"
                        />
                    </div>

                    <div class="row-md-4 input-group mt-3">
                        <label
                            class="form-label col d-flex m-0 align-items-center"
                        >
                            Código Ticket
                        </label>
                        <input
                            v-model="nuevaOrden.codigoTicket"
                            type="text"
                            class="form-control border rounded-start"
                            required
                            readonly
                        />
                    </div>

                    <div class="row-md-4 input-group mt-3">
                        <label
                            class="form-label col d-flex m-0 align-items-center"
                        >
                            Fecha de Ingreso
                        </label>
                        <input
                            id="inputDate"
                            v-model="nuevaOrden.fechaIngreso"
                            type="date"
                            class="form-control col rounded-start"
                            required
                            readonly
                        />
                    </div>
                </div>
            </div>

            <button
                type="submit"
                class="btn btn-primary mt-3"
                :disabled="!formularioValido"
            >
                Agregar Orden
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";

//Variables Informativas
const date = new Date();
const formattedDate = date.toISOString().split("T")[0];

/*VARIABLES REACTIVAS PERSONALIZADAS*/
const validoCodigoTicket = ref(true);

//Variables Reactivas
const codigoTicket = ref(1);
const ordenesArray = ref([]);
const nuevaOrden = ref({
    //Prendas
    numPrendas: 0,
    colorRopa: {
        ropaClara: 0,
        ropaIntenso: 0,
        ropaOscura: 0,
    },
    edredones: 0,
    sabanas: 0,

    //Características
    tipoLavado: "normal",
    planchado: "No",

    //Pago
    tipoPago: "yape",
    montoPago: 0,

    //Estado
    estadoOrden: "Pendiente",

    codigoTicket: String(codigoTicket.value).padStart(4, 0),
    fechaIngreso: formattedDate,
});

const toggleColor = ref(false);

//Funciones CRUD
const agregarOrden = () => {
    ordenesArray.value.push({ ...nuevaOrden.value });
    codigoTicket.value++;
    limpiarFormulario();

    guardarLocalStorage("codigoTicket", codigoTicket);
    guardarLocalStorage("ordenesArray", ordenesArray);
};

//Funciones Auxiliares
const formularioValido = computed(() => {
    if (ordenesArray.value.length > 0) {
        ordenesArray.value.forEach((orden) => {
            if (orden.codigoTicket == nuevaOrden.value.codigoTicket) {
                validoCodigoTicket.value = false;
            } else {
                validoCodigoTicket.value = true;
            }
        });
    } else {
        validoCodigoTicket.value = true;
    }
    return (
        (nuevaOrden.value.numPrendas > 0 ||
            nuevaOrden.value.edredones > 0 ||
            nuevaOrden.value.sabanas > 0) &&
        nuevaOrden.value.montoPago > 0 &&
        validoCodigoTicket
    );
});

const limpiarFormulario = () => {
    nuevaOrden.value = {
        //Prendas
        numPrendas: 0,
        colorRopa: {
            ropaClara: 0,
            ropaIntenso: 0,
            ropaOscura: 0,
        },
        edredones: 0,
        sabanas: 0,

        //Características
        tipoLavado: "normal",
        planchado: "No",

        //Pago
        tipoPago: "yape",
        montoPago: 0,

        //Estado
        estadoOrden: "pendiente",

        codigoTicket: String(codigoTicket.value).padStart(4, 0),
        fechaIngreso: formattedDate,
    };
};

const numPrendas = computed(() => {
    nuevaOrden.value.numPrendas =
        nuevaOrden.value.colorRopa.ropaClara +
        nuevaOrden.value.colorRopa.ropaIntenso +
        nuevaOrden.value.colorRopa.ropaOscura;
});

watch(numPrendas, (nuevoValor) => {
    nuevaOrden.value.numPrendas = nuevoValor;
});

const formattedPago = () => {
    nuevaOrden.value.montoPago = Number.parseFloat(
        nuevaOrden.value.montoPago
    ).toFixed(2);
};

watch(
    () => nuevaOrden.value.montoPago,
    (nuevoValor) => {
        if (nuevoValor < 0) {
            nuevaOrden.value.montoPago = 0;
        }
    }
);
// FUNCIONES DOM
const toggleColors = () => {
    if (toggleColor.value) {
        toggleColor.value = false;
    } else {
        toggleColor.value = true;
    }
};

//LOCAL STORAGE
/*GUARDAR*/

const guardarLocalStorage = (name, item) => {
    localStorage.setItem(name, JSON.stringify(item.value));
};

/* RECUPERAR */
const cargarItemLocalStorage = (name, item) => {
    const datos = localStorage.getItem(name);
    if (datos !== undefined && datos !== null) {
        item.value = JSON.parse(datos);
    }
};

onMounted(() => {
    cargarItemLocalStorage("ordenesArray", ordenesArray);
    cargarItemLocalStorage("codigoTicket", codigoTicket);
    limpiarFormulario();
});
</script>

<style scoped>
.container {
    max-width: 900px;
}
</style>
