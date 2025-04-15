<template>
    <div class="container mt-3">
        <a
            class="btn w-100 p-0 mt-2 border-primary border-2"
            data-bs-toggle="collapse"
            href="#collapsePendientes"
            role="button"
            aria-expanded="false"
            >Pendientes</a
        >
        <div class="collapse border-0" id="collapsePendientes">
            <div
                class="card m-3 border-0"
                v-for="orden in arrayPendiente"
                :key="orden.codigoTicket"
                style="width: 15rem"
            >
                <a
                    class="btn w-100 p-0 m-0 collapsed border-0"
                    data-bs-toggle="collapse"
                    :href="'#collapse' + orden.codigoTicket"
                    role="button"
                    aria-expanded="false"
                    :id="'comprobeCollapsed' + orden.codigoTicket"
                    @click="actualizarCollapsedButtons"
                >
                    <button
                        type="button"
                        class="btn btn-primary w-100 p-0 border-0"
                    >
                        <div class="card-body w-100 p-0 pt-3 container">
                            <h5 class="card-title">
                                Orden Nro {{ orden.codigoTicket }}
                            </h5>
                            <div
                                v-if="isCollapsed(orden.codigoTicket)"
                                class="w-100 p-0 m-0"
                                role="button"
                            >
                                <div
                                    v-if="orden.numPrendas > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-3"
                                        role="button"
                                    >
                                        Total Prendas
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.numPrendas }}
                                    </label>
                                </div>
                                <div
                                    v-if="orden.edredones > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-4"
                                        role="button"
                                    >
                                        Edredones
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.edredones }}
                                    </label>
                                </div>
                                <div
                                    v-if="orden.sabanas > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-4"
                                        role="button"
                                    >
                                        Sabanas
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.sabanas }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </button>
                </a>

                <div
                    class="collapse border-0"
                    :id="'collapse' + orden.codigoTicket"
                >
                    <ul
                        v-if="orden.numPrendas > 0"
                        class="list-group list-group-flush"
                    >
                        <li class="list-group-item p-0 border-0">
                            <a
                                class="btn w-100 p-0"
                                data-bs-toggle="collapse"
                                :href="'#colorPrenda' + orden.codigoTicket"
                                aria-expanded="false"
                            >
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary w-100 active d-flex justify-content-around border-3 border-secondary"
                                    data-bs-toggle="button"
                                    aria-pressed="false"
                                >
                                    COLORES DE PRENDAS
                                    <i class="bi bi-caret-down-fill"></i>
                                </button>
                            </a>
                        </li>
                        <li
                            class="list-group-item p-0 border-secondary border-3 rounded show"
                            :id="'colorPrenda' + orden.codigoTicket"
                        >
                            <div
                                v-if="orden.colorRopa.ropaClara > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Claros
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaClara"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                            <div
                                v-if="orden.colorRopa.ropaIntenso > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Intensos
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaIntenso"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                            <div
                                v-if="orden.colorRopa.ropaOscura > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Oscuros
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaOscura"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                        </li>
                    </ul>
                    <div
                        v-if="orden.edredones > 0"
                        class="input-group border border-secondary border-3 rounded"
                    >
                        <label
                            type="text"
                            class="form-control border-0"
                            for="clarosInput"
                        >
                            Edredones
                        </label>
                        <input
                            v-model.number="orden.edredones"
                            type="number"
                            id="clarosInput"
                            class="text-center border-0 ps-2"
                            readonly
                            disabled
                            style="width: 4rem"
                        />
                    </div>
                    <div
                        v-if="orden.sabanas > 0"
                        class="input-group border border-3 border-secondary rounded"
                    >
                        <label
                            type="text"
                            class="form-control border-0"
                            for="clarosInput"
                        >
                            Sabanas
                        </label>
                        <input
                            v-model.number="orden.sabanas"
                            type="number"
                            id="clarosInput"
                            class="text-center border-0 ps-2"
                            readonly
                            disabled
                            style="width: 4rem"
                        />
                    </div>
                    <div
                        class="mt-3 p-0 border border-warning rounded border-3"
                    >
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Lavado Tipo
                            </label>
                            <input
                                v-model="orden.tipoLavado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Planchado
                            </label>
                            <input
                                v-model="orden.planchado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div>

                    <div
                        class="mt-3 p-0 border border-success rounded border-3"
                    >
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Lavado Tipo
                            </label>
                            <input
                                v-model="orden.tipoLavado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div>
                    <!-- <div class="mt-3 p-0 border border-dark rounded border-3">
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Estado orden
                            </label>
                            <input
                                v-model="orden.estadoOrden"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div> -->
                    <div class="d-flex mt-2 justify-content-around pb-2">
                        <button
                            class="d-flex btn btn-primary btn-sm col-4 align-items-center justify-content-center"
                            @click="editarOrden(index)"
                            tittle="Editar"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-pencil-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"
                                />
                            </svg>
                        </button>
                        <button
                            class="d-flex btn btn-danger btn-sm col-4 align-items-center justify-content-center"
                            @click="eliminarOrden(index)"
                            tittle="Eliminar"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-trash3-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <a
            class="btn w-100 p-0 mt-2 border-warning border-2"
            data-bs-toggle="collapse"
            href="#collapseProceso"
            role="button"
            aria-expanded="false"
            >En Curso</a
        >
        <div class="collapse border-0" id="collapseProceso">
            <div
                class="card m-3 border-0"
                v-for="orden in arrayProceso"
                :key="orden.codigoTicket"
                style="width: 15rem"
            >
                <a
                    class="btn w-100 p-0 m-0 collapsed border-0"
                    data-bs-toggle="collapse"
                    :href="'#collapse' + orden.codigoTicket"
                    role="button"
                    aria-expanded="false"
                    :id="'comprobeCollapsed' + orden.codigoTicket"
                    @click="actualizarCollapsedButtons"
                >
                    <button
                        type="button"
                        class="btn btn-primary w-100 p-0 border-0"
                    >
                        <div class="card-body w-100 p-0 pt-3 container">
                            <h5 class="card-title">
                                Orden Nro {{ orden.codigoTicket }}
                            </h5>
                            <div
                                v-if="isCollapsed(orden.codigoTicket)"
                                class="w-100 p-0 m-0"
                                role="button"
                            >
                                <div
                                    v-if="orden.numPrendas > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-3"
                                        role="button"
                                    >
                                        Total Prendas
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.numPrendas }}
                                    </label>
                                </div>
                                <div
                                    v-if="orden.edredones > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-4"
                                        role="button"
                                    >
                                        Edredones
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.edredones }}
                                    </label>
                                </div>
                                <div
                                    v-if="orden.sabanas > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-4"
                                        role="button"
                                    >
                                        Sabanas
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.sabanas }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </button>
                </a>

                <div
                    class="collapse border-0"
                    :id="'collapse' + orden.codigoTicket"
                >
                    <ul
                        v-if="orden.numPrendas > 0"
                        class="list-group list-group-flush"
                    >
                        <li class="list-group-item p-0 border-0">
                            <a
                                class="btn w-100 p-0"
                                data-bs-toggle="collapse"
                                :href="'#colorPrenda' + orden.codigoTicket"
                                aria-expanded="false"
                            >
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary w-100 active d-flex justify-content-around border-3 border-secondary"
                                    data-bs-toggle="button"
                                    aria-pressed="false"
                                >
                                    COLORES DE PRENDAS
                                    <i class="bi bi-caret-down-fill"></i>
                                </button>
                            </a>
                        </li>
                        <li
                            class="list-group-item p-0 border-secondary border-3 rounded show"
                            :id="'colorPrenda' + orden.codigoTicket"
                        >
                            <div
                                v-if="orden.colorRopa.ropaClara > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Claros
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaClara"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                            <div
                                v-if="orden.colorRopa.ropaIntenso > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Intensos
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaIntenso"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                            <div
                                v-if="orden.colorRopa.ropaOscura > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Oscuros
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaOscura"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                        </li>
                    </ul>
                    <div
                        v-if="orden.edredones > 0"
                        class="input-group border border-secondary border-3 rounded"
                    >
                        <label
                            type="text"
                            class="form-control border-0"
                            for="clarosInput"
                        >
                            Edredones
                        </label>
                        <input
                            v-model.number="orden.edredones"
                            type="number"
                            id="clarosInput"
                            class="text-center border-0 ps-2"
                            readonly
                            disabled
                            style="width: 4rem"
                        />
                    </div>
                    <div
                        v-if="orden.sabanas > 0"
                        class="input-group border border-3 border-secondary rounded"
                    >
                        <label
                            type="text"
                            class="form-control border-0"
                            for="clarosInput"
                        >
                            Sabanas
                        </label>
                        <input
                            v-model.number="orden.sabanas"
                            type="number"
                            id="clarosInput"
                            class="text-center border-0 ps-2"
                            readonly
                            disabled
                            style="width: 4rem"
                        />
                    </div>
                    <div
                        class="mt-3 p-0 border border-warning rounded border-3"
                    >
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Lavado Tipo
                            </label>
                            <input
                                v-model="orden.tipoLavado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Planchado
                            </label>
                            <input
                                v-model="orden.planchado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div>

                    <div
                        class="mt-3 p-0 border border-success rounded border-3"
                    >
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Lavado Tipo
                            </label>
                            <input
                                v-model="orden.tipoLavado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div>
                    <!-- <div class="mt-3 p-0 border border-dark rounded border-3">
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Estado orden
                            </label>
                            <input
                                v-model="orden.estadoOrden"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div> -->
                    <div class="d-flex mt-2 justify-content-around pb-2">
                        <button
                            class="d-flex btn btn-primary btn-sm col-4 align-items-center justify-content-center"
                            @click="editarOrden(index)"
                            tittle="Editar"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-pencil-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"
                                />
                            </svg>
                        </button>
                        <button
                            class="d-flex btn btn-danger btn-sm col-4 align-items-center justify-content-center"
                            @click="eliminarOrden(index)"
                            tittle="Eliminar"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-trash3-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <a
            class="btn w-100 p-0 mt-2 border-success border-2"
            data-bs-toggle="collapse"
            href="#collapseListo"
            role="button"
            aria-expanded="false"
            >Finalizados</a
        >
        <div class="collapse border-0" id="collapseListo">
            <div
                class="card m-3 border-0"
                v-for="orden in arrayListo"
                :key="orden.codigoTicket"
                style="width: 15rem"
            >
                <a
                    class="btn w-100 p-0 m-0 collapsed border-0"
                    data-bs-toggle="collapse"
                    :href="'#collapse' + orden.codigoTicket"
                    role="button"
                    aria-expanded="false"
                    :id="'comprobeCollapsed' + orden.codigoTicket"
                    @click="actualizarCollapsedButtons"
                >
                    <button
                        type="button"
                        class="btn btn-primary w-100 p-0 border-0"
                    >
                        <div class="card-body w-100 p-0 pt-3 container">
                            <h5 class="card-title">
                                Orden Nro {{ orden.codigoTicket }}
                            </h5>
                            <div
                                v-if="isCollapsed(orden.codigoTicket)"
                                class="w-100 p-0 m-0"
                                role="button"
                            >
                                <div
                                    v-if="orden.numPrendas > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-3"
                                        role="button"
                                    >
                                        Total Prendas
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.numPrendas }}
                                    </label>
                                </div>
                                <div
                                    v-if="orden.edredones > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-4"
                                        role="button"
                                    >
                                        Edredones
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.edredones }}
                                    </label>
                                </div>
                                <div
                                    v-if="orden.sabanas > 0"
                                    class="card-body input-group w-100 p-0 pb-1 d-flex justify-content-between"
                                    role="button"
                                >
                                    <label
                                        type="text"
                                        class="input-group-text border-0 bg-transparent fw-medium text-reset ps-4"
                                        role="button"
                                    >
                                        Sabanas
                                    </label>
                                    <label
                                        type="number"
                                        class="form-control border-0 bg-transparent fw-medium text-reset text-center"
                                        role="button"
                                        style="max-width: 40% !important"
                                    >
                                        {{ orden.sabanas }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </button>
                </a>

                <div
                    class="collapse border-0"
                    :id="'collapse' + orden.codigoTicket"
                >
                    <ul
                        v-if="orden.numPrendas > 0"
                        class="list-group list-group-flush"
                    >
                        <li class="list-group-item p-0 border-0">
                            <a
                                class="btn w-100 p-0"
                                data-bs-toggle="collapse"
                                :href="'#colorPrenda' + orden.codigoTicket"
                                aria-expanded="false"
                            >
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary w-100 active d-flex justify-content-around border-3 border-secondary"
                                    data-bs-toggle="button"
                                    aria-pressed="false"
                                >
                                    COLORES DE PRENDAS
                                    <i class="bi bi-caret-down-fill"></i>
                                </button>
                            </a>
                        </li>
                        <li
                            class="list-group-item p-0 border-secondary border-3 rounded show"
                            :id="'colorPrenda' + orden.codigoTicket"
                        >
                            <div
                                v-if="orden.colorRopa.ropaClara > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Claros
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaClara"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                            <div
                                v-if="orden.colorRopa.ropaIntenso > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Intensos
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaIntenso"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                            <div
                                v-if="orden.colorRopa.ropaOscura > 0"
                                class="input-group"
                            >
                                <label
                                    type="text"
                                    class="form-control border-0"
                                    for="clarosInput"
                                >
                                    Colores Oscuros
                                </label>
                                <input
                                    v-model.number="orden.colorRopa.ropaOscura"
                                    type="number"
                                    id="clarosInput"
                                    class="text-center border-0 ps-2"
                                    readonly
                                    disabled
                                    style="width: 4rem"
                                />
                            </div>
                        </li>
                    </ul>
                    <div
                        v-if="orden.edredones > 0"
                        class="input-group border border-secondary border-3 rounded"
                    >
                        <label
                            type="text"
                            class="form-control border-0"
                            for="clarosInput"
                        >
                            Edredones
                        </label>
                        <input
                            v-model.number="orden.edredones"
                            type="number"
                            id="clarosInput"
                            class="text-center border-0 ps-2"
                            readonly
                            disabled
                            style="width: 4rem"
                        />
                    </div>
                    <div
                        v-if="orden.sabanas > 0"
                        class="input-group border border-3 border-secondary rounded"
                    >
                        <label
                            type="text"
                            class="form-control border-0"
                            for="clarosInput"
                        >
                            Sabanas
                        </label>
                        <input
                            v-model.number="orden.sabanas"
                            type="number"
                            id="clarosInput"
                            class="text-center border-0 ps-2"
                            readonly
                            disabled
                            style="width: 4rem"
                        />
                    </div>
                    <div
                        class="mt-3 p-0 border border-warning rounded border-3"
                    >
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Lavado Tipo
                            </label>
                            <input
                                v-model="orden.tipoLavado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Planchado
                            </label>
                            <input
                                v-model="orden.planchado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div>

                    <div
                        class="mt-3 p-0 border border-success rounded border-3"
                    >
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Lavado Tipo
                            </label>
                            <input
                                v-model="orden.tipoLavado"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div>
                    <!-- <div class="mt-3 p-0 border border-dark rounded border-3">
                        <div class="input-group">
                            <label
                                type="text"
                                class="form-control border-0"
                                for="clarosInput"
                            >
                                Estado orden
                            </label>
                            <input
                                v-model="orden.estadoOrden"
                                id="clarosInput"
                                class="text-center border-0 ps-2"
                                readonly
                                disabled
                                style="width: 5rem"
                            />
                        </div>
                    </div> -->
                    <div class="d-flex mt-2 justify-content-around pb-2">
                        <button
                            class="d-flex btn btn-primary btn-sm col-4 align-items-center justify-content-center"
                            @click="editarOrden(index)"
                            tittle="Editar"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-pencil-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"
                                />
                            </svg>
                        </button>
                        <button
                            class="d-flex btn btn-danger btn-sm col-4 align-items-center justify-content-center"
                            @click="eliminarOrden(index)"
                            tittle="Eliminar"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-trash3-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4 pe-5">
        <button
            @click="reiniciarTickes"
            class="d-flex btn btn-primary btn-l justifify-content-center"
        >
            Reiniciar contador tickets
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted, computed, nextTick, watch } from "vue";

