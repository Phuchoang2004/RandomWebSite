<?php
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '?page=login';</script>";
    exit();
}

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id === 0) {
    echo "<script>window.location.href = '?page=products';</script>";
    exit();
}

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO buy_history (user_id, product_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $stmt->close();
    echo "<div class='alert alert-success'>Purchase confirmed!</div>";
}
?>

<div class="container mt-5">
    <h2>Confirm Your Order</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Product Details</h5>
            <div class="row">
                <div class="col-md-4">
                    <?php
                    // Convert BLOB to base64 for display
                    $imageData = base64_encode($product['image']);
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                    ?>
                    <img src="<?php echo $imageSrc; ?>" class="img-fluid" alt="Product Image">
                </div>
                <div class="col-md-8">
                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                    <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                    <p>Category: <?php echo htmlspecialchars($product['category']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
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
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div id="map" style="height: 400px; width: 100%; margin-bottom: 20px;"></div>
                <h5 class="card-title">Billing Method</h5>
                <div class="mb-3">
                    <label for="billingMethod" class="form-label">Select Billing Method</label>
                    <select class="form-select" id="billingMethod" name="billingMethod" required>
                        <option value="">Select Billing Method</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <div id="creditCardForm" style="display: none;">
                    <h5 class="card-title">Credit Card Details</h5>
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="cardExpiry" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" required>
                    </div>
                    <div class="mb-3">
                        <label for="cardCVC" class="form-label">CVC</label>
                        <input type="text" class="form-control" id="cardCVC" name="cardCVC" required>
                    </div>
                </div>
                <div id="paypalBankInfo" style="display: none;">
                    <h5 class="card-title">Payment Information</h5>
                    <div class="text-center">
                        <img src="./My_Video_Page.png" alt="Payment Information" width="448" height="448">
                    </div>
                </div>
                <button type="submit" id="confirmButton" class="btn btn-primary">Confirm Order</button>
            </form>
        </div>
    </div>
</div>

<script>
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

const countrySelect = document.getElementById('country');
const stateSelect = document.getElementById('state');
const citySelect = document.getElementById('city');
const billingMethodSelect = document.getElementById('billingMethod');
const creditCardForm = document.getElementById('creditCardForm');
const paypalBankInfo = document.getElementById('paypalBankInfo');
const confirmButton = document.getElementById('confirmButton');

let map;
let marker;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 10.8231, lng: 106.6297 }, // Default to HCMUT
        zoom: 13
    });
}

for (let country in locations) {
    countrySelect.add(new Option(country, country));
}

countrySelect.addEventListener('change', function() {
    stateSelect.disabled = false;
    stateSelect.length = 1;
    
    if (this.value) {
        for (let state in locations[this.value]) {
            stateSelect.add(new Option(state, state));
        }
    }
});

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

billingMethodSelect.addEventListener('change', function() {
    const selectedMethod = this.value;
    if (selectedMethod === 'credit_card') {
        creditCardForm.style.display = 'block';
        paypalBankInfo.style.display = 'none';
        confirmButton.disabled = false;
    } else if (selectedMethod === 'paypal' || selectedMethod === 'bank_transfer') {
        creditCardForm.style.display = 'none';
        paypalBankInfo.style.display = 'block';
        confirmButton.disabled = true;
    } else {
        creditCardForm.style.display = 'none';
        paypalBankInfo.style.display = 'none';
        confirmButton.disabled = true;
    }
});

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>