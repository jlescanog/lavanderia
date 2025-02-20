<template>
    <div class="container-fluid mt-5">
        <div class="row justify-content-around mt-5">
            <router-link
                to="/login"
                class="text-decoration-none card-link d-flex col-2 text-center align-items-center justify-content-space-around mt-3"
                style="width: 18rem"
            >
                <button type="button" class="btn btn-outline-primary w-100">
                    <div
                        class="d-flex w-100 columns card-body align-items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="100"
                            height="100"
                            fill="currentColor"
                            class="bi bi-door-open-fill"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"
                            />
                        </svg>
                        <p class="fs-4 fw-bold">Inicio de Sesión</p>
                    </div>
                </button>
            </router-link>
            <router-link
                to="/crudOrders"
                class="text-decoration-none card-link col-2 d-flex text-center align-items-center justify-content-space-around mt-3 border border-0"
                style="width: 18rem"
            >
                <button type="button" class="btn btn-outline-secondary w-100">
                    <div
                        class="d-flex w-100 columns card-body align-items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="100"
                            height="100"
                            fill="currentColor"
                            class="bi bi-gear-fill"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"
                            />
                        </svg>
                        <p class="fs-4 fw-bold">CRUD Ordenes</p>
                    </div>
                </button>
            </router-link>
            <router-link
                to="/login"
                class="text-decoration-none card-link d-flex col-2 text-center align-items-center justify-content-space-around mt-3"
                style="width: 18rem"
            >
                <button type="button" class="btn btn-outline-success">
                    <div
                        class="d-flex w-100 columns card-body align-items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="100"
                            height="100"
                            fill="currentColor"
                            class="bi bi-gear-fill"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"
                            />
                        </svg>
                        <p class="fs-4 fw-bold">Inicio de Sesión</p>
                    </div>
                </button>
            </router-link>
        </div>
    </div>
</template>

<script></script>

<style scoped>
/* Hace que el enlace herede el color del botón */
.card-link {
    color: inherit;
    text-decoration: none;
}
</style>
