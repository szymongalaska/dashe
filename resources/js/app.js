import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import Chart from 'chart.js/auto';

window.loadForecastChart = function (id, labels, data) {
    const canvas = document.getElementById(id);
    const ctx = canvas.getContext("2d");
    canvas.width = canvas.parentElement.parentElement.scrollWidth;
    canvas.height = canvas.parentElement.offsetHeight;

    new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Temperature",
                data: data,
                borderColor: "rgb(28, 197, 98)",
                borderWidth: 3,
                tension: 0.3,
                pointRadius: 0,
                pointHoverRadius: 0,
                fill: false
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false,
                    grid: { display: false },
                    ticks: {
                        autoSkip: false,
                    }
                },
                y: {
                    display: false,
                    beginAtZero: false,
                    suggestedMin: Math.min(...data) - 4,
                    suggestedMax: Math.max(...data) + 4
                }
            },
            layout: {
                padding: {
                    left: 40,
                    right: 40,
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
}

window.getLocation = function (callback) {
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const coords = position.coords.latitude + ', ' + position.coords.longitude;
            callback(coords);
        },
        (error) => {
            alert("Błąd: " + error.message);
        }
    );
}

document.addEventListener('livewire:init', () => {
    Livewire.on('locations-update', (event) => {
        window.chart.update();
    })
});