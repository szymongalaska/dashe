import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

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