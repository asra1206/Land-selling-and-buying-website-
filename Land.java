// File: src/main/java/com/landbuy/model/Land.java
package com.landbuy.model;

import javax.persistence.*;
import java.math.BigDecimal;
import java.time.LocalDateTime;

@Entity
@Table(name = "lands")
public class Land {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(name = "seller_id", nullable = false)
    private Long sellerId;

    @Column(nullable = false, length = 150)
    private String title;

    @Column(nullable = false, length = 200)
    private String location;

    @Column(nullable = false, length = 100)
    private String district;

    @Enumerated(EnumType.STRING)
    @Column(name = "land_type", nullable = false)
    private LandType landType;

    @Column(name = "land_size", nullable = false, precision = 10, scale = 2)
    private BigDecimal landSize;

    @Column(nullable = false, precision = 15, scale = 2)
    private BigDecimal price;

    @Column(name = "road_access", length = 100)
    private String roadAccess;

    @Column(columnDefinition = "TEXT")
    private String description;

    @Enumerated(EnumType.STRING)
    private LandStatus status = LandStatus.Pending;

    @Column(name = "created_at")
    private LocalDateTime createdAt = LocalDateTime.now();

    public enum LandType { Residential, Commercial, Agricultural, Industrial }
    public enum LandStatus { Pending, Approved, Rejected, Sold }

    // Getters and Setters
    public Long getId() { return id; }
    public void setId(Long id) { this.id = id; }
    public Long getSellerId() { return sellerId; }
    public void setSellerId(Long sellerId) { this.sellerId = sellerId; }
    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }
    public String getLocation() { return location; }
    public void setLocation(String location) { this.location = location; }
    public String getDistrict() { return district; }
    public void setDistrict(String district) { this.district = district; }
    public LandType getLandType() { return landType; }
    public void setLandType(LandType landType) { this.landType = landType; }
    public BigDecimal getLandSize() { return landSize; }
    public void setLandSize(BigDecimal landSize) { this.landSize = landSize; }
    public BigDecimal getPrice() { return price; }
    public void setPrice(BigDecimal price) { this.price = price; }
    public String getRoadAccess() { return roadAccess; }
    public void setRoadAccess(String roadAccess) { this.roadAccess = roadAccess; }
    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }
    public LandStatus getStatus() { return status; }
    public void setStatus(LandStatus status) { this.status = status; }
    public LocalDateTime getCreatedAt() { return createdAt; }
    public void setCreatedAt(LocalDateTime createdAt) { this.createdAt = createdAt; }
}
