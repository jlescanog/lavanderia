<template>
    <div
        class="container pt-5 d-flex justify-content-center h-100 align-items-center"
    >
        <form @submit.prevent="register">
            <!-- Name input -->
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

            <!-- Email input -->
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

            <!-- Password input -->
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

            <!-- Confirm Password input -->
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

            <!-- Submit button -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success btn-block mb-4">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const router = useRouter();

const register = async () => {
    try {
        const response = await axios.post(
            "http://localhost:8000/api/register",
            {
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: password_confirmation.value,
            }
        );

        // Guardar token en localStorage
        localStorage.setItem("token", response.data.token);

        // Redireccionar al dashboard o página protegida
        router.push("/dashboard");
    } catch (error) {
        console.error(error);
        alert(
            "Error al registrarse: " +
                (error.response?.data?.message || "Error desconocido")
        );
    }
};
</script>
