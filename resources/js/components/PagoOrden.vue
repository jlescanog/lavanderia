<template>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="mb-0"><i class="bi bi-credit-card me-2"></i>Pago de Orden</h2>
                <p class="text-muted">Completa el pago de tu servicio de lavandería</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="/cliente/ordenes" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Volver a mis órdenes
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Detalles de la orden -->
            <div class="col-md-5 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Resumen de la Orden</h4>
                        
                        <div v-if="cargando" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                            <p class="mt-2">Cargando detalles de la orden...</p>
                        </div>
                        
                        <div v-else-if="error" class="alert alert-danger">
                            {{ error }}
                        </div>
                        
                        <div v-else>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Número de Orden:</span>
                                <span>#{{ orden.IdOrden }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Fecha:</span>
                                <span>{{ formatDate(orden.FechaOrden) }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Estado:</span>
                                <span class="badge" :class="estadoClass">{{ orden.Estado }}</span>
                            </div>
                            
                            <hr class="my-4">
                            
                            <h5 class="mb-3">Prendas</h5>
                            <ul class="list-group list-group-flush mb-4">
                                <li v-for="(detalle, index) in orden.detalles" :key="index" 
                                    class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-medium">{{ detalle.prenda?.nombre || 'Prenda' }}</span>
                                        <div class="text-muted small">
                                            <span v-if="detalle.Cantidad">Cantidad: {{ detalle.Cantidad }}</span>
                                            <span v-else-if="detalle.Peso">Peso: {{ detalle.Peso }} kg</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            
                            <hr class="my-4">
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>S/. {{ formatPrice(orden.PrecioTotal) }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-5 mt-3">
                                <span>Total:</span>
                                <span>S/. {{ formatPrice(orden.PrecioTotal) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de pago -->
            <div class="col-md-7">
                <culqi-payment-form 
                    v-if="orden" 
                    :orden-id="orden.IdOrden" 
                    :total="orden.PrecioTotal"
                    @cancel="volverAOrdenes"
                />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import CulqiPaymentForm from './CulqiPaymentForm.vue';

export default {
    name: 'PagoOrden',
    components: {
        CulqiPaymentForm
    },
    props: {
        orden_id: {
            type: [Number, String],
            required: true
        }
    },
    data() {
        return {
            orden: null,
            cargando: true,
            error: null
        };
    },
    computed: {
        estadoClass() {
            const estados = {
                'pendiente': 'bg-warning text-dark',
                'en proceso lavado': 'bg-info text-dark',
                'en proceso planchado': 'bg-primary',
                'finalizado': 'bg-success'
            };
            
            return estados[this.orden?.Estado] || 'bg-secondary';
        }
    },
    methods: {
        formatPrice(price) {
            return parseFloat(price).toFixed(2);
        },
        
        formatDate(dateString) {
            if (!dateString) return '';
            
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            
            return new Date(dateString).toLocaleDateString('es-ES', options);
        },
        
        async cargarOrden() {
            this.cargando = true;
            this.error = null;
            
            try {
                const response = await axios.get(`/api/cliente/orden/${this.orden_id}`);
                this.orden = response.data;
                
                // Verificar si la orden ya está pagada
                if (this.orden.pago && this.orden.pago.Estado === 'completado') {
                    this.error = 'Esta orden ya ha sido pagada.';
                }
                
            } catch (error) {
                console.error('Error al cargar la orden:', error);
                this.error = error.response?.data?.message || 
                             error.response?.data?.error || 
                             'No se pudo cargar la información de la orden.';
            } finally {
                this.cargando = false;
            }
        },
        
        volverAOrdenes() {
            window.location.href = '/cliente/ordenes';
        }
    },
    mounted() {
        this.cargarOrden();
    }
};
</script>

<style scoped>
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.badge {
    padding: 0.5em 0.75em;
}
</style>
