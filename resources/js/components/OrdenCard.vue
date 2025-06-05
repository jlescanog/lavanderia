<template>
    <div class="card mb-3 shadow-sm border-0">
        <div class="card-header py-3" :class="headerClass">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i :class="estadoIcon" class="me-2"></i>
                    Orden #{{ orden.id }}
                </h5>
                <span class="badge" :class="estadoBadgeClass">{{ orden.estado }}</span>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Fecha:</strong> {{ formatDate(orden.fecha) }}</p>
                    <p class="mb-1"><strong>Método de pago:</strong> {{ orden.metodo_pago || 'No especificado' }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-1"><strong>Total:</strong> <span class="fs-5 text-primary">S/ {{ orden.total }}</span></p>
                    <p v-if="orden.estado_pago" class="mb-1">
                        <strong>Estado de pago:</strong> 
                        <span :class="estadoPagoClass">{{ orden.estado_pago }}</span>
                    </p>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="mb-3 border-bottom pb-2">Detalle de prendas:</h6>
                <ul class="list-group list-group-flush">
                    <li
                        v-for="(detalle, index) in orden.detalle_orden"
                        :key="index"
                        class="list-group-item px-0 d-flex justify-content-between align-items-center border-0 py-2"
                    >
                        <div>
                            <span class="fw-medium">{{ detalle.nombre_prenda }}</span>
                            <div class="text-muted small">
                                <span v-if="detalle.cantidad">Cantidad: {{ detalle.cantidad }}</span>
                                <span v-else-if="detalle.peso">Peso: {{ detalle.peso }} kg</span>
                            </div>
                        </div>
                        <span class="badge bg-light text-dark">S/ {{ detalle.subtotal || 'N/A' }}</span>
                    </li>
                </ul>
            </div>

            <!-- Botón de pago con MercadoPago si corresponde -->
            <div v-if="mostrarBotonPago" class="mt-3">
                <a :href="`/cliente/pago/${orden.id}`" class="btn btn-primary w-100">
                    <i class="bi bi-credit-card me-2"></i> Pagar ahora
                </a>
                <p class="text-center mt-3 mb-0 text-muted">
                    <small><i class="bi bi-shield-check me-1"></i> Pago seguro procesado por MercadoPago</small>
                </p>
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
    computed: {
        // Determinar si se debe mostrar el botón de pago
        mostrarBotonPago() {
            // Mostrar el botón si:
            // 1. El método de pago es Tarjeta o no está definido (pago pendiente)
            // 2. El estado de pago es pendiente o no está definido
            // 3. La orden no está en estado Pagada ni finalizada
            return (this.orden.metodo_pago === 'Tarjeta' || !this.orden.metodo_pago) && 
                   (this.orden.estado_pago === 'pendiente' || !this.orden.estado_pago) &&
                   this.orden.estado !== 'Pagada' &&
                   this.orden.estado !== 'finalizado';
        },
        
        // Clase para el encabezado de la tarjeta según el estado
        headerClass() {
            const estados = {
                'pendiente': 'bg-warning bg-opacity-10 border-warning',
                'en proceso lavado': 'bg-info bg-opacity-10 border-info',
                'en proceso planchado': 'bg-primary bg-opacity-10 border-primary',
                'finalizado': 'bg-success bg-opacity-10 border-success'
            };
            
            return estados[this.orden.estado] || 'bg-secondary bg-opacity-10 border-secondary';
        },
        
        // Icono según el estado de la orden
        estadoIcon() {
            const iconos = {
                'pendiente': 'bi bi-hourglass text-warning',
                'en proceso lavado': 'bi bi-droplet-half text-info',
                'en proceso planchado': 'bi bi-steam text-primary',
                'finalizado': 'bi bi-check2-circle text-success'
            };
            
            return iconos[this.orden.estado] || 'bi bi-question-circle text-secondary';
        },
        
        // Clase para la etiqueta de estado
        estadoBadgeClass() {
            const clases = {
                'pendiente': 'bg-warning text-dark',
                'en proceso lavado': 'bg-info text-dark',
                'en proceso planchado': 'bg-primary',
                'finalizado': 'bg-success'
            };
            
            return clases[this.orden.estado] || 'bg-secondary';
        },
        
        // Clase para el estado del pago
        estadoPagoClass() {
            const clases = {
                'pendiente': 'text-warning',
                'completado': 'text-success',
                'cancelado': 'text-danger'
            };
            
            return clases[this.orden.estado_pago] || 'text-muted';
        }
    },
    methods: {
        // Formatear fecha para mostrarla de forma más amigable
        formatDate(dateString) {
            if (!dateString) return 'Fecha no disponible';
            
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }
    },
    mounted() {
        console.log('Detalles de la orden:', this.orden);
    },
};
</script>

<style scoped>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    border-radius: 0.5rem;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.card-header {
    border-bottom: none;
    border-left: 5px solid;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.btn-primary {
    background-color: #635BFF;
    border-color: #635BFF;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #4b44e0;
    border-color: #4b44e0;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(99, 91, 255, 0.2);
}
</style>
