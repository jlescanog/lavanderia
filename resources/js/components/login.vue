<template>
    <div
        class="container d-flex justify-content-center h-100 align-items-center"
    >
        <form @submit.prevent="login">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="emailInput"
                    >Correo Electrónico</label
                >
                <input
                    v-model="email"
                    type="email"
                    id="emailInput"
                    class="form-control"
                    placeholder="usuario@correo.com"
                />
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="passwordInput">Contraseña</label>
                <input
                    v-model="password"
                    type="password"
                    id="passwordInput"
                    class="form-control"
                    placeholder="Ingrese su contraseña"
                />
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4 text-center">
                <div
                    class="col d-flex justify-content-center align-items-center"
                >
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="checkboxLogin"
                            checked
                        />
                        <label class="form-check-label" for="checkboxLogin">
                            Recordarme
                        </label>
                    </div>
                </div>

                <div class="col">
                    <!-- Simple link -->
                    <a href="#!">¿Has olvidado la contraseña?</a>
                </div>
            </div>

            <!-- Submit button -->
            <div class="d-flex justify-content-center">
                <button
                    type="submit"
                    data-mdb-button-init
                    data-mdb-ripple-init
                    class="btn btn-primary btn-block mb-4"
                >
                    Iniciar Sesión
                </button>
            </div>

            <div class="text-center">
                <p>
                    ¿No tienes cuenta? Registrate <a href="/register">Aqui</a>
                </p>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const email = ref("");
const password = ref("");

axios.defaults.withCredentials = true;

const login = async () => {
    try {
        await axios.get("/sanctum/csrf-cookie");

        await axios.post("/login", {
            correoElectronico: email.value,
            password: password.value,
        });

        // Redireccionar al home o página protegida
        window.location.href = "/home";
    } catch (error) {
        console.error(error);
        alert(
            "Error al iniciar sesión: " +
                (error.response?.data?.message || "Error desconocido")
        );
    }
};
</script>
