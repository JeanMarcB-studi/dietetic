INSERT INTO `regime` (`id`, `titre`, `detail`) VALUES
(1, 'Régime sans sel', NULL),
(2, 'Régime sans gluten', NULL);

INSERT INTO `allergene` (`id`, `nom`) VALUES
(1, 'noisettes'),
(2, 'noix de cajou'),
(3, 'fraises'),
(4, 'Pistaches'),
(5, 'Noix'),
(6, 'Crevettes');

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `prenom`, `nom`, `commentaire_user`, `commentaire_admin`, `telephone`, `est_client`) VALUES
(2, 'admin@test.com', '[\"ROLE_ADMIN\"]', '$2y$13$rGM/Akk6IG94O/mU3mzr0u6vaOd.r0thAFxbZEPmpd6rmyv0Zod3u', 'Sandrine', 'COUPART', NULL, NULL, '0000000000', 1),
(4, 'antoine@test.com', '[\"ROLE_USER\"]', '$2y$13$bV2tz3aXw1cWnmBK52xNMeN/4nR9WFjex8QdtE.EMQiynL/hjIdk6', 'antoine', 'alleme', NULL, NULL, '1111111111', 1),
(5, 'beatrice@test.com', '[\"ROLE_USER\"]', '$2y$13$5PBF1vFOXsqNj3kPm3K94OpQFAu2ZLSdX.ycOZ.y1QZ7SqF26L4ue', 'béatrice', 'becasse', NULL, NULL, '2222222222', 1),
(6, 'carole@test.com', '[\"ROLE_USER\"]', '$2y$13$E4U1LB5atxEURmvvxztgeuFDY8WfG2DvLibbepRNUjS1cAdTVIQYm', 'Carole', 'Cocoricio', 'coucou c\'est Carole', NULL, '3333333333', 1),
(7, 'donald@test.com', '[\"ROLE_USER\"]', '$2y$13$yfHnne1VYeCsBe.miIbq9ebyy8RyULX02dhchI.MkTTBsfVPY4Nq6', 'Donald', 'Duck', 'coin-coin', NULL, '4444444444', 1),
(8, 'zoro@test.com', '[\"ROLE_USER\"]', '$2y$13$jD3etEuapwkmmUhwSGdvfO.j..FM./MKODgqerpDnK4FMUX0hy/pi', 'Zoro', 'Ze Justicier', 'viva zapatta', NULL, '6666677777', 0) ;

