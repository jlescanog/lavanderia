<template>
    <AdminLayout>
        <div class="container mt-3">
            <h1 class="mb-4">Órdenes de Lavandería</h1>
            
            <!-- Componente de exportación -->
            <ExportarOrdenes />

            <OrdenesSection
                titulo="Órdenes Pendientes"
                :ordenes="ordenesPendientes"
                @refrescar="cargarOrdenes"
            />

            <OrdenesSection
                titulo="Órdenes en Proceso - Lavado"
                :ordenes="ordenesLavado"
                @refrescar="cargarOrdenes"
            />

            <OrdenesSection
                titulo="Órdenes en Proceso - Planchado"
                :ordenes="ordenesPlanchado"
                @refrescar="cargarOrdenes"
            />

            <OrdenesSection
                titulo="Órdenes Listas"
                :ordenes="ordenesListas"
                @refrescar="cargarOrdenes"
            />
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios";

import AdminLayout from "../components/AdminLayout.vue";
import OrdenesSection from "../components/OrdenesSection.vue";
import ExportarOrdenes from "../components/ExportarOrdenes.vue";

const todasOrdenes = ref([]);
const ordenesPendientes = computed(() =>
    todasOrdenes.value.filter((o) => o.Estado === "pendiente")
);
const ordenesLavado = computed(() =>
    todasOrdenes.value.filter((o) => o.Estado === "en proceso lavado")
);
const ordenesPlanchado = computed(() =>
    todasOrdenes.value.filter((o) => o.Estado === "en proceso planchado")
);
const ordenesListas = computed(() =>
    todasOrdenes.value.filter((o) => o.Estado === "finalizado")
);

const cargarOrdenes = async () => {
    try {
        const response = await axios.get("/api/ordenes");
        todasOrdenes.value = response.data;
    } catch (error) {
        console.error("Error al cargar las órdenes:", error);
    }
};

onMounted(() => {
    cargarOrdenes();
});
</script>
