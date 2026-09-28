// File: src/main/java/com/landbuy/model/User.java
package com.landbuy.model;

import javax.persistence.*;
import java.time.LocalDateTime;

@Entity
@Table(name = "users")
public class User {
    @Id @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    @Column(name="full_name", nullable=false, length=100) private String fullName;
    @Column(nullable=false, unique=true, length=100) private String email;
    @Column(length=20) private String phone;
    @Column(nullable=false, length=255) private String password;
    @Enumerated(EnumType.STRING) private Role role = Role.buyer;
    @Column(name="created_at") private LocalDateTime createdAt = LocalDateTime.now();
    public enum Role { buyer, seller, admin }
    public Long getId() { return id; }
    public void setId(Long id) { this.id = id; }
    public String getFullName() { return fullName; }
    public void setFullName(String fullName) { this.fullName = fullName; }
    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }
    public String getPhone() { return phone; }
    public void setPhone(String phone) { this.phone = phone; }
    public String getPassword() { return password; }
    public void setPassword(String password) { this.password = password; }
    public Role getRole() { return role; }
    public void setRole(Role role) { this.role = role; }
}

// ---- UserController.java ----
// File: src/main/java/com/landbuy/controller/UserController.java
/*
package com.landbuy.controller;

import com.landbuy.model.User;
import com.landbuy.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RestController
@RequestMapping("/api/users")
@CrossOrigin(origins = "*")
public class UserController {
    @Autowired private UserRepository userRepository;
    private BCryptPasswordEncoder encoder = new BCryptPasswordEncoder();

    @PostMapping("/register")
    public ResponseEntity<?> register(@RequestBody User user) {
        if (userRepository.findByEmail(user.getEmail()).isPresent())
            return ResponseEntity.badRequest().body("Email already in use.");
        user.setPassword(encoder.encode(user.getPassword()));
        return ResponseEntity.ok(userRepository.save(user));
    }

    @PostMapping("/login")
    public ResponseEntity<?> login(@RequestBody User loginRequest) {
        return userRepository.findByEmail(loginRequest.getEmail()).map(user -> {
            if (encoder.matches(loginRequest.getPassword(), user.getPassword()))
                return ResponseEntity.ok(user);
            return ResponseEntity.status(401).body((Object)"Invalid password.");
        }).orElse(ResponseEntity.status(404).body("Email not found."));
    }

    @GetMapping
    public List<User> getAllUsers() { return userRepository.findAll(); }

    @GetMapping("/{id}")
    public ResponseEntity<User> getUser(@PathVariable Long id) {
        return userRepository.findById(id).map(ResponseEntity::ok).orElse(ResponseEntity.notFound().build());
    }

    @PutMapping("/{id}")
    public ResponseEntity<User> updateUser(@PathVariable Long id, @RequestBody User updated) {
        return userRepository.findById(id).map(u -> {
            u.setFullName(updated.getFullName());
            u.setPhone(updated.getPhone());
            return ResponseEntity.ok(userRepository.save(u));
        }).orElse(ResponseEntity.notFound().build());
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteUser(@PathVariable Long id) {
        if (!userRepository.existsById(id)) return ResponseEntity.notFound().build();
        userRepository.deleteById(id);
        return ResponseEntity.noContent().build();
    }
}
*/
