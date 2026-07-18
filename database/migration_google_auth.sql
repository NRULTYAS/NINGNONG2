-- Migration: Google OAuth & Password Reset
-- Menambahkan kolom untuk Google login di tabel tbl_user
-- Membuat tabel password_resets untuk fitur lupa password
-- Jalankan dengan: mysql -u root -p ningnong_kue_basah < database/migration_google_auth.sql

ALTER TABLE tbl_user
    ADD COLUMN google_id VARCHAR(255) DEFAULT NULL AFTER no_hp,
    ADD COLUMN avatar_url VARCHAR(500) DEFAULT NULL AFTER google_id,
    ADD INDEX idx_google_id (google_id);

-- Tabel untuk menyimpan token reset password
CREATE TABLE IF NOT EXISTS password_resets (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expired_at DATETIME NOT NULL,
    used TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_token (token),
    INDEX idx_expired (expired_at),
    FOREIGN KEY (email) REFERENCES tbl_user(email) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;