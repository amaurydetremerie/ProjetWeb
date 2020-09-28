INSERT INTO members
VALUES (0, 'Troll', 'Lala', 'jetetr0ll@gmail.com', '$2y$10$jA2IpUu3LstiipuNcZI94uSALs2xjxBiaXevbKvYDWivJozQixx1W', 0, 0),
(1, 'Noob', 'iste', 'xxnoobxx@gmail.com', '$2y$10$jA2IpUu3LstiipuNcZI94uSALs2xjxBiaXevbKvYDWivJozQixx1W', 1, 0),
(2, 'Use', 'eur', 'utilisateur@gmail.com', '$2y$10$jA2IpUu3LstiipuNcZI94uSALs2xjxBiaXevbKvYDWivJozQixx1W', 0, 1),
(3, 'White', 'Space', 'espace@gmail.com', '$2y$10$jA2IpUu3LstiipuNcZI94uSALs2xjxBiaXevbKvYDWivJozQixx1W', 1, 0),
(4, 'Jimmy', 'Fallon', 'jimmy.fallon@gmail.com', '$2y$10$jA2IpUu3LstiipuNcZI94uSALs2xjxBiaXevbKvYDWivJozQixx1W', 1, 1);

INSERT INTO categories
VALUES (1, 'General'), (2, 'Algorithms'), (3, 'AI'), (4, 'Big Data'), (5, '3D Graphics'), (6, 'Web');

INSERT INTO questions
VALUES (1, 2, 1, 'J\'arrive pas a lancer Chrome', 'Bonjour, j\'ai 13 ans et je n\'arrive pas à ouvrir Chrome sur mon ordinateur', '2018-07-31', 'S',null),
(2, 3, 3, 'Comment faire du machine learning', 'Bonjour, j\'aimerais apprendre le machine learning, avez-vous de bons liens ?', '2019-01-01', 'O',null),
(3, 0, 5, 'Comment faire du machine learning', 'Bonjour, j\'aimerais apprendre le machine learning, avez-vous de bons liens ?', '2019-01-02', 'D',null),
(4, 3, 6, 'Jenetrouvepasmatoucheespace', 'Aidez-mois\'ilvousplait', '2019-03-25', 'O',null),
(5, 4, 1, 'Comment réussir le projet ?', 'Bonjour Monsieur Khaddam, je vous serait très reconnaissant si je réussi le projet, merci beaucoup', '2019-03-25', 'O',null);

INSERT INTO answers
VALUES (11, 4, 1, 'Tu dois juste cliquer sur l\'icone de Google Chrome', '2018-08-01'),
(12, 1, 1, 'Merci beaucoup, ça fonctionne', '2018-08-01'),
(21, 0, 2, 'https://bit.ly/2k0QP1b', '2019-01-01'),
(22, 3, 2, 'https://bit.ly/2k0QP1b', '2019-01-14'),
(23, 2, 2, 'https://bit.ly/2k0QP1b', '2019-02-01'),
(31, 4, 3, 'Cette question a déjà été posée', '2019-01-02'),
(41, 2, 4, 'C\'est la grande touche sur le bas de ton clavier', '2019-03-28'),
(42, 0, 4, 'T\'es trop nul', '2019-03-28');

INSERT INTO votes
VALUES (4, 12, 'P'),
(0, 23, 'P'),
(3, 23, 'N'),
(4, 23, 'N');

UPDATE questions
SET right_answer = 11
WHERE id_question = 1;

UPDATE questions
SET right_answer = 23
WHERE id_question = 2;