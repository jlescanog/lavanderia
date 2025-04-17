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
                <option>Colores Claros</option>
                <option>Colores Intensos</option>
                <option>Colores Oscuros</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <input
                type="number"
                v-model="prenda.cantidad"
                class="form-control"
                required
                min="1"
            />
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

const prenda = ref({
    tipo: "",
    color: "",
    cantidad: 1,
    lavado: "",
    planchado: "",
});

const emit = defineEmits(["prenda-agregada"]);

const enviarPrenda = () => {
    emit("prenda-agregada", { ...prenda.value });
    prenda.value = {
        tipo: "",
        color: "",
        cantidad: 1,
        lavado: "",
        planchado: "",
    };
};
</script>
