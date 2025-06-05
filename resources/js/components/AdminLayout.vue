<template>
    <div class="d-flex h-100">
        <nav
            class="bg-dark text-white p-3"
            style="min-width: 220px; height: 100vh"
        >
            <h4>Admin</h4>
            <ul class="nav flex-column mt-4">
                <li class="nav-item" v-for="item in menu" :key="item.name">
                    <a class="nav-link text-white" :href="item.link">{{
                        item.name
                    }}</a>
                </li>
            </ul>
        </nav>
        <main class="ps-4 pe-4 flex-grow-1">
            <slot />
        </main>
    </div>
</template>

<script setup>
const menu = [
    { name: "Inicio", link: "/admin/dashboard" },
    { name: "Órdenes", link: "/ordenes" },
    { name: "Crear Orden", link: "/ordenes/crear" },
    { name: "Clientes", link: "/admin/clientes" },
    { name: "Empleados", link: "/admin/empleados" },
    { name: "Registrar Empleado", link: "/empleado/register" },
];
</script>
