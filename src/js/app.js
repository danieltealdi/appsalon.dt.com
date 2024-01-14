let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
const cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    servicios: [],
};

document.addEventListener('DOMContentLoaded', function () {

    iniciarApp();
});
function iniciarApp() {
    tabs();
    mostrarSeccion();
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();
    consultarApi();

}

function mostrarSeccion() {

    /*
    Esto es otra forma de evitar el error de querySelector null
    const secciones = document.querySelectorAll('.seccion');
    secciones.forEach(seccion => {
        seccion.classList.remove('mostrar');
    });
    */
    seleccionAnterior = document.querySelector('.mostrar');
    if (seleccionAnterior) {
        seleccionAnterior.classList.remove('mostrar');
    }
    const pasoSelector = `#paso-${paso}`;

    const seccion = document.querySelector(pasoSelector);

    if (seccion) {
        seccion.classList.add("mostrar");
        //console.log(paso);
    }

    tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }
    const selector = `[data-paso="${paso}"]`;
    const tab = document.querySelector(selector);
    tab.classList.add('actual');
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            botonesPaginador();
        })
    });

}
function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 2) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    }
    mostrarSeccion();
}
function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {
        if (paso >= pasoFinal) { return; }
        paso++;
        botonesPaginador();

    })

}
function paginaAnterior() {

    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {
        paso = parseInt(paso) - 1;
        botonesPaginador();
    });

}
/*
async function consultarApi(){

    try {
        const url='http://appsalon.dt.com/api/servicios';
        const resultado=await fetch(url);
        const servicios=await resultado.json();
        //console.log(servicios);
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
        
    }
}
*/
async function consultarApi() {
    try {
        const url = 'http://appsalon.dt.com/api/servicios';
        const resultado = await fetch(url);
        //console.log(resultado);

        const servicios = await resultado.json();
        mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach((servicio) => {
        const { id, nombre, precio } = servicio;
        const nombreServicio = document.createElement('p');
        nombreServicio.textContent = nombre;
        console.log(nombreServicio);
    })
}

function mostrarServicios(servicios) {
    servicios.forEach((servicio) => {
        const { id, nombre, precio } = servicio;

        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicio");
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicio");
        precioServicio.textContent = `${precio}$`;

        const servicioDiv = document.createElement("DIV");
        servicioDiv.classList.add("servicio");
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector("#servicios").appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;

    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    if (servicios.some((agregado) => agregado.id === id)) {
        cita.servicios = servicios.filter((servicio) => servicio.id !== id);
        divServicio.classList.remove("seleccionado");
    } else {
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add("seleccionado");
    }
}
