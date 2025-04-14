<template>
    <div
        class="container pt-5 d-flex justify-content-center h-100 align-items-center"
    >
        <form @submit.prevent="login">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form2Example1"
                    >Correo Electrónico</label
                >
                <input
                    type="email"
                    id="form2Example1"
                    class="form-control"
                    placeholder="usuario@correo.com"
                />
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Contraseña</label>
                <input
                    type="password"
                    id="form2Example2"
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
                            id="form2Example31"
                            checked
                        />
                        <label class="form-check-label" for="form2Example31">
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
                <p>¿No tienes cuenta? Registrate <a href="#!">Aqui</a></p>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const email = ref("");
const password = ref("");
const router = useRouter();

const login = async () => {
    try {
        const response = await axios.post("http://localhost:8000/api/login", {
            email: email.value,
            password: password.value,
        });

        // Guardar token en localStorage
        localStorage.setItem("token", response.data.token);

        // Redireccionar al dashboard o página protegida
        router.push("/dashboard");
    } catch (error) {
        console.error(error);
        alert(
            "Error al iniciar sesión: " +
                (error.response?.data?.message || "Error desconocido")
        );
    }
};
</script>
