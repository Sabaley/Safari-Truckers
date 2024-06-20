let map;
let markers = [];

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });

    fetchTrucks();
}

function fetchTrucks() {
    fetch('get_trucks.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(truck => {
                addTruckMarker(truck);
                updateTruckList(truck);
            });
        })
        .catch(error => console.error('Error fetching trucks:', error));
}

function addTruckMarker(truck) {
    const marker = new google.maps.Marker({
        position: { lat: truck.latitude, lng: truck.longitude },
        map: map,
        title: truck.truck_id,
    });
    markers.push(marker);
}

function updateTruckList(truck) {
    const truckList = document.getElementById("truck-list");
    const listItem = document.createElement("li");
    listItem.textContent = `Truck ID: ${truck.truck_id}, Last Update: ${truck.last_update}`;
    truckList.appendChild(listItem);
}
