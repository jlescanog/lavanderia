<template>
    <nav
        class="navbar navbar-expand-lg bg-dark border-bottom border-body"
        data-bs-theme="dark"
    >
        <div class="container-fluid">
            <a class="navbar-brand" href="/home"
                ><img
                    src="/resources/images/logo.png"
                    class="img-fluid"
                    width="140"
                    alt="Logo Tacsay"
            /></a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a
                            href="/cliente/ordenes"
                            class="nav-link active text-decoration-none link-light"
                            aria-current="page"
                        >
                            Home</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="/register"
                            class="nav-link text-decoration-none link-light"
                        >
                            Register
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle text-decoration-none link-light"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-person-circle"></i> {{ userName }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- <li>
                                <a class="dropdown-item" href="#">Perfil</a>
                            </li>
                            <li><hr class="dropdown-divider" /></li> -->
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="#"
                                    @click.prevent="logout"
                                    >Cerrar sesión</a
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const userName = ref("Usuario");

onMounted(async () => {
    try {
        // Realiza la solicitud a la API para obtener el cliente autenticado
        let response = await axios.get("/api/user");
        userName.value = response.data.Nombre; // Asignamos el nombre del cliente
    } catch (error) {
        console.error("No se pudo cargar el cliente:", error);
    }
});

const logout = async () => {
    try {
        await axios.post("/cliente/logout");
        window.location.href = "/login";
    } catch (error) {
        console.error("Error cerrando sesión", error);
    }
};
</script>
