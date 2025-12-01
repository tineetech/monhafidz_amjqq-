CREATE TABLE obat (
    id_obat INT(6) AUTO_INCREMENT PRIMARY KEY,
    kode_obat VARCHAR(10) UNIQUE NOT NULL,
    nama_obat VARCHAR(100) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    stok INT(10) NOT NULL
);



CREATE TABLE transaksi_obat (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_pasien INT NOT NULL, 
    id_obat INT NOT NULL,
    jumlah INT(10) NOT NULL,
    total_harga DECIMAL(10, 2) NOT NULL,
    tanggal_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,

    -- Definisi Foreign Keys
    FOREIGN KEY (id_pasien) REFERENCES pasien(id_pasien) ON DELETE RESTRICT,
    FOREIGN KEY (id_obat) REFERENCES obat(id_obat) ON DELETE RESTRICT
);