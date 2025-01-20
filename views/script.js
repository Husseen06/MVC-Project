// script.js
document.addEventListener('DOMContentLoaded', function() {
    const kits = document.querySelectorAll('.kit');  // Selecteer alle kit afbeeldingen
    const tooltip = document.getElementById('tooltip');

    kits.forEach(function(kit) {
        kit.addEventListener('mouseenter', function(event) {
            const name = event.target.getAttribute('data-name');
            const img = event.target.getAttribute('data-img');
            
            // Toon de tooltip
            tooltip.innerHTML = `<strong>${name}</strong><br><img src="${img}" alt="${name}" style="width:100px;">`;
            tooltip.style.display = 'block';
            tooltip.style.left = `${event.pageX + 10}px`;
            tooltip.style.top = `${event.pageY + 10}px`;
        });

        kit.addEventListener('mouseleave', function() {
            tooltip.style.display = 'none';  // Verberg de tooltip wanneer de muis weggaat
        });
    });
});
