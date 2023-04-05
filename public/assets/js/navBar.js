const btnAccueil = document.getElementById('btnAccueil');
const btnMenus = document.getElementById('btnMenus');
const btnCard = document.getElementById('btnCard');
const btnTable = document.getElementById('btnTable');
const btnMembers = document.getElementById('btnMembers');

btnAccueil.addEventListener('click', () => {
    removeActiveClass();
    btnAccueil.classList.add('active');
});

btnMenus.addEventListener('click', () => {
    removeActiveClass();
    btnMenus.classList.add('active');
});

btnCard.addEventListener('click', () => {
    removeActiveClass();
    btnCard.classList.add('active');
});

btnTable.addEventListener('click', () => {
    removeActiveClass();
    btnTable.classList.add('active');
});

btnMembers.addEventListener('click', () => {
    removeActiveClass();
    btnMembers.classList.add('active');
});

function removeActiveClass() {
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        link.classList.remove('active');
    });
}

// Récupére le lien actif à partir de la variable de stockage local
const activeLink = sessionStorage.getItem('activeLink');

// Si un lien actif a été enregistré, ajouter la classe "active" à cet élément
if (activeLink) {
    const link = document.querySelector(`.nav-link[href='${activeLink}']`);
    if (link) {
        link.classList.add('active');
    }
}

// Ajoute un événement de clic à chaque lien de la barre de navigation
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Ajoute la classe "active" au lien cliqué
        link.classList.add('active');

        // Enregistre le lien actif dans la variable de stockage local
        sessionStorage.setItem('activeLink', link.getAttribute('href'));

        // Supprime la classe "active" de tous les autres liens
        const otherLinks = document.querySelectorAll('.nav-link:not(:focus)');
        otherLinks.forEach(otherLink => {
            if (otherLink.classList.contains('active')) {
                otherLink.classList.remove('active');
            }
        });
    });
});

