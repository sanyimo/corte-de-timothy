// document.addEventListener('DOMContentLoaded', () => {
//     const userMenuItem = document.querySelector('.user-menu-item');
//     if (!userMenuItem) return;

//     userMenuItem.addEventListener('click', e => {
//         e.preventDefault();
//         // Toggle display submenu (para móviles)
//         const submenuItems = document.querySelectorAll('.sub-menu-item');
//         submenuItems.forEach(sub => {
//             if (sub.style.display === 'block') {
//                 sub.style.display = 'none';
//             } else {
//                 sub.style.display = 'block';
//             }
//         });
//     });

//     // Opcional: cerrar submenu al hacer clic fuera
//     document.addEventListener('click', e => {
//         if (!userMenuItem.contains(e.target)) {
//             document.querySelectorAll('.sub-menu-item').forEach(sub => {
//                 sub.style.display = 'none';
//             });
//         }
//     });
// });
  