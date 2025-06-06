
--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id`, `Nombre`) VALUES
(3, 'Armarios'),
(14, 'Cocina'),
(13, 'electrodomésticos'),
(2, 'Mesas'),
(1, 'Sillas'),
(4, 'Sofás');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`Id`, `Pedido_Id`, `Producto_Id`, `Cantidad`, `Precio_Unitario`) VALUES
(2, 2, 45, 1, '600.00'),
(3, 3, 24, 1, '450.00'),
(4, 4, 19, 1, '180.00'),
(5, 4, 15, 1, '279.99'),
(6, 4, 36, 1, '340.00'),
(88, 25, 14, 1, '64.99'),
(89, 25, 15, 2, '279.99'),
(90, 26, 32, 1, '1600.00'),
(91, 27, 17, 1, '320.00'),
(92, 28, 18, 2, '350.00'),
(93, 28, 19, 1, '180.00'),
(94, 29, 33, 1, '2800.00'),
(95, 29, 21, 1, '220.00'),
(96, 30, 22, 2, '400.00'),
(97, 31, 23, 1, '250.00'),
(98, 31, 24, 1, '450.00'),
(99, 32, 25, 3, '499.99'),
(100, 33, 26, 2, '650.00'),
(101, 34, 27, 1, '199.99'),
(102, 35, 28, 2, '374.99'),
(103, 36, 29, 1, '390.00'),
(104, 36, 30, 1, '649.99'),
(105, 37, 14, 2, '64.99'),
(106, 38, 15, 1, '279.99'),
(107, 38, 71, 2, '999.00'),
(108, 39, 60, 1, '100.00'),
(109, 40, 51, 2, '90.00'),
(110, 40, 37, 1, '300.00'),
(111, 41, 41, 1, '299.99'),
(112, 42, 68, 2, '95.00'),
(113, 43, 39, 2, '399.99'),
(114, 44, 23, 1, '250.00');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Id`, `Usuario_Id`, `Precio_Total`, `Fecha`, `Estado`) VALUES
(2, 5, '600.00', '2025-05-29 20:59:41', 'Completado'),
(3, 5, '450.00', '2025-05-29 21:02:26', 'Pendiente'),
(4, 5, '799.99', '2025-05-29 21:03:15', 'Pendiente'),
(25, 5, '624.97', '2025-06-01 17:23:50', 'Pendiente'),
(26, 6, '1600.00', '2025-06-01 17:23:50', 'Pendiente'),
(27, 32, '320.00', '2025-06-01 17:23:50', 'Pendiente'),
(28, 8, '880.00', '2025-06-01 17:23:50', 'Pendiente'),
(29, 9, '3020.00', '2025-06-01 17:23:50', 'Pendiente'),
(30, 10, '800.00', '2025-06-01 17:23:50', 'Pendiente'),
(31, 11, '700.00', '2025-06-01 17:23:50', 'Pendiente'),
(32, 12, '1499.97', '2025-06-01 17:23:50', 'Pendiente'),
(33, 13, '1300.00', '2025-06-01 17:23:50', 'Pendiente'),
(34, 14, '199.99', '2025-06-01 17:23:50', 'Pendiente'),
(35, 15, '749.98', '2025-06-01 17:23:50', 'Pendiente'),
(36, 16, '1039.99', '2025-06-01 17:23:50', 'Pendiente'),
(37, 17, '129.98', '2025-06-01 17:23:50', 'Pendiente'),
(38, 18, '2277.99', '2025-06-01 17:23:50', 'Pendiente'),
(39, 19, '100.00', '2025-06-01 17:23:50', 'Pendiente'),
(40, 20, '480.00', '2025-06-01 17:23:50', 'Pendiente'),
(41, 21, '299.99', '2025-06-01 17:23:50', 'Pendiente'),
(42, 22, '190.00', '2025-06-01 17:23:50', 'Pendiente'),
(43, 23, '799.98', '2025-06-01 17:23:50', 'Pendiente'),
(44, 24, '250.00', '2025-06-01 17:23:50', 'Pendiente');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id`, `Nombre`, `Descripcion`, `Precio`, `Stock`, `Imagen`, `Categoria_Id`) VALUES
(1, 'Silla de Madera', 'Silla cómoda de madera con respaldo alto.', '49.99', 10, 'silla_madera.jpg', 1),
(2, 'Mesa de Centro', 'Mesa de centro moderna con acabado en roble.', '119.99', 5, 'mesa_centro.jpg', 2),
(3, 'Armario de 3 Puertas', 'Armario espacioso con 3 puertas y estantes internos.', '299.99', 3, 'armario_3_puertas.jpg', 3),
(4, 'Sofá de 3 Plazas', 'Sofá amplio y cómodo con tapizado en terciopelo.', '399.99', 4, 'sofa_3_plazas.jpg', 4),
(14, 'Silla de cuero', 'Silla de cuero cómoda y útil', '64.99', 12, 'silla_de_cuero.jpg', 1),
(15, 'Armario Esquinero', 'Perfecto para aprovechar esquinas. Color blanco.', '279.99', 4, 'armario_esquinero.jpg', 3),
(17, 'Armario con Espejo', 'Incluye espejo en puerta principal', '320.00', 10, 'armario_con_espejo.jpg', 3),
(18, 'Armario Puertas Lacadas', 'Superficie lacada de alta calidad.', '350.00', 6, 'armario_puertas_lacadas.jpg', 3),
(19, 'Armario Compacto', 'Ideal para apartamentos pequeños.', '180.00', 13, 'armario_compacto.jpg', 3),
(21, 'Armario 2 Puertas', 'Modelo clásico en color nogal.', '220.00', 15, 'armario_2_puertas.jpg', 3),
(22, 'Armario Alto Almacenaje', 'Gran capacidad con estantes.', '400.00', 4, 'armario_alto_almacenaje.jpg', 3),
(23, 'Armario Puertas Batientes', 'Puertas de fácil apertura. ', '250.00', 7, 'armario_puertas_batientes.jpg', 3),
(24, 'Armario Blanco Mate', 'Perfecto para decoraciones modernas.', '450.00', 11, 'armario_blanco_mate.jpg', 3),
(25, 'Armario Puertas Correderas', ' Puertas correderas de cristal', '499.99', 4, 'armario_puertas_correderas.jpg', 3),
(26, 'Armario Empotrable', 'Personalizable y ajustable a pared.', '650.00', 4, 'armario_empotrable.jpg', 3),
(27, 'Armario Juvenil ', 'Diseño compacto para habitaciones pequeñas.', '199.99', 8, 'armario_juvenil_.jpg', 3),
(28, 'Armario Minimal', ' Diseño moderno, líneas rectas, color gris.', '374.99', 9, 'armario_minimal.jpg', 3),
(29, 'Armario Rústico', 'Acabado envejecido para ambientes rurales.', '390.00', 6, 'armario_rústico.jpg', 3),
(30, 'Armario Vintage', ' Estilo clásico con detalles en bronce.', '649.99', 5, 'armario_vintage.jpg', 3),
(31, 'Cocina Modular Básica', 'Con encimera de madera', '2400.00', 6, 'cocina_modular_básica.jpg', 14),
(32, 'Cocina en L', 'Ideal para espacios reducidos. ', '1600.00', 3, 'cocina_en_l.jpg', 14),
(33, 'Cocina Americana', 'Estilo abierto con barra incluida. ', '2800.00', 4, 'cocina_americana.jpg', 14),
(34, 'Cocina Estilo Nórdico', 'Colores claros y materiales naturales.', '1500.00', 3, 'cocina_estilo_nórdico.jpg', 14),
(35, 'Cocina Rústica', 'Diseño tradicional con madera maciza.', '1850.00', 3, 'cocina_rústica.jpg', 14),
(36, 'Lavadora Siete Kilogramos', 'Eficiencia energética A++', '340.00', 11, 'lavadora_7kg.jpg', 13),
(37, 'Secadora Compacta', 'Ideal para espacios pequeños.', '300.00', 6, 'secadora_compacta.jpg', 13),
(38, 'Frigorífico Doble Puerta', 'Capacidad de 300L.', '500.00', 7, 'frigorífico_doble_puerta.jpg', 13),
(39, 'Lavavajillas doce Servicios', 'Programas eco-friendly.', '399.99', 8, 'lavavajillas_12_servicios.jpg', 13),
(40, 'Microondas Grill', 'Con función de descongelado rápido.', '140.00', 15, 'microondas_grill.jpg', 13),
(41, 'Horno Eléctrico', 'Control digital, 5 programas.', '299.99', 9, 'horno_eléctrico.jpg', 13),
(42, 'Campana Extractora', 'Diseño de acero inoxidable.', '219.99', 8, 'campana_extractora.jpg', 13),
(43, 'Placa de Inducción', '3 zonas, control táctil.', '350.00', 4, 'placa_de_inducción.jpg', 13),
(44, 'Congelador Vertical ', 'Compacto, 150L de capacidad.', '320.00', 8, 'congelador_vertical_.jpg', 13),
(45, 'Aire Acondicionado ', '3000 frigorías.', '600.00', 5, 'aire_acondicionado_.jpg', 13),
(46, 'Mesa de Comedor Roble', 'Capacidad para 8 personas', '450.00', 8, 'mesa_de_comedor_roble.jpg', 2),
(47, 'Mesa de Centro Cristal ', 'Moderna y elegante.', '200.00', 6, 'mesa_de_centro_cristal_.jpg', 2),
(48, 'Mesa Extensible', 'Se adapta de 4 a 8 personas.', '550.00', 5, 'mesa_extensible.jpg', 2),
(49, 'Mesa Redonda Madera', 'Perfecta para desayunadores.', '300.00', 10, 'mesa_redonda_madera.jpg', 2),
(50, 'Mesa Alta Bar', 'Estilo industrial, color negro.', '219.99', 7, 'mesa_alta_bar.jpg', 2),
(51, 'Mesa Infantil', 'Colores vivos, resistente.', '90.00', 9, 'mesa_infantil.jpg', 2),
(52, 'Mesa Jardín Aluminio', 'Resistente a la intemperie.', '400.00', 4, 'mesa_jardín_aluminio.jpg', 2),
(53, 'Mesa Rústica Maciza', 'Madera envejecida.', '600.00', 3, 'mesa_rústica_maciza.jpg', 2),
(54, 'Mesa Escritorio Compacto', ' Ideal para teletrabajo.', '149.99', 15, 'mesa_escritorio_compacto.jpg', 2),
(55, 'Mesa de Noche', 'Con dos cajones.', '120.00', 14, 'mesa_de_noche.jpg', 2),
(56, 'Mesa Estudio Juvenil', 'Compacta y ligera.', '240.00', 11, 'mesa_estudio_juvenil.jpg', 2),
(57, 'Silla de Comedor Tapizada', 'Color gris.', '85.00', 20, 'silla_de_comedor_tapizada.jpg', 1),
(58, 'Silla Plegable Plástica', 'Fácil de almacenar.', '35.00', 25, 'silla_plegable_plástica.jpg', 1),
(59, 'Silla Ergonómica Oficina ', 'Respaldo ajustable.', '220.00', 10, 'silla_ergonómica_oficina_.jpg', 1),
(60, 'Silla Alta Bar', 'Estilo industrial. ', '100.00', 8, 'silla_alta_bar.jpg', 1),
(61, 'Silla Madera Maciza', 'Acabado natural.', '90.00', 15, 'silla_madera_maciza.jpg', 1),
(62, 'Silla Infantil Colores', 'Diseño seguro.', '45.00', 18, 'silla_infantil_colores.jpg', 1),
(63, 'Silla de Jardín Aluminio', 'Resistente a la intemperie.', '70.00', 12, 'silla_de_jardín_aluminio.jpg', 1),
(64, 'Silla Tapizada Terciopelo', 'Estilo elegante.', '140.00', 9, 'silla_tapizada_terciopelo.jpg', 1),
(65, 'Silla Sin Respaldo', 'Estilo taburete.', '50.00', 12, 'silla_sin_respaldo.jpg', 1),
(66, 'Silla Vintage', 'Patas de madera curvada.', '130.00', 6, 'silla_vintage.jpg', 1),
(67, 'Silla Estilo Nórdico', 'Madera cuidada', '70.00', 11, 'silla_estilo_nórdico.jpg', 1),
(68, 'Silla Transparentes', 'Policarbonato resistente.', '95.00', 10, 'silla_transparentes.jpg', 1),
(69, 'Sofá Cama', 'Estructura fácil de desplegar.', '850.00', 5, 'sofá_cama.jpg', 4),
(70, 'Sofá Esquinero', 'Incluye chaise longue.', '1200.00', 3, 'sofá_esquinero.jpg', 4),
(71, 'Sofá Relax', ' Con reclinación automática.', '999.00', 4, 'sofá_relax.jpg', 4),
(72, 'Sofá Chesterfield', 'Estilo clásico, tapizado cuero sintético.', '1400.00', 2, 'sofá_chesterfield.jpg', 4),
(73, 'Sofá de Jardín', 'Resistente a la intemperie.', '620.00', 5, 'sofá_de_jardín.jpg', 4),
(74, 'Sofá con Arcón', 'Espacio de almacenaje interior.', '990.00', 4, 'sofá_con_arcón.jpg', 4);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nombre`, `Apellidos`, `Correo`, `Contraseña`, `Teléfono`, `Dirección`, `Código_Postal`, `Provincia`, `Rol`) VALUES
(5, 'Ángel', 'Admin', 'admin@gmail.com', 'Admin#1', '600000001', 'Calle Central 1', '28001', 'Madrid', 1),
(6, 'Angel', 'Cliente', 'test@gmail.com', 'Test#1', '600000002', 'Avenida Norte 5', '08001', 'Barcelona', 0),
(8, 'Laura', 'Fernández Díaz', 'laura1@gmail.com', 'Lau@2023df!', '611111111', 'Calle Girasol 12', '33001', 'Asturias', 0),
(9, 'Javier', 'Gómez Ruiz', 'javier2@gmail.com', 'Javi!2023RR', '622222222', 'Avenida España 45', '08001', 'Barcelona', 1),
(10, 'Marta', 'Sánchez López', 'marta3@gmail.com', 'Mar#T2023z', '633333333', 'Calle Real 56', '28080', 'Madrid', 0),
(11, 'Carlos', 'Pérez Torres', 'carlos4@gmail.com', 'C@rl0s2023!', '644444444', 'Calle León 22', '41001', 'Sevilla', 0),
(12, 'Ana', 'Martínez Vega', 'ana5@gmail.com', 'An@_2023Mv', '655555555', 'Calle Norte 3', '46001', 'Valencia', 0),
(13, 'Lucía', 'Ramírez Castro', 'lucia6@gmail.com', 'LuC!a_23rt', '666666666', 'Ronda Sur 91', '29001', 'Málaga', 0),
(14, 'Daniel', 'Hernández Gil', 'daniel7@gmail.com', 'DaNi@2023!', '677777777', 'Camino Viejo 10', '50001', 'Zaragoza', 0),
(15, 'Elena', 'García Ortiz', 'elena8@gmail.com', 'Ele#2023xX', '688888888', 'Calle Mayor 85', '15001', 'A Coruña', 0),
(16, 'Miguel', 'Jiménez Ríos', 'miguel9@gmail.com', 'Mig_2023!x', '699999999', 'Plaza Nueva 5', '03001', 'Alicante', 0),
(17, 'Sofía', 'Moreno Santos', 'sofia10@gmail.com', 'Sofi@2023*', '610000000', 'Travesía Este 21', '24001', 'León', 0),
(18, 'Pablo', 'López Cano', 'pablo11@gmail.com', 'Pab2023!xX', '611000000', 'Calle Jardín 7', '10001', 'Cáceres', 0),
(19, 'Cristina', 'Álvarez Mena', 'cristina12@gmail.com', 'CrIs@_23OK', '612000000', 'Calle Lavanda 34', '02001', 'Albacete', 0),
(20, 'Manuel', 'Ruiz Molina', 'manuel13@gmail.com', 'M@nueL!23x', '613000000', 'Calle Prado 2', '16001', 'Cuenca', 0),
(21, 'Irene', 'Domínguez Sosa', 'irene14@gmail.com', 'Ire_2023$A', '614000000', 'Calle Trébol 8', '51001', 'Ceuta', 0),
(22, 'Alberto', 'Cabrera León', 'alberto15@gmail.com', 'AlB!23_*ok', '615000000', 'Calle Arco 13', '35001', 'Las Palmas', 0),
(23, 'Beatriz', 'Torres Lozano', 'bea16@gmail.com', 'Bea2023#Xy', '616000000', 'Camino Verde 1', '38001', 'Santa Cruz de Tenerife', 0),
(24, 'Sergio', 'Sanz Navarro', 'sergio17@gmail.com', 'SeRG2023!!', '617000000', 'Paseo del Sol 77', '50002', 'Zaragoza', 0),
(25, 'Claudia', 'Marín Aguilar', 'claudia18@gmail.com', 'ClAu@23_xX', '618000000', 'Avenida Marítima 23', '41002', 'Sevilla', 0),
(26, 'Alejandro', 'Núñez Bueno', 'alejandro19@gmail.com', 'Ale#2023aa', '619000000', 'Calle Pino 3', '07001', 'Islas Baleares', 0),
(27, 'Raquel', 'Delgado Ramos', 'raquel20@gmail.com', 'Raq_2023XX!', '620000000', 'Calle Salvia 19', '15002', 'A Coruña', 0),
(28, 'Hugo', 'Luna Ramos', 'hugo21@gmail.com', 'HuG@_2023!x', '621000000', 'Calle Arboleda 4', '29002', 'Málaga', 0),
(29, 'Natalia', 'Vicente Franco', 'natalia22@gmail.com', 'Nat#_2023Aa', '622000000', 'Avenida Paz 14', '08002', 'Barcelona', 0),
(30, 'Adrián', 'Ros González', 'adrian23@gmail.com', 'Adr!2023.XX', '623000000', 'Calle Cedro 11', '03002', 'Alicante', 0),
(31, 'Patricia', 'Campos Reyes', 'patricia24@gmail.com', 'PaT!2023xy_', '624000000', 'Calle Sur 31', '28002', 'Madrid', 0),
(32, 'Mario', 'Gallardo Peña', 'mario25@gmail.com', 'Mar2023!aX_', '625000000', 'Calle Abeto 6', '33002', 'Asturias', 0),
(33, 'Andrea', 'Benítez Pardo', 'andrea26@gmail.com', 'Andr#23xo_', '626000000', 'Ronda Norte 42', '08003', 'Barcelona', 0),
(34, 'Iván', 'Morales Cordero', 'ivan27@gmail.com', 'Iv@n2023xy!', '627000000', 'Plaza Oeste 8', '50003', 'Zaragoza', 0),
(35, 'Noelia', 'Serrano Barros', 'noelia28@gmail.com', 'Noe!2023Ab', '628000000', 'Calle Fresnos 17', '29003', 'Málaga', 0),
(36, 'Rubén', 'Navarro Pérez', 'ruben29@gmail.com', 'Rub!2023ok_', '629000000', 'Paseo del Mar 3', '41003', 'Sevilla', 0),
(37, 'Carmen', 'Rivas Ortega', 'carmen30@gmail.com', 'CarmeN23@!', '630000000', 'Calle Trébol 9', '28003', 'Madrid', 0),
(38, 'Jorge', 'Del Río Sánchez', 'jorge31@gmail.com', 'JoRgE_23!aa', '631000000', 'Calle Norte 2', '04001', 'Almería', 0),
(39, 'Lidia', 'Ortiz Bueno', 'lidia32@gmail.com', 'Lid#A2023ok', '632000000', 'Ronda Este 10', '22001', 'Huesca', 0),
(40, 'Oscar', 'Herrero Navas', 'oscar33@gmail.com', 'Osc2023!A_', '633000000', 'Calle Palmera 15', '32001', 'Ourense', 0),
(41, 'Silvia', 'Cano Bravo', 'silvia34@gmail.com', 'SiLv!_2023z', '634000000', 'Paseo Norte 5', '14001', 'Córdoba', 0),
(42, 'Marcos', 'Ibáñez Vela', 'marcos35@gmail.com', 'M@rcoS_23x!', '635000000', 'Camino Verde 19', '03003', 'Alicante', 0),
(43, 'Paula', 'Bravo León', 'paula36@gmail.com', 'PaU2023!*xy', '636000000', 'Avenida Mar 99', '29004', 'Málaga', 0),
(44, 'Enrique', 'Mena Escribano', 'enrique37@gmail.com', 'EnRi@2023$', '637000000', 'Calle Robles 18', '28004', 'Madrid', 0),
(45, 'Sandra', 'Guillén Cobo', 'sandra38@gmail.com', 'S@ndra23XX!', '638000000', 'Calle Otoño 1', '46002', 'Valencia', 0),
(46, 'David', 'Saez Lozano', 'david39@gmail.com', 'Dav!d_2023xy', '639000000', 'Travesía Este 3', '37001', 'Salamanca', 0),
(47, 'Eva', 'Redondo Gallardo', 'eva40@gmail.com', 'Eva#2023_xX', '640000000', 'Calle Jardín 22', '33003', 'Asturias', 0),
(48, 'Raúl', 'Cuesta Marín', 'raul41@gmail.com', 'Raul@2023ok!', '641000000', 'Calle Rastrojo 5', '36001', 'Pontevedra', 0),
(49, 'Inés', 'Valero Muñoz', 'ines42@gmail.com', 'InEs_2023$#', '642000000', 'Plaza Castilla 7', '50004', 'Zaragoza', 0),
(50, 'Tomás', 'Garrido Herrán', 'tomas43@gmail.com', 'ToMaS!23xX', '643000000', 'Calle Rosalía 1', '12001', 'Castellón', 0),
(51, 'Celia', 'Roldán Cuenca', 'celia44@gmail.com', 'CeLiA@2023x', '644000000', 'Paseo Oeste 19', '29005', 'Málaga', 0),
(52, 'Francisco', 'Rey Castaño', 'fran45@gmail.com', 'Fran#23!xy_', '645000000', 'Calle Sur 4', '18001', 'Granada', 0),
(53, 'Nuria', 'Beltrán Pascual', 'nuria46@gmail.com', 'Nur!a@2023_', '646000000', 'Avenida Cielo 6', '28005', 'Madrid', 0),
(54, 'Guillermo', 'Peña Salas', 'guillermo47@gmail.com', 'Gu!ll@2023x', '647000000', 'Calle Estrella 21', '35002', 'Las Palmas', 0),
(55, 'Teresa', 'Llamas Robledo', 'teresa48@gmail.com', 'Ter#23@xX_', '648000000', 'Travesía Norte 2', '33004', 'Asturias', 0),
(56, 'Álvaro', 'Nieto Cortés', 'alvaro49@gmail.com', 'Alv@rO2023_', '649000000', 'Calle Oro 9', '07002', 'Islas Baleares', 0),
(57, 'Verónica', 'Salvador Moya', 'veronica50@gmail.com', 'VeRo!2023_X', '650000000', 'Paseo Marítimo 6', '46003', 'Valencia', 0);