const ordenesArray = ref([]);
const codigoTicket = ref(1);

const arrayListo = ref([]);
const arrayPendiente = ref([]);
const arrayProceso = ref([]);

const collapsedButtons = ref([]);

const eliminarOrden = (index) => {
    ordenesArray.value.splice(index, 1);
    guardarLocalStorage("ordenesArray", ordenesArray);
};

const reiniciarTickes = () => {
    codigoTicket.value = 1;
    ordenesArray.value = [];
    separateOrders();

    guardarLocalStorage("ordenesArray", ordenesArray);
    guardarLocalStorage("codigoTicket", codigoTicket);
};

const isCollapsed = (codigoTicket) => {
    const button = collapsedButtons.value.find(
        (btn) => btn.id === `comprobeCollapsed${codigoTicket}`
    );
    if (collapsedButtons.value.length == 0) {
        return true;
    } else {
        return button?.classList.contains("collapsed");
    }
};

const actualizarCollapsedButtons = () => {
    nextTick(() => {
        collapsedButtons.value = [
            ...document.querySelectorAll("[id^=comprobeCollapsed]"),
        ];
    });
};

watch(ordenesArray, async () => {
    await nextTick(); // Espera a que Vue actualice el DOM
    collapsedButtons.value = [
        ...document.querySelectorAll("[id^=comprobeCollapsed]"),
    ];
});

const separateOrders = () => {
    debugger;
    ordenesArray.value.forEach((orden) => {
        switch (orden.estadoOrden) {
            case "pendiente":
                arrayPendiente.value.push({ ...orden });
                break;

            case "enProceso":
                arrayProceso.value.push({ ...orden });
                break;

            case "listo":
                arrayListo.value.push({ ...orden });
                break;

            default:
                console.log("error con: " + orden.estadoOrden);
                break;
        }
    });
};

//LOCAL STORAGE

/*GUARDAR*/
const guardarLocalStorage = (name, item) => {
    localStorage.setItem(name, JSON.stringify(item.value));
};

/* RECUPERAR */
const cargarItemLocalStorage = (name, item) => {
    const datos = localStorage.getItem(name);
    if (datos !== undefined && datos !== null) {
        item.value = JSON.parse(datos);
    }
};

onMounted(() => {
    cargarItemLocalStorage("ordenesArray", ordenesArray);
    cargarItemLocalStorage("codigoTicket", codigoTicket);
    separateOrders();
});
</script>

<style scoped>
.container {
    max-width: 900px;
}
</style>
