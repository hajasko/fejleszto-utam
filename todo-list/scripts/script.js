let storageData = localStorage.getItem('feladatok');
let feladatok = storageData !== null ? JSON.parse(storageData) : [];

const render = () => {
    let html = '';

    feladatok.forEach(feladat => {
        html += `<li id="feladat-${feladatok.indexOf(feladat)+1}" class="feladat-doboz">
                    <span class="feladat-szoveg">${feladat}</span>
                    <button type="button" class="delete-btn">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </li>`
    }) 

    document.querySelector('.feladat-lista-js').innerHTML = html;

    const torlesGombok = document.querySelectorAll('.delete-btn');

    torlesGombok.forEach((gomb, index) => {
        gomb.addEventListener('click', () => {
            feladatok.splice(index,1);
            render();
        })
    })
    localStorage.setItem('feladatok',JSON.stringify(feladatok));
}

const ujFeladatHozzaad = () => {
        const ujFeladat = document.querySelector('.feladat-input-js').value;
        feladatHozzaad(ujFeladat);
        render();
}

function feladatHozzaad(elem) {
    if (elem.trim() === '') return;
    feladatok.push(elem);
    document.querySelector('.feladat-input-js').value = '';
}

window.onload = () => {
    
    render();

    document.querySelector('.feladat-hozzaad-gomb-js').addEventListener('click', ujFeladatHozzaad);

    document.querySelector('.feladat-input-js').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') ujFeladatHozzaad();
    })
};