INSERT INTO `recette` (`id`, `titre`, `description`, `temps_preparation`, `temps_repos`, `temps_cuisson`, `ingredients`, `preparation`, `visible_tous`) VALUES
(11, 'Délice de carottes au cumin', 'publique, pas spécial régime, pas d\'allergène', '00:10:00', '00:00:00', '01:10:00', 'carottes\r\ncumin\r\ncitron', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nQuam adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus urna. \r\nPretium nibh ipsum consequat nisl vel pretium lectus quam. \r\nMassa enim nec dui nunc mattis enim ut. Sit amet cursus sit amet dictum sit amet justo donec.', 1),
(12, 'Poulet aux petits pois', 'publique, pas spécial régime, pas d\'allergène', NULL, NULL, '01:30:00', 'Poulet\r\npetits pois\r\nsel\r\npoivre\r\nromarin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\nsed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nCursus turpis massa tincidunt dui ut. \r\nViverra tellus in hac habitasse platea dictumst vestibulum.', 1),
(13, 'Pain d\'épices au citron', 'Privée, pas spécial régime, pas d\'allergène', '01:00:00', '02:30:00', '00:45:00', 'farine\r\nmiel\r\ngingembre\r\ncannelle\r\nclous de girofle\r\ncitron confit', 'consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\nOdio eu feugiat pretium nibh ipsum. \r\nFacilisi morbi tempus iaculis urna id volutpat lacus laoreet non.\r\nEnim ut tellus elementum sagittis vitae et leo.', 0),
(14, 'Tarte aux fraises', 'Privée, pas spécial régime, allergène : Fraise', '01:00:00', NULL, '00:30:00', 'farine\r\noeufs\r\nsucre\r\nbeurre (beaucoup)\r\nfraises\r\nsucre vanillé\r\npincée de sel', 'Iaculis eu non diam phasellus vestibulum lorem. \r\nAt ultrices mi tempus imperdiet nulla malesuada pellentesque elit. \r\nEgestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate.\r\nFames ac turpis egestas sed tempus urna et pharetra pharetra.', 0),
(15, 'Lait fraise', 'Publique, pas spécial régime, allergène : Fraise', NULL, NULL, NULL, 'Lait\r\nFraises\r\nsucre vanillé', 'mixer, garder au frais', 1),
(16, 'Praliné noisettes', 'Privé, spécial régime sans sel et sans gluten, allergène : fruits à coque', NULL, NULL, NULL, 'chocolat 70%\r\nnoisettes\r\nnoix\r\npistaches, \r\nnoix de cajou', 'Morbi tristique senectus et netus et malesuada fames ac. Eget nullam non nisi est sit amet. \r\nSed augue lacus viverra vitae congue eu. Odio ut sem nulla pharetra diam sit amet. \r\nAmet luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor.', 0),
(17, 'croques aux amandes', 'Privé, régime sans sel, allergène : fruits à coques', '00:40:00', NULL, '00:55:00', 'noisettes,\r\nnoix, \r\npistaches, \r\nnoix de cajou\r\nmiel\r\nfarine', 'Sodales neque sodales ut etiam sit amet nisl purus. \r\nNisl vel pretium lectus quam id. Quis enim lobortis scelerisque fermentum dui faucibus. Vel risus commodo viverra maecenas. \r\nAdipiscing bibendum est ultricies integer quis auctor elit.', 0),
(18, 'pate de coings', 'Privé, régime sans sel et/ou sans gluten, pas d\'allergène', '01:30:00', NULL, '02:00:00', 'coings\r\nsucre\r\ncitron', 'Est placerat in egestas erat imperdiet sed euismod nisi porta. Sit amet facilisis magna etiam tempor. Lacus vel facilisis volutpat est velit. Suscipit tellus mauris a diam. At in tellus integer feugiat scelerisque varius. Bibendum ut tristique et egestas quis ipsum suspendisse ultrices gravida.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nec feugiat nisl pretium fusce id velit ut. \r\nAmet luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor. Arcu risus quis varius quam quisque id. Erat nam at lectus urna duis convallis convallis. Nunc sed velit dignissim sodales. Amet mauris commodo quis imperdiet massa tincidunt nunc. Pretium lectus quam id leo in vitae turpis.', 0),
(19, 'couscous royal', 'recette publique, aucun régime, aucune allergie', '02:00:00', '01:00:00', '03:00:00', 'Grains de couscous (moyen) 1 kg\r\nÉpaule d\'agneau désossée 1 kg\r\nPoulet 1\r\nMerguez 12\r\nPois chiches 2 tasse(s)\r\nCourgette(s) 4\r\nCarotte(s) 4\r\nNavet(s) 2\r\nAubergine(s) 2\r\n Tomate(s) mûre(s) 3\r\nOignon(s) 1\r\nRaisins secs 150 g\r\nSmen 3 c. à soupe\r\nConcentré de tomates 2 c. à soupe\r\nRas el-hanout 3 c. à café\r\nPaprika 1 c. à café\r\nPersil plat 5 brin(s)\r\nHarissa 1 pincée(s)\r\nHuile d\'olive 1 verre(s)\r\n    Sel 1 pincée(s)\r\n    Poivre 1 pincée(s)', 'Découpez les parties nobles du poulet (cuisse, blanc et ailes) en morceaux et l\'épaule d\'agneau en cubes assez gros. Dans le bas du couscoussier, faites-les revenir à feu vif pendant 5 à 10 min dans de l\'huile d’olive. Ajoutez le smen, les viandes, l\'oignon émincé dans une grande cocotte ou un plat à tajine. Ajoutez les épices à couscous, salez et poivrez.\r\nVersez le coulis de tomates et les tomates fraîches, mouillez d\'eau à hauteur, mélangez et laissez mijoter 15 min, à feu doux. Pelez les carottes et les navets. Coupez les aubergines et les carottes en bâtonnets, les navets en quartiers et les courgettes en tronçons. Faites gonfler les raisins secs dans un bol d’eau chaude.\r\nAjoutez les légumes, le persil et les épices (vous pouvez ajouter 1 branche de céleri, 1 bouquet de persil, et 1 bouquet garni) et complétez d\'eau à hauteur. Faites reprendre l\'ébullition, couvrez et prolongez la cuisson 45 min à 1 heure à petits bouillons. Ajoutez, 5 min avant la fin, les pois chiches et les raisins secs égouttés.\r\nPréparez la semoule selon l\'indication du paquet et incorporez du beurre en parcelles à l\'aide d\'une fourchette afin de bien séparer les grains. Faites griller les merguez à la poêle.\r\nLe couscous, les viandes, les légumes cuits et la sauce seront servis dans des plats séparés. Par exemple, présentez la semoule en dôme sur un grand plat et disposez dessus les merguez en étoile. Prélevez avec une écumoire, les légumes et les viandes, dressez-les dans deux plats creux séparés. Versez le bouillon dans une soupière. Prélevez-en une louche pour y diluer l\'harissa.', 1),
(20, 'caviar d\'aubergines', 'publique, pas spécial régime, pas d\'allergène', NULL, NULL, NULL, 'aubergines\r\nail\r\ntomates\r\nhuile d\'olives\r\npoivre\r\nsel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Morbi blandit cursus risus at. \r\nOrci eu lobortis elementum nibh tellus. Adipiscing tristique risus nec feugiat. Augue neque gravida in fermentum et sollicitudin ac. Nunc vel risus commodo viverra maecenas accumsan lacus vel. Mauris vitae ultricies leo integer malesuada. Gravida quis blandit turpis cursus in hac habitasse platea.', 1),
(21, 'gauffres', 'publique, spécial régime sans sel, pas d\'allergène', '00:15:00', '01:00:00', '00:05:00', 'farine 350g\r\nlait 500ml\r\nsucre\r\nrhum\r\n4 oeufs', 'consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nFermentum posuere urna nec tincidunt praesent semper feugiat nibh. Sit amet porttitor eget dolor morbi non arcu risus. Turpis tincidunt id aliquet risus feugiat in ante metus. Facilisis magna etiam tempor orci eu lobortis. Amet mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien. \r\nArcu felis bibendum ut tristique et egestas quis. Amet consectetur adipiscing elit pellentesque habitant morbi tristique senectus et.', 1),
(22, 'eau de vichy', 'privée, spécial régime sans glutten, pas d\'allergies', NULL, NULL, NULL, 'eau\r\nvichy\r\nbulles', 'Imperdiet dui accumsan sit amet nulla facilisi morbi tempus. Orci nulla pellentesque dignissim enim sit amet venenatis urna cursus. Morbi non arcu risus quis varius quam quisque id diam. Gravida quis blandit turpis cursus.', 0),
(23, 'poivrons au four', 'Privé, régime sans sel et/ou sans gluten, pas d\'allergène', NULL, NULL, '01:00:00', 'poivrons', 'in hac habitasse platea dictumst. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Neque ornare aenean euismod elementum nisi quis eleifend quam.', 0),
(24, 'crevettes à l\'ail', 'publique tous régimes, allergie crevettes', NULL, NULL, '00:20:00', 'grosses crevettes\r\nail\r\nhuile olive', 'Duis ultricies lacus sed turpis tincidunt. Sit amet dictum sit amet justo donec enim diam. Orci phasellus egestas tellus rutrum. Fames ac turpis egestas sed.', 1);

INSERT INTO `recette_allergene` (`recette_id`, `allergene_id`) VALUES
(14, 3),
(15, 3),
(16, 1),
(16, 2),
(16, 4),
(16, 5),
(17, 1),
(17, 2),
(17, 4),
(17, 5),
(24, 6);

INSERT INTO `recette_regime` (`recette_id`, `regime_id`) VALUES
(16, 1),
(16, 2),
(17, 1),
(18, 1),
(18, 2),
(21, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2);

INSERT INTO `user_allergene` (`user_id`, `allergene_id`) VALUES
(5, 3),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6);

INSERT INTO `user_regime` (`user_id`, `regime_id`) VALUES
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(7, 1);
