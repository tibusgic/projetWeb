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
    bottle_size, cork_type, serving_temperature, aging_potential, path_img
) VALUES (
    'Château Margaux', 'Margaux', 'Bordeaux', 'France', 'Cabernet Sauvignon, Merlot',
    'Rouge', 2015, 13.5, 'Grand Cru Classé', 'Bio', 
    '75cl', 'Naturel', '16-18°C', '10-20 ans', NULL
);