// File: src/main/java/com/landbuy/repository/LandRepository.java
package com.landbuy.repository;

import com.landbuy.model.Land;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface LandRepository extends JpaRepository<Land, Long> {
    Page<Land> findByStatus(Land.LandStatus status, Pageable pageable);
    Page<Land> findByStatusAndDistrict(Land.LandStatus status, String district, Pageable pageable);
    Page<Land> findByStatusAndLandType(Land.LandStatus status, Land.LandType landType, Pageable pageable);
    Page<Land> findByStatusAndDistrictAndLandType(Land.LandStatus status, String district, Land.LandType landType, Pageable pageable);
    List<Land> findBySellerId(Long sellerId);
}
