<template>
    <div
        class="container pt-5 d-flex justify-content-center h-100 align-items-center"
    >
        <form @submit.prevent="register" class="w-100" style="max-width: 500px">
            <!-- DNI + botón -->
            <div class="form-outline mb-4 d-flex">
                <div class="flex-grow-1 me-2">
                    <label class="form-label" for="registerDNI">DNI</label>
                    <input
                        type="text"
                        id="registerDNI"
                        class="form-control"
                        v-model="dni"
                        placeholder="Número de DNI"
                    />
                </div>
                <div class="align-self-end mb-1">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        @click="buscarPorDNI"
                    >
                        Buscar
                    </button>
                </div>
            </div>

            <!-- Nombres -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerFirstName"
                    >Nombres</label
                >
                <input
                    type="text"
                    id="registerFirstName"
                    class="form-control"
                    v-model="firstName"
                    placeholder="Tus nombres"
                />
            </div>

            <!-- Apellidos -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerLastName"
                    >Apellidos</label
                >
                <input
                    type="text"
                    id="registerLastName"
                    class="form-control"
                    v-model="lastName"
                    placeholder="Tus apellidos"
                />
            </div>

            <!-- Email -->
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

            <!-- Password -->
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

            <!-- Confirm Password -->
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

            <!-- Teléfono -->
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

            <!-- Dirección -->
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

const dni = ref("");
const firstName = ref("");
const lastName = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const phone = ref("");
const address = ref("");

// TOKEN de autenticación de tu API RENIEC
const API_TOKEN = "apis-token-14561.IYteIbJWL9xZJRzglrhctzQNWLGXWIbt"; // <-- remplaza con tu token real

const register = async () => {
    try {
        await axios.post("/register", {
            dni: dni.value,
            nombres: firstName.value,
            apellidos: lastName.value,
            correoElectronico: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
            telefono: phone.value,
            direccion: address.value,
        });

        window.location.href = "/cliente/ordenes";
    } catch (error) {
        console.error(error);
        alert(
            "Error al registrarse: " +
                (error.response?.data?.message || "Error desconocido")
        );
    }
};

const buscarPorDNI = async () => {
    debugger;
    if (dni.value.length !== 8) {
        alert("El DNI debe tener 8 dígitos");
        return;
    }

    try {
        const response = await axios.get(
            `https://api.apis.net.pe/v2/reniec/dni?numero=${dni.value}`,
            {
                headers: {
                    Authorization: `Bearer ${API_TOKEN}`,
                    Accept: "application/json",
                },
            }
        );
        const data = response.data;

        firstName.value = data.nombres;
        lastName.value = `${data.apellidoPaterno} ${data.apellidoMaterno}`;
    } catch (error) {
        console.error("Error al buscar DNI:", error);
        alert("No se pudo encontrar información con ese DNI.");
    }
};
</script>
