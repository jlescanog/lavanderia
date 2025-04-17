<template>
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h3 class="mb-4">Datos del Cliente</h3>

            <div class="mb-3">
                <label for="clienteNombre" class="form-label"
                    >Nombre del Cliente</label
                >
                <input
                    type="text"
                    class="form-control"
                    id="clienteNombre"
                    v-model="clienteNombre"
                    placeholder="Ingrese el nombre del cliente"
                />
            </div>

            <div class="mb-4">
                <label for="tipoPago" class="form-label">Tipo de Pago</label>
                <select class="form-select" id="tipoPago" v-model="tipoPago">
                    <option disabled value="">
                        Seleccione un método de pago
                    </option>
                    <option value="Yape">Yape</option>
                    <option value="Transferencia bancaria">
                        Transferencia bancaria
                    </option>
                    <option value="Tarjeta">Tarjeta de débito o crédito</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Precio Total</label>
                <input
                    type="number"
                    class="form-control"
                    v-model="precioTotal"
                    readonly
                />
            </div>

            <!-- Resumen de prendas -->
            <div class="mb-4">
                <h5>Resumen de Prendas</h5>
                <ul class="list-group">
                    <li
                        v-for="(prenda, index) in prendas"
                        :key="index"
                        class="list-group-item d-flex justify-content-between align-items-center"
                    >
                        {{ prenda.tipo }} - {{ prenda.color }} x
                        {{ prenda.cantidad }}
                        <span class="badge bg-primary rounded-pill"
                            >{{ prenda.precio }} S/</span
                        >
                    </li>
                </ul>
            </div>

            <!-- Botón de confirmar -->
            <button class="btn btn-success w-100" @click="confirmarOrden">
                Confirmar Orden
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrdenResumen",
    props: {
        prendas: {
            type: Array,
            required: true,
        },
        precioTotalCalculado: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            clienteNombre: "",
            tipoPago: "",
            precioTotal: this.precioTotalCalculado,
        };
    },
    methods: {
        confirmarOrden() {
            if (!this.clienteNombre || !this.tipoPago) {
                alert(
                    "Por favor complete todos los campos antes de confirmar."
                );
                return;
            }

            const ordenFinal = {
                cliente: this.clienteNombre,
                pago: this.tipoPago,
                prendas: this.prendas,
                total: this.precioTotal,
            };

            console.log("Orden Confirmada:", ordenFinal);
            this.$emit("orden-confirmada", ordenFinal);
        },
    },
};
</script>

<style scoped>
.card {
    max-width: 600px;
    margin: auto;
}
</style>
