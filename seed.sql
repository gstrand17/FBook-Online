INSERT INTO location (location_id, place_name, latitude, longitude, address, map_api_id) VALUES
  (1, 'Reitz Union', 29.6465, -82.3477, '655 Reitz Union Drive, Gainesville, FL 32611', NULL),
  (2, 'Ben Hill Griffin Stadium', 29.6499, -82.3486, 'Stadium Rd, Gainesville, FL 32611', NULL),
  (3, 'UF Housing and Residence Life', 29.6385, -82.3411 , '1304 Diamond Rd, Gainesville, FL 32611', NULL),
  (4, 'Marston Science Library', 29.6487, -82.3438, 'Marston Science Library, Gainesville, FL 32611', NULL),
  (5, 'Emerson Alumni Hall', 29.6517, -82.3429, '1938 W University Ave, Gainesville, FL 32603', NULL),
  (6, 'Peabody Hall', 29.6511, -82.3458, '1500 Union Rd, Gainesville, FL 32603', NULL),
  (7, 'Archway', 29.6505, -82.3428, '300 SW 13th St, Gainesville, FL 32611', NULL),
  (8, 'Southwest Recreation Center', 29.6384, -82.3683, '3150 Hull Rd, Gainesville, FL 32611', NULL),
  (9, 'UF Student Health Care Center', 29.6500, -82.3500, '2140 Stadium Rd, Gainesville, FL 32611', NULL),
  ('Century Tower',        29.6480, -82.3437, 'University Ave, Gainesville, FL 32611', NULL),
  ('Lake Alice',           29.6423, -82.3612, 'Museum Rd, Gainesville, FL 32611',      NULL),
  ('The Swamp Restaurant', 29.6515, -82.3249, '1642 W University Ave, Gainesville, FL', NULL);

INSERT INTO traditions (tradition_id, uq_user_tradition_name, description, category, fbook_pagenum) VALUES
  ('Listen to the Chimes of Century Tower', 
   'Stand beneath Century Tower and listen to the carillon bells ring on the hour.',
   'Campus Landmark', 1, 4),
  ();