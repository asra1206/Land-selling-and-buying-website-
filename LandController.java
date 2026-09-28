// File: src/main/java/com/landbuy/controller/LandController.java
package com.landbuy.controller;

import com.landbuy.model.Land;
import com.landbuy.repository.LandRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.*;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/lands")
@CrossOrigin(origins = "*")
public class LandController {

    @Autowired
    private LandRepository landRepository;

    /** GET /api/lands - list approved lands with optional filters */
    @GetMapping
    public Page<Land> getAllLands(
            @RequestParam(required = false) String district,
            @RequestParam(required = false) String landType,
            @RequestParam(defaultValue = "0") int page,
            @RequestParam(defaultValue = "8") int size) {
        Pageable pageable = PageRequest.of(page, size, Sort.by("createdAt").descending());
        if (district != null && landType != null)
            return landRepository.findByStatusAndDistrictAndLandType(Land.LandStatus.Approved, district, Land.LandType.valueOf(landType), pageable);
        if (district != null)
            return landRepository.findByStatusAndDistrict(Land.LandStatus.Approved, district, pageable);
        if (landType != null)
            return landRepository.findByStatusAndLandType(Land.LandStatus.Approved, Land.LandType.valueOf(landType), pageable);
        return landRepository.findByStatus(Land.LandStatus.Approved, pageable);
    }

    /** GET /api/lands/{id} - get single land */
    @GetMapping("/{id}")
    public ResponseEntity<Land> getLand(@PathVariable Long id) {
        Optional<Land> land = landRepository.findById(id);
        return land.map(ResponseEntity::ok).orElse(ResponseEntity.notFound().build());
    }

    /** POST /api/lands - create new land listing */
    @PostMapping
    public ResponseEntity<Land> createLand(@RequestBody Land land) {
        land.setStatus(Land.LandStatus.Pending);
        Land saved = landRepository.save(land);
        return ResponseEntity.ok(saved);
    }

    /** PUT /api/lands/{id} - update land */
    @PutMapping("/{id}")
    public ResponseEntity<Land> updateLand(@PathVariable Long id, @RequestBody Land updatedLand) {
        return landRepository.findById(id).map(land -> {
            land.setTitle(updatedLand.getTitle());
            land.setLocation(updatedLand.getLocation());
            land.setDistrict(updatedLand.getDistrict());
            land.setLandType(updatedLand.getLandType());
            land.setLandSize(updatedLand.getLandSize());
            land.setPrice(updatedLand.getPrice());
            land.setRoadAccess(updatedLand.getRoadAccess());
            land.setDescription(updatedLand.getDescription());
            return ResponseEntity.ok(landRepository.save(land));
        }).orElse(ResponseEntity.notFound().build());
    }

    /** PATCH /api/lands/{id}/approve */
    @PatchMapping("/{id}/approve")
    public ResponseEntity<Land> approveLand(@PathVariable Long id) {
        return landRepository.findById(id).map(land -> {
            land.setStatus(Land.LandStatus.Approved);
            return ResponseEntity.ok(landRepository.save(land));
        }).orElse(ResponseEntity.notFound().build());
    }

    /** PATCH /api/lands/{id}/reject */
    @PatchMapping("/{id}/reject")
    public ResponseEntity<Land> rejectLand(@PathVariable Long id) {
        return landRepository.findById(id).map(land -> {
            land.setStatus(Land.LandStatus.Rejected);
            return ResponseEntity.ok(landRepository.save(land));
        }).orElse(ResponseEntity.notFound().build());
    }

    /** DELETE /api/lands/{id} */
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteLand(@PathVariable Long id) {
        if (!landRepository.existsById(id)) return ResponseEntity.notFound().build();
        landRepository.deleteById(id);
        return ResponseEntity.noContent().build();
    }

    /** GET /api/lands/seller/{sellerId} */
    @GetMapping("/seller/{sellerId}")
    public List<Land> getLandsBySeller(@PathVariable Long sellerId) {
        return landRepository.findBySellerId(sellerId);
    }
}
