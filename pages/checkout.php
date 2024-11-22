<?php
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}

// Get product details from URL parameters
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch product details
include 'db.php';
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    echo "<div class='alert alert-danger'>Product not found</div>";
    exit();
}
?>

<div class="container mt-5">
    <h2>Confirm Your Order</h2>
    
    <!-- Product Summary -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Product Details</h5>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid" alt="Product Image">
                </div>
                <div class="col-md-8">
                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                    <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                    <p>Category: <?php echo htmlspecialchars($product['category']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Delivery Address Form -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Delivery Address</h5>
            <form id="deliveryForm" method="post">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country" required>
                            <option value="">Select Country</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="state" class="form-label">State/Province</label>
                        <select class="form-select" id="state" name="state" required disabled>
                            <option value="">Select State</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city" name="city" required disabled>
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Street Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="I dont have API KEY, google cloud wont verify me" required>
                </div>
                <div id="map" style="height: 400px; width: 100%; margin-bottom: 20px;"></div>
                <button type="submit" class="btn btn-primary">Confirm Order</button>
            </form>
        </div>
    </div>
</div>

<script>
// Location data
const locations = {
    'Vietnam': {
        'Ho Chi Minh': ['District 1', 'District 2', 'District 3', 'Thu Duc'],
        'Ha Noi': ['Ba Dinh', 'Hoan Kiem', 'Hai Ba Trung'],
        'Da Nang': ['Hai Chau', 'Thanh Khe', 'Son Tra']
    },
    'USA': {
        'California': ['Los Angeles', 'San Francisco', 'San Diego'],
        'New York': ['New York City', 'Buffalo', 'Albany'],
        'Texas': ['Houston', 'Austin', 'Dallas']
    }
};

// Populate dropdowns
const countrySelect = document.getElementById('country');
const stateSelect = document.getElementById('state');
const citySelect = document.getElementById('city');

// Initialize Google Map
let map;
let marker;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 10.8231, lng: 106.6297 }, // Default to HCMUT
        zoom: 13
    });
}

// Populate country dropdown
for (let country in locations) {
    countrySelect.add(new Option(country, country));
}

// Country change handler
countrySelect.addEventListener('change', function() {
    stateSelect.disabled = false;
    stateSelect.length = 1;
    citySelect.disabled = true;
    citySelect.length = 1;
    
    if (this.value) {
        for (let state in locations[this.value]) {
            stateSelect.add(new Option(state, state));
        }
    }
});

// State change handler
stateSelect.addEventListener('change', function() {
    citySelect.disabled = false;
    citySelect.length = 1;
    
    if (this.value) {
        const cities = locations[countrySelect.value][this.value];
        cities.forEach(city => {
            citySelect.add(new Option(city, city));
        });
    }
});

// Update map when address is complete
document.getElementById('deliveryForm').addEventListener('change', function() {
    const country = countrySelect.value;
    const state = stateSelect.value;
    const city = citySelect.value;
    const street = document.getElementById('address').value;
    
    if (country && state && city && street) {
        const address = `${street}, ${city}, ${state}, ${country}`;
        const geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({ address: address }, function(results, status) {
            if (status === 'OK') {
                const location = results[0].geometry.location;
                map.setCenter(location);
                
                if (marker) {
                    marker.setMap(null);
                }
                
                marker = new google.maps.Marker({
                    map: map,
                    position: location
                });
            }
        });
    }
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>