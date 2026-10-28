SET NAMES utf8mb4;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  description TEXT,
  price DECIMAL(8,2),
  stock INT,
  category VARCHAR(40),
  icon VARCHAR(10)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100),
  password VARCHAR(100),
  role VARCHAR(20)
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  user_email VARCHAR(100),
  rating INT,
  comment TEXT
) DEFAULT CHARSET=utf8mb4;

INSERT INTO products (name, description, price, stock, category, icon) VALUES
('Clavier mécanique', 'Clavier compact rétroéclairé, switches silencieux, disposition AZERTY.', 59.90, 20, 'Périphériques', '⌨️'),
('Souris sans fil', 'Souris ergonomique, capteur 4000 DPI, autonomie 12 mois.', 25.00, 35, 'Périphériques', '🖱️'),
('Casque audio', 'Casque fermé avec réduction de bruit et micro intégré.', 79.50, 10, 'Audio', '🎧'),
('Webcam HD', 'Webcam 1080p avec autofocus et cache de confidentialité.', 45.00, 15, 'Vidéo', '📷'),
('Écran 27 pouces', 'Dalle IPS QHD 75 Hz, bords fins, pied réglable.', 219.00, 6, 'Écrans', '🖥️'),
('Hub USB-C', 'Hub 7 en 1 : HDMI, USB 3.0, lecteur SD, charge 100 W.', 34.90, 0, 'Accessoires', '🔌'),
('Clé USB 128 Go', 'Clé USB 3.2 en métal, jusqu''à 400 Mo/s en lecture.', 17.50, 50, 'Stockage', '💾'),
('Microphone USB', 'Micro à condensateur pour streaming et visioconférence.', 64.00, 8, 'Audio', '🎙️');

INSERT INTO users (email, password, role) VALUES
('admin@secureshop.local', 'admin123', 'admin'),
('client@secureshop.local', 'client123', 'client');

INSERT INTO reviews (product_id, user_email, rating, comment) VALUES
(1, 'client@secureshop.local', 5, 'Très agréable à utiliser, frappe silencieuse.'),
(3, 'client@secureshop.local', 4, 'Bon son, un peu serré après plusieurs heures.'),
(2, 'client@secureshop.local', 5, 'Précise et légère, je recommande.');
