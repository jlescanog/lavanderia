<template>
    <div class="container mt-4">
        <h2 class="mb-4">Mis Órdenes</h2>

        <div v-if="ordenes.length > 0">
            <OrdenCard
                v-for="orden in ordenes"
                :key="orden.id"
                :orden="orden"
            />
        </div>
        <div v-else class="alert alert-info">
            No tienes órdenes registradas.
        </div>
    </div>
</template>

<script>
import OrdenCard from "./OrdenCard.vue";

export default {
    name: "ClienteOrdenes",
    components: { OrdenCard },
    data() {
        return {
            ordenes: [],
        };
    },
    mounted() {
        this.obtenerOrdenesCliente();
    },
    methods: {
        async obtenerOrdenesCliente() {
            try {
                const response = await fetch("/api/cliente/ordenes", {
                    method: "GET",
                    credentials: "include",
                    headers: {
                        Accept: "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                });

                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }

                const data = await response.json();
                console.log(data);
                this.ordenes = data;
            } catch (error) {
                console.error("Error al obtener las órdenes", error);
            }
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 800px;
    margin: auto;
}
</style>
