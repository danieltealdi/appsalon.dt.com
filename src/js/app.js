let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
document.addEventListener('DOMContentLoaded', function () {

    iniciarApp();
});
function iniciarApp() {
    tabs();
    mostrarSeccion();
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();
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