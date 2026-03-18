function afficherMenus(menus) {
    const container = document.getElementById('menu-container');
    container.innerHTML = "";

    if (menus.length === 0) {
        container.innerHTML = "<p>Aucun menu trouvé</p>";
        return;
    }

    menus.forEach(menu => {
        const div = document.createElement('div');

        div.innerHTML = `
            <h2>${menu.titre}</h2>
            <p>${menu.description}</p>
            <p>Prix : ${menu.prix} €</p>
            <p>Minimum : ${menu.nb_personne_min} personnes</p>
            <p>Stock disponible : ${menu.stock}</p>
        `;

        container.appendChild(div);
    });
}

document.addEventListener("DOMContentLoaded", () => {


    fetch('/viteGourmand/api/getMenus.php')
        .then(response => response.json())
        .then(menus => afficherMenus(menus))
        .catch(error => console.error('Erreur:', error));

    
    document.getElementById("prixMax").addEventListener("input", () => {
        const prixMax = document.getElementById("prixMax").value;

        fetch(`/viteGourmand/api/getMenus.php?prixMax=${prixMax}`)
            .then(response => response.json())
            .then(menus => afficherMenus(menus));
    });

});
    