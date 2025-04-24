<template>
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Orden #{{ orden.id }}</h5>
            <p class="card-text">
                <strong>Total:</strong> S/ {{ orden.total }}<br />
                <strong>Estado:</strong> {{ orden.estado }}<br />
                <strong>Fecha:</strong> {{ orden.fecha }}
            </p>

            <div>
                <h6>Detalle:</h6>
                <ul>
                    <li
                        v-for="(detalle, index) in orden.detalle_orden"
                        :key="index"
                    >
                        {{ detalle.nombre_prenda }} -
                        {{ detalle.cantidad || detalle.peso }} unidad(es)
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrdenCard",
    props: {
        orden: {
            type: Object,
            required: true,
        },
    },
    mounted() {
        console.log(this.orden);
        console.log(this.ordenes);
    },
};
</script>

<style scoped>
.card {
    border-left: 5px solid #007bff;
}
</style>
