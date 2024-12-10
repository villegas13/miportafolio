// Agrega interactividad a la página, por ejemplo, efectos de hover o animaciones.
// Este ejemplo es básico y no incluye funcionalidades adicionales.

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('header nav a');

    navLinks.forEach(link => {
        link.addEventListener('mouseover', () => {
            link.style.color = '#ccc';
        });

        link.addEventListener('mouseout', () => {
            link.style.color = '#fff';
        });
    });
});