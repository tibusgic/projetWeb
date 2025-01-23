INSERT INTO `person` (`nom`, `prenom`, `email`, `status`, `login`, `password`, `date_creation`, `telephone`) 
VALUES
('Dupont', 'Jean', 'jean.dupont@example.com', 'manager', 'jdupont', MD5('jdupont'), NOW(), '+33612345678'),
('Durand', 'Marie', 'marie.durand@example.com', 'waiter', 'mdurand', MD5('mdurand'), NOW(), '+33698765432'),
('Martin', 'Paul', 'paul.martin@example.com', 'waiter', 'pmartin', MD5('pmartin'), NOW(), '+33655555555'),
('Bernard', 'Lucie', 'lucie.bernard@example.com', 'employee', 'lbernard', MD5('lbernard'), NOW(), '+33633333333'),
('Morel', 'Sophie', 'sophie.morel@example.com', 'employee', 'smorel', MD5('smorel'), NOW(), NULL),
('Petit', 'Claire', 'claire.petit@example.com', 'waiter', 'cpetit', MD5('cpetit'), NOW(), '+33644444444'),
('Lemoine', 'Julien', 'julien.lemoine@example.com', 'manager', 'jlemoine', MD5('jlemoine'), NOW(), '+33622222222'),
('Rousseau', 'Camille', 'camille.rousseau@example.com', 'inactif', 'crousseau', MD5('crousseau'), NOW(), NULL),
('Blanc', 'Nicolas', 'nicolas.blanc@example.com', 'waiter', 'nblanc', MD5('nblanc'), NOW(), '+33666666666'),
('Garnier', 'Emma', 'emma.garnier@example.com', 'waiter', 'egarnier', MD5('egarnier'), NOW(), NULL);
