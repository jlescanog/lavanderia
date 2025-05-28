<template>
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h3 class="mb-4">Datos del Cliente</h3>

            <div class="mb-3">
                <label for="clienteCorreo" class="form-label"
                    >Buscar Cliente por Correo</label
                >
                <input
                    type="text"
                    class="form-control"
                    id="clienteCorreo"
                    v-model="busquedaCorreo"
                    @input="filtrarClientes"
                    placeholder="Ingrese correo del cliente"
                    list="clientesList"
                />
                <datalist id="clientesList">
                    <option
                        v-for="cliente in clientesFiltrados"
                        :key="cliente.idCliente"
                        :value="cliente.correoElectronico"
                    >
                        {{ cliente.nombre }}
                    </option>
                </datalist>

                <div v-if="clienteSeleccionado">
                    <p class="mt-2">
                        Cliente seleccionado:
                        <strong>{{ clienteSeleccionado.nombre }}</strong>
                    </p>
                </div>

                <div class="form-check mt-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="clienteAnonimo"
                        v-model="usarClientePorDefecto"
                        @change="asignarClientePorDefecto"
                    />
                    <label class="form-check-label" for="clienteAnonimo">
                        Registrar orden sin cliente (cliente por defecto)
                    </label>
                </div>
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
                        <div v-if="prenda.cantidad">
                            {{ prenda.tipo }} - {{ prenda.color }} X
                            {{ prenda.cantidad }} unidad(es)
                        </div>
                        <div v-else-if="prenda.peso">
                            {{ prenda.tipo }} - {{ prenda.color }} X
                            {{ prenda.peso }} Kilo(s)
                        </div>
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
import { ref } from "vue";

const carrito = ref([]);
import { serviciosDB } from "../dataJs";

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

            busquedaCorreo: "",
            clientes: [],
            clientesFiltrados: [],
            clienteSeleccionado: null,
            usarClientePorDefecto: false,
        };
    },
    mounted() {
        this.obtenerClientes();
    },
    methods: {
        async obtenerClientes() {
            try {
                const response = await fetch("/api/clientes", {
                    method: "GET",
                    headers: {
                        Accept: "application/json",
                    },
                });
                const data = await response.json();
                this.clientes = data;
                this.clientesFiltrados = data;
            } catch (error) {
                console.error("Error al cargar clientes", error);
            }
        },
        filtrarClientes() {
            const texto = this.busquedaCorreo.toLowerCase();
            this.clientesFiltrados = this.clientes.filter((cliente) =>
                cliente.correoElectronico.toLowerCase().includes(texto)
            );

            const match = this.clientes.find(
                (cliente) => cliente.correoElectronico.toLowerCase() === texto
            );
            if (match) {
                this.clienteSeleccionado = match;
                this.usarClientePorDefecto = false;
            }
        },
        asignarClientePorDefecto() {
            if (this.usarClientePorDefecto) {
                this.clienteSeleccionado = {
                    idCliente: 0,
                    nombre: "Cliente Genérico",
                    correoElectronico: "generico@tienda.com",
                };
            } else {
                this.clienteSeleccionado = null;
            }
        },
        confirmarOrden() {
            if (
                !this.tipoPago ||
                (!this.clienteSeleccionado && !this.usarClientePorDefecto)
            ) {
                alert(
                    "Por favor complete los datos del cliente y el tipo de pago."
                );
                return;
            }

            const cliente_id = this.clienteSeleccionado?.idCliente ?? 0;

            carrito.value = this.prendas;

            const detalleOrden = carrito.value.map((item) => {
                const precioLavado = serviciosDB.find(
                    (s) => s.id === item.idLavado
                ).precio;
                const precioPlanchado = serviciosDB.find(
                    (s) => s.id === item.idPlanchado
                ).precio;
                const precioUnitario = precioLavado + precioPlanchado;

                const subtotal =
                    precioUnitario *
                    (item.cantidad > 0 ? item.cantidad : item.peso);

                return {
                    prenda_id: item.idPrenda,
                    servicio_lavado_id: item.idLavado,
                    servicio_planchado_id: item.idPlanchado,
                    cantidad: item.cantidad,
                    peso: item.peso,
                    precio_unitario: precioUnitario,
                    subtotal: subtotal,
                };
            });

            const totalOrden = detalleOrden.reduce(
                (acum, item) => acum + item.subtotal,
                0
            );

            const jsonOrden = {
                orden: {
                    cliente_id: cliente_id,
                    tipo_documento_id: "1",
                    total: totalOrden,
                    detalle_orden: detalleOrden,
                    pago: {
                        metodo_pago: this.tipoPago,
                        monto_pagado: totalOrden,
                        estado: "pendiente",
                        num_documento: "12345678",
                    },
                },
            };

            console.log(JSON.stringify(jsonOrden, null, 2));

            fetch("/api/ordenes", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content"),
                },
                credentials: "include",
                body: JSON.stringify(jsonOrden),
            })
                .then(async (response) => {
                    // Primero verificamos si la respuesta es exitosa (código 2xx)
                    if (!response.ok) {
                        // Si no es exitosa, leemos el texto y lo convertimos a JSON
                        const errorText = await response.text();
                        console.log('Texto de error completo:', errorText);
                        
                        try {
                            const errorJson = JSON.parse(errorText);
                            console.log('JSON de error:', errorJson);
                            
                            // Si es un error de validación (422), mostrar detalles
                            if (response.status === 422 && errorJson.errors) {
                                let errorMessages = [];
                                
                                // Recorrer todos los errores de validación
                                for (const field in errorJson.errors) {
                                    errorMessages.push(`${field}: ${errorJson.errors[field].join(', ')}`);
                                }
                                
                                throw new Error('Errores de validación:\n' + errorMessages.join('\n'));
                            } else {
                                throw new Error(errorJson.error || errorJson.message || 'Error al procesar la orden');
                            }
                        } catch (e) {
                            if (e.message.includes('Errores de validación')) {
                                throw e; // Rethrow el error de validación formateado
                            }
                            console.error('Error al parsear respuesta:', e);
                            throw new Error('Error al procesar la orden: ' + response.status);
                        }
                    }
                    
                    // Si llegamos aquí, la respuesta es exitosa
                    const responseData = await response.json();
                    console.log("Orden creada exitosamente:", responseData);
                    
                    // Mostrar mensaje de éxito
                    alert("¡Orden registrada correctamente!");
                    
                    // Redireccionar
                    window.location.href = "/ordenes/crear";
                })
                .catch((error) => {
                    console.error("Error al registrar la orden:", error.message);
                    alert("Error al registrar la orden: " + error.message);
                });
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
