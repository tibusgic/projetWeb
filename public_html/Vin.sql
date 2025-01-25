CREATE TABLE wines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domaine_name VARCHAR(255) NOT NULL, -- Nom du château/domaine
    appellation VARCHAR(255) NOT NULL, -- Appellation
    region VARCHAR(255) NOT NULL,      -- Région
    country_of_origin VARCHAR(255) NOT NULL, -- Pays d'origine
    grape_varieties VARCHAR(255),      -- Cépages
    wine_type VARCHAR(50),             -- Type de vin
    vintage YEAR,                      -- Millésime
    alcohol_content DECIMAL(4, 2),     -- Degré d'alcool (ex. : 12.5)
    classification VARCHAR(100),       -- Classification
    certifications VARCHAR(255),       -- Labels ou certifications
    bottle_size VARCHAR(50),           -- Taille/Volume (ex. : 75cl)
    cork_type VARCHAR(100),            -- Type de bouchon
    serving_temperature VARCHAR(50),   -- Température de service (ex. : 10-12°C)
    aging_potential VARCHAR(100)       -- Durée de garde (ex. : 5-10 ans)
    path_img VARCHAR(100)              -- Chemin pour l'image de la bouteille
    add_date DATETIME                  -- Date d'ajout dans la base
);


INSERT INTO wines (
    domaine_name, appellation, region, country_of_origin, grape_varieties, 
    wine_type, vintage, alcohol_content, classification, certifications, 
    bottle_size, cork_type, serving_temperature, aging_potential, path_img, add_date
) VALUES (
    'Château Margaux', 'Margaux', 'Bordeaux', 'France', 'Cabernet Sauvignon, Merlot',
    'Rouge', 2015, 13.5, 'Grand Cru Classé', 'Bio', 
    '75cl', 'Naturel', '16-18°C', '10-20 ans', 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP
);


INSERT INTO wines (domaine_name, appellation, region, country_of_origin, grape_varieties, wine_type, vintage, alcohol_content, classification, certifications, bottle_size, cork_type, serving_temperature, aging_potential, path_img, add_date) 
VALUES 
('AOC Champagne, Ayala Rosé', 'Champagne, Rosé', 'Champagne', 'France', NULL, 'Champagne, Rosé', 2006, 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('AOC Champagne, Krug Rosé', 'Champagne, Rosé', 'Champagne', 'France', NULL, 'Champagne, Rosé', 'N.M', 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('AOC Champagne, Louis Roederer, Cristal Rosé', 'Champagne, Rosé', 'Champagne', 'France', NULL, 'Champagne, Rosé', 0, 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('AOC Champagne, Veuve Clicquot La Grande Dame Rosé', 'Champagne, Blanc', 'Champagne', 'France', NULL, 'Champagne, Rosé', 0, 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('AOC Champagne, Laurent Perrier Rosé', 'Champagne, Rosé', 'Champagne', 'France', NULL, 'Champagne, Rosé', 0, 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('AOP Côtes de Provence, 1489 Roseblood d Estoublon', 'Méditerranée, rosé', 'Provence', 'France', NULL, 'Rose', 2023, 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('AOP Côteaux Varois en Provence, Roseblood d Estoublon', 'Méditerranée, rosé', 'Provence', 'France', NULL, 'Rose, Magnum', 2023, 0, NULL, NULL, '150cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('AOP Côteaux Varois en Provence, Roseblood d Estoublon', 'Méditerranée, rosé', 'Provence', 'France', NULL, 'Rose, jeroboam', 2023, 0, NULL, NULL, '300cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('Chablis AOP, Bienommée, Domaine Poitout', 'Bourgogne, Blanc', 'Bourgogne', 'France', NULL, 'Bourgogne, blanc', 2022, 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP),

('Chablis 1er Cru A.O.P "Vaillons" JP. Drain', 'Bourgogne, Blanc', 'Bourgogne', 'France', NULL, 'Bourgogne, blanc', 2018, 0, NULL, NULL, '75cl', NULL, NULL, 'red-wine-bottle-png.webp', CURRENT_TIMESTAMP)
;