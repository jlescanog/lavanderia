<template>
    <div
        class="container pt-5 d-flex justify-content-center h-100 align-items-center"
    >
        <form @submit.prevent="register">
            <div class="form-outline mb-4">
                <label class="form-label" for="registerName">Nombre</label>
                <input
                    type="text"
                    id="registerName"
                    class="form-control"
                    v-model="name"
                    placeholder="Tu nombre completo"
                />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="registerEmail"
                    >Correo Electrónico</label
                >
                <input
                    type="email"
                    id="registerEmail"
                    class="form-control"
                    v-model="email"
                    placeholder="usuario@correo.com"
                />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="registerPassword"
                    >Contraseña</label
                >
                <input
                    type="password"
                    id="registerPassword"
                    class="form-control"
                    v-model="password"
                    placeholder="Crea una contraseña"
                />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="registerPasswordConfirm"
                    >Confirmar Contraseña</label
                >
                <input
                    type="password"
                    id="registerPasswordConfirm"
                    class="form-control"
                    v-model="password_confirmation"
                    placeholder="Repite la contraseña"
                />
            </div>

            <!-- Nuevo campo para teléfono -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerPhone">Teléfono</label>
                <input
                    type="text"
                    id="registerPhone"
                    class="form-control"
                    v-model="phone"
                    placeholder="Tu número de teléfono"
                />
            </div>

            <!-- Nuevo campo para dirección -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerAddress"
                    >Dirección</label
                >
                <textarea
                    id="registerAddress"
                    class="form-control"
                    v-model="address"
                    placeholder="Tu dirección completa"
                ></textarea>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-block mb-4">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const phone = ref(""); // Nuevo campo para el teléfono
const address = ref(""); // Nuevo campo para la dirección

const register = async () => {
    try {
        await axios.post("/register", {
            nombre: name.value,
            correoElectronico: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
            telefono: phone.value, // Se envía el teléfono
            direccion: address.value, // Se envía la dirección
        });

        // Al usar sesiones no necesitas guardar token
        window.location.href = "/home"; // o donde quieras redirigir después de registrarse
    } catch (error) {
        console.error(error);
        alert(
            "Error al registrarse: " +
                (error.response?.data?.message || "Error desconocido")
        );
    }
};
</script>
