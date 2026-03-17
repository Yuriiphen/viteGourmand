

document.addEventListener("DOMContentLoaded", () => {

    fetch('/viteGourmand/api/getMenus.php')
        .then(response => response.json())
        .then(menus => {
            const container = document.getElementById('menu-container');

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
        })
        .catch(error => console.error('Erreur:', error));

});