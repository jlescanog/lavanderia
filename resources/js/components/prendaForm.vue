<template>
    <form @submit.prevent="enviarPrenda">
        <div class="mb-3">
            <label class="form-label">Tipo de Prenda</label>
            <select v-model="prenda.tipo" class="form-select" required>
                <option disabled value="">Selecciona...</option>
                <option>Ropa</option>
                <option>Edredón</option>
                <option>Sábana</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <select v-model="prenda.color" class="form-select" required>
                <option disabled value="">Selecciona...</option>
                <option value="Claros">Colores Claros</option>
                <option value="Intensos">Colores Intensos</option>
                <option value="Oscuros">Colores Oscuros</option>
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
            <select v-model="prenda.lavado" class="form-select" required>
                <option disabled value="">Selecciona...</option>
                <option>Lavado en seco</option>
                <option>Lavado normal</option>
                <option>Lavado delicado</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Planchado</label>
            <select v-model="prenda.planchado" class="form-select" required>
                <option disabled value="">Selecciona...</option>
                <option>Sin planchado</option>
                <option>Planchado suave</option>
                <option>Planchado normal</option>
                <option>Planchado fuerte</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Agregar Prenda
        </button>
    </form>
</template>

<script setup>
import { ref } from "vue";

import { prendasDB } from "../dataJs.js";
import { serviciosDB } from "../dataJs.js";

const radioControl = ref("cantidad");

function obtenerIdPrenda(tipo, color) {
    const resultado = prendasDB.find(
        (p) => p.tipo === tipo && p.color === color
    );
    return resultado ? resultado.id : null;
}

function obtenerIdServicio(nombre) {
    const resultado = serviciosDB.find((s) => s.nombre === nombre);
    return resultado ? resultado.id : null;
}

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
});

const emit = defineEmits(["prenda-agregada"]);

const enviarPrenda = () => {
    prenda.value.idPrenda = obtenerIdPrenda(
        prenda.value.tipo,
        prenda.value.color
    );
    prenda.value.idLavado = obtenerIdServicio(prenda.value.lavado);
    prenda.value.idPlanchado = obtenerIdServicio(prenda.value.planchado);

    emit("prenda-agregada", { ...prenda.value });
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
    };
};
</script>
