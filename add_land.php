<?php
require_once '../php/config.php';
if(!isLoggedIn()||!isSeller()) redirect('../login.php');
$page_title = 'Add Land';
$root = '../';
require_once '../php/lands.php';
include '../php/header.php';
$districts = ['Colombo','Kandy','Galle','Jaffna','Matara','Anuradhapura','Kurunegala','Ratnapura','Badulla','Trincomalee','Hambantota','Nuwara Eliya','Polonnaruwa','Puttalam','Monaragala','Kegalle'];
?>
<div class="dashboard-layout">
  <aside class="sidebar">
    <div class="sidebar-brand">Land<span>Buy</span></div>
    <ul class="sidebar-nav">
      <li><a href="dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
      <li><a href="my_lands.php"><span class="icon">🏞️</span> My Lands</a></li>
      <li><a href="add_land.php" class="active"><span class="icon">➕</span> Add Land</a></li>
      <li><a href="inquiries.php"><span class="icon">📩</span> Inquiries</a></li>
      <li><a href="profile.php"><span class="icon">👤</span> Profile</a></li>
      <li><a href="../php/auth.php?logout=1"><span class="icon">🚪</span> Logout</a></li>
    </ul>
</aside>

  <main class="dashboard-main">
    <h1>Add New Land</h1>
    <?php if(isset($add_success)): ?><div class="alert alert-success"><?= $add_success ?></div><?php endif; ?>
    <div style="background:var(--white);border-radius:var(--radius-lg);padding:2rem;box-shadow:var(--shadow);max-width:800px;">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" placeholder="e.g. Land in Colombo" required>
          </div>
          <div class="form-group">
            <label>District *</label>
            <select name="district" required>
              <option value="">Select District</option>
              <?php foreach($districts as $d): ?><option value="<?= $d ?>"><?= $d ?></option><?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Location / Area *</label>
          <input type="text" name="location" placeholder="e.g. Nugegoda, Colombo" required>
        </div>
        
  
        <div class="form-row">
          <div class="form-group">
            <label>Land Type *</label>
            <select name="land_type" required>
              <option value="">Select Type</option>
              <option value="Residential">Residential</option>
              <option value="Commercial">Commercial</option>
              <option value="Agricultural">Agricultural</option>
              <option value="Industrial">Industrial</option>
            </select>
          </div>
          <div class="form-group">
            <label>Land Size (Perches) *</label>
            <input type="number" name="land_size" placeholder="e.g. 20" min="1" step="0.01" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Price (Rs.) *</label>
            <input type="number" name="price" placeholder="e.g. 4500000" min="0" required>
          </div>
          <div class="form-group">
            <label>Road Access</label>
            <input type="text" name="road_access" placeholder="e.g. 20 Feet Road">
          </div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" rows="4" placeholder="Describe the land, surroundings, features..."></textarea>
        </div>
        <div class="form-group">
          <label>Images</label>
          <input type="file" name="images[]" multiple accept="image/*" onchange="previewImages(this)">
          <div id="image-preview" style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.5rem;"></div>
        </div>

        <h3>Select Land Location</h3>

        <div id="map" style="height:400px; width:100%; border:1px solid #ccc; border-radius:10px;"></div>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var map = L.map('map').setView([7.8731, 80.7718], 7);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
}).addTo(map);

var marker;

map.on('click', function(e) {

    if(marker){
        map.removeLayer(marker);
    }

    marker = L.marker(e.latlng).addTo(map);

    document.getElementsByName('latitude')[0].value = e.latlng.lat.toFixed(6);
    document.getElementsByName('longitude')[0].value = e.latlng.lng.toFixed(6);

});
</script>

<div class="form-group">
    <label>Latitude</label>
    <input type="text" name="latitude" placeholder="e.g. 6.9271">
  </div>

  <div class="form-group">
    <label>Longitude</label>
    <input type="text" name="longitude" placeholder="e.g. 79.8612">
  </div>
</div>

        <div style="display:flex;gap:1rem;">
    <button type="submit" name="add_land" class="btn btn-primary btn-lg">
        Submit Land
    </button>

    <button type="reset" class="btn btn-outline btn-lg">
        Clear
    </button>
</div>
      </form>
    </div>
  </main>
</div>

<?php include '../php/footer.php'; ?>


