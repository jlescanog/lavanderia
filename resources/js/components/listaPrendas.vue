<template>
    <div>
        <h5 class="mb-3">Lista de Prendas</h5>
        <div v-if="prendas.length">
            <ul class="list-group">
                <li
                    v-for="(item, index) in prendas"
                    :key="index"
                    class="list-group-item d-flex justify-content-between align-items-center"
                >
                    {{ item.tipo }} - {{ item.color }} -
                    {{ item.cantidad }} unidad(es)
                    <div>
                        <button
                            @click="$emit('editar', index, item)"
                            class="btn btn-sm btn-warning me-2"
                        >
                            Editar
                        </button>
                        <button
                            @click="$emit('eliminar', index)"
                            class="btn btn-sm btn-danger"
                        >
                            Eliminar
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <div v-else>
            <p>No hay prendas</p>
        </div>

        <div class="mt-3 text-end">
            <button
                class="btn btn-success"
                @click="$emit('confirmar-prendas')"
                :disabled="!prendas.length"
            >
                Confirmar Prendas
            </button>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    prendas: Array,
});
</script>
