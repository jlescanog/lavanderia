<template>
    <div class="container mt-4">
        <div v-if="!pasoConfirmacion">
            <div class="row">
                <div class="col-md-6">
                    <PrendaForm @prenda-agregada="agregarPrenda" />
                </div>
                <div class="col-md-6">
                    <ListaPrendas
                        :prendas="prendas"
                        @eliminar="eliminarPrenda"
                        @editar="editarPrenda"
                        @confirmar-prendas="pasarAConfirmacion"
                    />
                </div>
            </div>
        </div>

        <orden-resumen
            v-else
            :prendas="prendas"
            :precioTotalCalculado="calcularPrecioTotal()"
            @orden-confirmada="guardarOrden"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import PrendaForm from "../components/prendaForm.vue";
import ListaPrendas from "../components/listaPrendas.vue";
import OrdenResumen from "../components/ordenResumen.vue";

const prendas = ref([]);
const pasoConfirmacion = ref(false);

const agregarPrenda = (prenda) => {
    // Puedes añadir lógica de precio aquí si necesitas
    prenda.precio = calcularPrecioUnitario(prenda);
    prendas.value.push(prenda);
};

const editarPrenda = (index, prendaEditada) => {
    prendas.value[index] = prendaEditada;
};

const eliminarPrenda = (index) => {
    prendas.value.splice(index, 1);
};

const pasarAConfirmacion = () => {
    if (prendas.value.length === 0) {
        alert("Agrega al menos una prenda antes de continuar.");
        return;
    }
    pasoConfirmacion.value = true;
};

const calcularPrecioUnitario = (prenda) => {
    return prenda.cantidad * 5;
};

const calcularPrecioTotal = () => {
    return prendas.value.reduce((total, p) => total + p.precio, 0);
};

const guardarOrden = (orden) => {
    console.log("Orden lista para guardar:", orden);
    alert("¡Orden registrada con éxito!");
};
</script>
