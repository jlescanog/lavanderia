<template>
    <div class="card shadow-sm">
        <div @click="mostrarDetalles = !mostrarDetalles" class="card-header">
            <h5 class="card-title">Orden # {{ orden.IdOrden }}</h5>
            <h6 class="card-subtitle mb-3 text-muted">
                {{ orden.cliente.nombre }}
            </h6>
        </div>
        <div class="card-body p-0">
            <div v-if="mostrarDetalles" class="p-2">
                <div
                    v-for="(detalle, index) in orden.detalles"
                    :key="index"
                    class="mb-2"
                >
                    <OrdenDetalle
                        :detalle="detalle"
                        :index="index"
                        :idOrden="orden.IdOrden"
                    />
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button
                        class="btn btn-danger btn-sm m-1"
                        @click="eliminarOrden"
                    >
                        Eliminar
                    </button>
                    <button
                        class="btn btn-primary btn-sm m-1"
                        @click="avanzarEstado"
                    >
                        {{ textoBotonEstado }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import OrdenDetalle from "./OrdenDetalle.vue";
import { ref, computed } from "vue";
import axios from "axios";

const props = defineProps({
    orden: Object,
});

const mostrarDetalles = ref(false);

// Función para eliminar la orden
async function eliminarOrden() {
    if (!confirm("¿Estás seguro de que deseas eliminar esta orden?")) return;

    try {
        await axios.delete(`/api/ordenes/${props.orden.IdOrden}`);
        emit("ordenEliminada"); // Avisar al padre que la orden fue eliminada.
    } catch (error) {
        console.error("Error al eliminar la orden:", error);
        alert("No se pudo eliminar la orden.");
    }
}

// Computa el texto del botón según el estado actual
const textoBotonEstado = computed(() => {
    switch (props.orden.Estado) {
        case "pendiente":
            return "Iniciar Lavado";
        case "en proceso lavado":
            return "Iniciar Planchado";
        case "en proceso planchado":
            return "Finalizar Orden";
        case "finalizado":
            return "Orden Finalizada";
        default:
            return "Avanzar Estado";
    }
});

// Función para avanzar al siguiente estado
async function avanzarEstado() {
    let nuevoEstado = props.orden.Estado;

    switch (props.orden.Estado) {
        case "pendiente":
            nuevoEstado = "en proceso lavado";
            break;
        case "en proceso lavado":
            nuevoEstado = "en proceso planchado";
            break;
        case "en proceso planchado":
            nuevoEstado = "finalizado";
            break;
        case "finalizado":
            alert("La orden ya está finalizada");
            return;
    }

    try {
        await axios.put(`/api/ordenes/${props.orden.IdOrden}/estado`, {
            estado: nuevoEstado,
        });
        alert(`Estado cambiado a: ${nuevoEstado}`);
        emit("estadoActualizado", props.orden.IdOrden, nuevoEstado);
    } catch (error) {
        console.error(error);
        alert("Error al actualizar el estado");
    }
}

const emit = defineEmits(["ordenEliminada", "estadoActualizado"]);
</script>
